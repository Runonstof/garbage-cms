<?php

require "./../vendor/autoload.php";

//====================================================
//.env contains sensitive data
//.env.example contains what settings need to be there
//====================================================

$dotenv = Dotenv\Dotenv::create(__DIR__.'\..');
$dotenv->load();

echo "NICE".getenv('TESTSETTING'); //NICECOOL