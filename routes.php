<?php
use App\Routes;


Routes::get('/', 'HomepageController@index')->name('home');


Routes::fallback(function(){
    return blade('not-found')->render();
});