<?php
/**
 * Define route for module
 * @author Electric <huydien.it@gmail.com>
 */
Route::group(['middleware' => ['get.menu']], function () {

    Route::group(['middleware' => ['role:user|admin']], function () {

        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('shops', 'ShopsController');
            Route::resource('orders', 'OrdersController');
        });

    });

});