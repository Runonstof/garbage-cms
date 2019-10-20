<?php

//=====================================================
// THIS IS WHERE GARBAGE CMS's CODE STARTS
// I wrote this while bein high af so go easy
//=====================================================

require "./../vendor/autoload.php";
require "./../functions.php";

//=====================================================
//.env contains sensitive data
//.env.example contains what settings need to be there
//for you to set locally
// (I know we need this bc I worked with some
// frameworks and they used dotenv as well, nothing too savy)
// We use the composer package 'vlucas/dotenv' for this
//=====================================================

$dotenv = Dotenv\Dotenv::create(__DIR__.'\..');
$dotenv->load();

//=====================================================
// For making HTML We are gonna use the most
// basic HTML template engine that is there
// ever, its for import html files so you dont have
// to write HTML twice! (just takes a google hehe)
// We use the composer package 'jenssegers/blade'
//
// This is the blade templating engine, which is also
// present in laravel framework
//=====================================================

use App\DB;
use Jenssegers\Blade\Blade;
$blades = new Blade('views', 'cache');


//=====================================================
//But first we are gonna import all our PHP
//Inside the App directory
//=====================================================

$URL = trim($_GET['p']??'','/');

require_files('./../App/');



use App\Route;

//======================================================
//
//
//======================================================


//=====================================================
//  Import our routes
//
//=====================================================


require_once './../routes.php';

//var_dump(collect(Route::$routes)->firstWhere('name','install'));

//Route::handle($URL);

//Execute incoming URL
if(!DB::exists()) {
    route('test');
    // if(!route('install')->match($URL)) {
    //     header('Location: '.url().'install');
    // }
}
Route::handle($URL);

