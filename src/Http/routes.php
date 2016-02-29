<?php

#route URLs should be changed based on user preferences

Route::group(['middleware' => ['web' , 'auth']], function() {

    Route::group(['prefix' => 'user'], function(){

        Route::resource('tickets', 'UserIrticketController');
    });

    Route::group(['prefix' => 'admin'],function(){

        Route::resource('tickets','AgentIrticketController');
    });

});




