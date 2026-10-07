<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'dsdsdsd';
});

Route::get('/my_page', 'MyPlaceController@index');