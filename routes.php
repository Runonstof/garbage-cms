<?php
use App\Routes;


Routes::get('/article/{name}/{user}/{id?}/', 'HomepageController@index')->name('artical.single');
