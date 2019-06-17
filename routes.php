<?php

Route::group(['prefix' => '/helpscout-spark-app'], function () {
    Route::post('/custom-app', '\KeithBrink\HelpscoutSpark\Http\Controllers\HelpscoutController@getTicketData');
});