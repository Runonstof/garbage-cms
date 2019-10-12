<?php
use App\Routes;


Routes::get('/', 'HomepageController@index')->name('artical.single');


Routes::fallback(function(){
    return blade('not-found')->render();
});