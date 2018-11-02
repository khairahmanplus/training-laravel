<?php

Route::prefix('v1')->namespace('API\V1')->group(function () {
    Route::apiResource('articles', 'ArticleController');
});
