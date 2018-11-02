<?php

Route::prefix('v1')->namespace('API\V1')->name('api.')->group(function () {
    Route::apiResource('articles', 'ArticleController');
});
