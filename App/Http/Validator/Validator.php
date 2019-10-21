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
            'required' => ':attribute is required',
            'numeric' => ':attribute must be numeric',
            'regex' => ':attribute must match regex',
            'email' => ':attrbute must be an email',
            'datetime' => ':attribute must be in date/datetime format'
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
                    $useRuleArgs = is_string($ruleArgs) ? [$ruleArgs] : $ruleArgs;
                }

                $validatorRule = Rule::get($ruleKey);
                if(is_callable($validatorRule->ruleMethod)) {
                    if(!call_user_func_array($validatorRule->ruleMethod, [$value, $useRuleArgs])) {
                        $msg = $this->messages->get($ruleKey)??'';

                        $msg = str_replace(':attribute', $this->attributes->get($valRuleKey,$valRuleKey), $msg);

                        $msgs[$valRuleKey][$ruleKey][] = $msg;
                        $valid = false;
                    }
                }

            }
        }

        return $valid;
    }
}