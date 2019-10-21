<?php

namespace App\Controllers;

class InstallController {
    public function index() {
        return blade('install.index')->render();
    }

    public function koek() {
        session()->flash('error.database', 'Not valid');
        return session()->json(JSON_PRETTY_PRINT);

    }
}