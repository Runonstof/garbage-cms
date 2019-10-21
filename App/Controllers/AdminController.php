<?php

namespace App\Controllers;

class AdminController {
    public function index() {
        return blade('admin.index')->render();
    }
    public function test() {
        return blade('admin.test')->render();
    }

    public function pages() {
        return blade('admin.pages')->render();
    }
}