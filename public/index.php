<?php

//=====================================================
// THIS IS WHERE THE APPLICATION STARTS
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
//=====================================================

//=====================================================
//But first we are gonna import all our PHP
//=====================================================

$URL = $_GET['p']??'';

require_files('App/*');
