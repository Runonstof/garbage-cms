<?php
//=====================================================
// THIS IS WHERE GARBAGE CMS's CODE STARTS
// I wrote this while bein high af so go easy
//=====================================================

//Start the session
if(session_status() == PHP_SESSION_NONE) { session_start(); }

//Create CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

function csrf_token() {
    return $_SESSION['token'];
}

function csrf_match($token) {
    return hash_equals(csrf_token(), $token);
}

$_SESSION['locale'] = $_SESSION['locale']??'en';

$GLOBALS['lang'] = require './../lang/'.$_SESSION['locale'].'.php';

require "./../vendor/autoload.php"; //import the composer packages
require "./../functions.php"; //import our functions



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



require_files('./../App/');



use App\Route;

//======================================================
//
// Strip down the url we have and put it in $URL
//======================================================
$URL = trim($_GET['p']??'','/');



//=====================================================
//  Import our routes
//
//=====================================================

require_once './../routes.php';

//var_dump(collect(Route::$routes)->firstWhere('name','install'));

//Route::handle($URL);

//Execute incoming URL
// if(!DB::exists()) {
//     route('test');
    // if(!route('install')->match($URL)) {
    //     header('Location: '.url().'install');
    // }
// }
Route::handle($URL);

