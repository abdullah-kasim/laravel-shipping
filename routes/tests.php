<?php

/**
 * Routes for tests. You need to set TESTING=TRUE to enable this.
 */



Route::get('/sanity', function () {
    return Response::json(['yo']);
});
Route::get('/getAddresses', 'ShipperController@getAddresses');
Route::post('/getCheapestRate','ShipperController@getCheapestRate');
Route::post('/addShipper', 'ShipperController@addShipper');
Route::post('/addMerchant', 'ShipperController@addMerchant');
Route::post('/addShipmentDetail', 'ShipperController@addShipmentDetail');
Route::post('/addCustomer','ShipperController@addCustomer');
Route::post('/addUserAddress','ShipperController@addUserAddress');
Route::post('/addItem','ShipperController@addItem');
Route::post('/addUser','ShipperController@addUser');