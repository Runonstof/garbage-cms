<?php

use App\Model;
use App\Models\Page;
use App\Route;

/*
=======================================
Here we define the urls for Garbage CMS
This is something based on Laravel that
I wanted to try to create myself.

- Runonstof
=======================================
*/

Route::get('/', 'HomepageController@index')->name('home');
Route::get('/test', 'HomepageController@test')->name('test');

Route::get('/testie-route/{argOne}/{argTwo}/{argThree?}', function(){
    return 'hi';
})->name('testroute');


//=========================================
//Routes regarding installation
Route::get('/install', 'InstallController@index')->name('install');
Route::get('/install/error/{error_id?}', 'InstallController@error')->name('install.error');

//Route where installation begins
Route::post('/install/database', 'InstallController@database')->name('install.database'); //DB Structure
Route::post('/install/register', 'InstallController@register')->name('install.register'); //where admin register acc data gets sends to, to handle and db seed


//=======================



//URLs for admin panels
Route::namePrefix('admin.')::urlPrefix('admin')::group(function(){
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/test','AdminController@test')->name('test');
    Route::get('/pages', 'AdminController@pages')->name('pages');
});


Route::fallback(function(){
    return blade('not-found')->render();
});