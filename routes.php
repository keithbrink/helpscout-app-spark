<?php

Route::group(['prefix' => '/helpscout-spark-app', 'middleware' => ['web']], function () {
    Route::get('/custom-app', '\KeithBrink\HelpscoutSpark\Http\Controllers\HelpscoutController@getTicketData');
});