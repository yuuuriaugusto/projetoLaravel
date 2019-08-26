<?php

use Illuminate\Http\Request;


// Route::view('/404-tenant', 'errors.404-tenant')->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
});


