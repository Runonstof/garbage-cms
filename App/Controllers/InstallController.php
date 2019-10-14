<?php

namespace App\Controllers;

class InstallController {
    public function index() {
        return blade('install.index')->render();
    }
}