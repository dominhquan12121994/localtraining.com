<?php
/**
 * Define route for module
 * @author Electric <huydien.it@gmail.com>
 */

Route::group(array('middleware' => array()), function () {
    Route::get('districts/get-by-province/{id}',        'DistrictsController@getByProvince')->name('api.districts.get-by-province');
    Route::get('wards/get-by-district/{id}',        'WardsController@getByDistrict')->name('api.wards.get-by-district');
});