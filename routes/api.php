<?php

Route::prefix('v1')->namespace('API\V1')->name('api.')->group(function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::get('me', 'AuthController@me')->name('me');
    Route::apiResource('articles', 'ArticleController');
});
