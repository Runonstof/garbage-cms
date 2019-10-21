<?php

namespace App\Controllers;

use App\DB;
use App\Http\Validator\Validator;
use Symfony\Component\HttpFoundation\Request;

class InstallController {
    public function index() {
        return response()->blade('install.index');
    }

    public function koek() {
        
        $validator = new Validator;
        
        $validator->rules->add([
            'database'=> [
                'required',
                'regex' => '/^[\w]+$/'
            ],
        ]);
        
        if(!$validator->validate($_POST, $msgs)) {
            return response()->json($msgs);
        }
        DB::query('SELECT * FROM Users');
        return response()->json([
            'success' => true,
            'message' => 'Database created!',
            'type' => 'success'
        ]);
    }
}