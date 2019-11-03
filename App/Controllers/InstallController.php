<?php

namespace App\Controllers;

use App\DB;
use App\Http\Validator\Validator;
use App\Http\Response;


class InstallController {
    public function index() {
        //TODO: check - database - tables - user acc
        return response()->blade('install.account');
    }

    public function error($vars) {
        $error_title = null;
        $error_text = null;
        switch($vars['error_id']) {
            case 'database.not_exists':
                $error_title = __('install.error.database.not_exists.title');
                $error_text = __('install.error.database.not_exists.text', ['<span class="badge badge-muted">'.$_ENV['DB_NAME'].'</span>']);
                break;
        }

        return \response()->blade('install.error', compact('error_title', 'error_text'));
    }

    public function register() {
        $validator = new Validator;
        
        $validator->rules->add([
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min' => 8,
                'max' => 20,
                
            ]
        ]);
        
        if(!$validator->validateToSession($_POST)) {
            return \response()->json([
                'success' => false,
                'redirect' => route('install')
            ]);
        }
        
        return \response()->json([
            'success' => true,
            'redirect' => route('install')
        ]);
    }

    
}