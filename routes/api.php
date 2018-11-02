<?php

Route::prefix('v1')->namespace('API\V1')->name('api.')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::apiResource('articles', 'ArticleController');
});
