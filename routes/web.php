<?php

Route::view('/', 'welcome')->name('welcome');
Route::get('profile', 'ProfileController@profile')->name('profile');
Route::patch('profile', 'ProfileController@saveProfile');
Route::resource('articles', 'ArticleController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
