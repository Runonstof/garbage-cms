<?php

namespace App\Controllers;

class HomepageController {
    public function index() {
        return blade('homepage')->render();
    }
}