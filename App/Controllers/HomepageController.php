<?php

namespace App\Controllers;

class HomepageController {
    public function index() {
        return blade('homepage')->render();
    }
    public function test() {
        return blade('test')->render();
    }

    public function doggo(){
        return blade('doggo-theme/index')->render();
    }

    public function article(){
        return blade('doggo-theme/pages')->render();
    }

    public function randomdev() {
        return response()->blade('themes.randomdev-theme.list');
    }
}