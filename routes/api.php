<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@loginFinal');
Route::post('get/manufacturers', 'API\VehicleController@vehicleManufacturerslist');
Route::post('get/vehicles', 'API\VehicleController@vehicles');
Route::get('getvehicles', 'API\VehicleController@vehicleslist');

Route::post('CurrentTrips', 'API\CurrentTripsController@CurrentTrips');


Route::middleware('auth:api')->prefix('user')->namespace('API')->group(function(){
    Route::post('me', 'UserController@getDetails');
    Route::post('get/drivers', 'UserController@getDrivers');
    Route::post('get/rates', 'RatesController@getRates');
    Route::post('update', 'UserController@updateUser');
    Route::post('update/card', 'UserCardController@UserCard');
    Route::post('add/vehicle', 'UserController@addVehicle');
    Route::post('add/profile_pic', 'UserController@addProfilePic');
    Route::post('add/request', 'RequestController@Request');
    Route::post('select/vehicle', 'VehicleController@selectVehicle');
    Route::post('delete/vehicle', 'VehicleController@deleteVehicle');
});

Route::middleware('auth:driver')->prefix('driver')->namespace('API')->group(function(){
    Route::post('me', 'DriverController@getDetails');
    Route::post('update', 'DriverController@updateDriver'); //Profile status 1
    Route::post('update/personalinfo', 'DriverController@updateDriverPersonalInformation'); //Profile status 2
    Route::post('update/shippingadress', 'DriverShippingAddressController@DriverShippingAddress'); //Profile status 3
    Route::post('update/document', 'DriverShippingAddressController@DriverDocument'); //Profile status 4
    Route::post('update/bankinfo', 'DriverShippingAddressController@DriverBankInfo'); //Profile status 5
    Route::post('update/drivertype', 'DriverController@updateDriverType'); //Profile status 6
    Route::post('update/profile_pic', 'DriverController@addProfilePic'); //Profile status 7
    Route::post('update/location', 'DriverLocationController@DriverLocation');
    Route::post('view/request', 'RequestController@viewrequest');
    Route::post('accept/request', 'RequestController@taptodrive');
});