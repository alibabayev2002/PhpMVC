<?php

use App\Classes\Route;


Route::get('/','home@index')->middleware(['home','about']);
Route::get('home/{user}/{id}','home@test')->middleware('home')->name('about');

