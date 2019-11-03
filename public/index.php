<?php
//=====================================================
// THIS IS WHERE GARBAGE CMS's CODE STARTS
// I wrote this while bein high af so go easy
//=====================================================


//Start the session
if(session_status() == PHP_SESSION_NONE) { session_start(); }

use Tightenco\Collect\Support\Collection;
//

//Create CSRF token
if (empty($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}

function csrf_token() {
    return $_SESSION['_token'];
}

function csrf_match($token) {
    return hash_equals(csrf_token(), $token);
}

$_SESSION['locale'] = $_SESSION['locale']??'en';

$GLOBALS['lang'] = require './../lang/'.$_SESSION['locale'].'.php';

require __DIR__."./../vendor/autoload.php"; //import the composer packages
require __DIR__."./../functions.php"; //import our functions


//Get POST data from previous request
//(to keep forms filled when refreshing)

function old($name) {
    $sessionValue = session()->get('_POST_OLD',[]);
    $value = null;
    if(is_array($sessionValue)) {
        $value = $sessionValue[$name]??null;
    } elseif(is_object($sessionValue)) {
        if(property_exists($sessionValue, $name)) {
            $value = $sessionValue->$name??null;
        }
    } else {
        $value = $sessionValue;
    }

    return $value;
}



//=====================================================
//.env contains sensitive data
//.env.example contains what settings need to be there
//for you to set locally
// (I know we need this bc I worked with some
// frameworks and they used dotenv as well, nothing too savy)
// We use the composer package 'vlucas/dotenv' for this
//=====================================================
$dotenv = Dotenv\Dotenv::create(__DIR__.'/..');
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
$blades = new Blade(__DIR__.'/views', __DIR__.'/cache');


//=====================================================
//But first we are gonna import all our PHP
//Inside the App directory
//=====================================================


require './../App/helpers.php';

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
DB::init();
if(!DB::exists()) {
    if(!getRoute('install.error')->match($URL)) {
        //header('Location: /install/error/database.not_exists');
        
        exit;
    }
}

//Execute incoming URL
Route::handle($URL);

