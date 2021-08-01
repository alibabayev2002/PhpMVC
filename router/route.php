<?php

use App\Classes\Route;


Route::get('/','home@index')->middleware('home');

Route::get('{user}/{id}','home@test')->middleware('home')->name('about');

