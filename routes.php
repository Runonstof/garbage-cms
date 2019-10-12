<?php
use App\Routes;

/*
=======================================
Here we define the urls for Garbage CMS
This is something based on Laravel that
I wanted to create myself.

- Runonstof
=======================================
*/

Routes::get('/', 'HomepageController@index')->name('home');


Routes::fallback(function(){
    return blade('not-found')->render();
});