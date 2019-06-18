<?php

Route::group(['prefix' => '/helpscout-spark-app'], function () {
    Route::post('/custom-app', '\KeithBrink\HelpscoutSpark\Http\Controllers\HelpscoutController@getCustomAppData');
    Route::post('/webhooks', '\KeithBrink\HelpscoutSpark\Http\Controllers\HelpscoutController@handleWebhooks');
});