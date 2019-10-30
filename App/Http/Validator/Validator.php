<?php

namespace App\Http\Validator;

use App\Http\Validator\Rule;
use Symfony\Component\HttpFoundation\ParameterBag;

class Validator {
    public $rules;
    public $attributes;
    public $messages;

    public function __construct() {
        $this->rules = new ParameterBag;
        $this->attributes = new ParameterBag;
        $this->messages = new ParameterBag([
            'required' => '{attribute} is required',
            'numeric' => '{attribute} must be numeric',
            'regex' => '{attribute} must match regex',
            'email' => '{attribute} must be a valid email',
            'datetime' => '{attribute} must be in date/datetime format',
            'min' => '{attribute} must be at least {0} characters',
            'max' => '{attribute} must be at most {0} characters'
        ]);
    }

    public function validate($vars, &$msgs=[]) {
        $valid = true;
        foreach($this->rules as $valRuleKey=>$valRule) {
            $value = $vars[$valRuleKey] ?? null;
            $rules = is_string($valRule) ? [$valRule] : $valRule;

            
            foreach($rules as $ruleKey=>$ruleArgs) {
                $ruleKey = is_numeric($ruleKey) ? $ruleArgs : $ruleKey;
                $useRuleArgs = [];
                if(!is_numeric($ruleKey)) {
                    $useRuleArgs = is_array($ruleArgs) ? $ruleArgs : [$ruleArgs];
                }

                $validatorRule = Rule::get($ruleKey);
                if(!$validatorRule->exec($value, $useRuleArgs, $vars)) {
                    $msg = $this->messages->get($ruleKey)??'';

                    $msg = str_replace('{attribute}', $this->attributes->get($valRuleKey,$valRuleKey), $msg);

                    foreach($useRuleArgs as $u=>$useRuleArg) {
                        $msg = str_replace('{'.$u.'}', $useRuleArg, $msg);
                    }

                    $msgs[$valRuleKey][$ruleKey][] = $msg;
                    $valid = false;
                
                }

            }
        }

        return $valid;
    }

    public function validateToSession($vars) {
        $msgs = [];
        if(!$this->validate($vars, $msgs)) {
            foreach($msgs as $inputName=>$inputMsgs) {
                foreach($inputMsgs as $inputMsg) {
                    foreach($inputMsg as $msg) {
                        session()->flash('error.'.$inputName, $msg);
                        break;
                    }
                    break;
                }
            }

            return false;
        }

        return true;
    }
}