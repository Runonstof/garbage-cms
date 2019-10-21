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
Route::get('/install', 'InstallController@index')->name('install');
Route::get('/testie-route/{argOne}/{argTwo}/{argThree?}', function(){
    return 'hi';
})->name('testroute');

Route::post('/koek', 'InstallController@koek')->name('koek');

Route::namePrefix('admin.')::urlPrefix('admin')::group(function(){
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/test','AdminController@test')->name('test');
    Route::get('/pages', 'AdminController@pages')->name('pages');
});


Route::fallback(function(){
    return blade('not-found')->render();
});