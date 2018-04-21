<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('signupride');
})->name('home');


Route::post('/login/auth', 'AuthenticateController@auth')->name('login.auth');
Route::get('/login/show_verify', 'AuthenticateController@show_verify')->name('login.show_verify');
Route::post('/login/login_otp', 'AuthenticateController@login_otp')->name('login.login_otp');

//For Guset user check login or not
Route::group(['middleware' => 'CheckAuthGuest'], function() {
    Route::get('/login', 'AuthenticateController@index')->name('login');
    Route::resource('driver', 'DriverauthController');
    Route::resource('user', 'UserauthController');
    Route::patch('driver/verify_otp/{id}', 'DriverauthController@verify_otp')->name('driver.verify_otp');

    Route::get('driverinfo/personal_info/', 'DriverInfoController@personal_info')->name('driverinfo.personal_info');
    Route::post('driverinfo/store_personal_info/', 'DriverInfoController@store_personal_info')->name('driverinfo.store_personal_info');
    Route::post('driverinfo/store_shipping_address/', 'DriverInfoController@store_shipping_address')->name('driverinfo.store_shipping_address');
    Route::post('driverinfo/store_bank_info/', 'DriverInfoController@store_bank_info')->name('driverinfo.store_bank_info');
    Route::post('driverinfo/store_profile_photo/', 'DriverInfoController@store_profile_photo')->name('driverinfo.store_profile_photo');
    Route::post('driverinfo/store_driver_document/', 'DriverInfoController@store_driver_document')->name('driverinfo.store_driver_document');
    Route::post('driverinfo/store_driver_type/', 'DriverInfoController@store_driver_type')->name('driverinfo.store_driver_type');
    Route::get('driverinfo/done/', 'DriverInfoController@done')->name('driverinfo.done');
});
//For dashboard
Route::group(['middleware' => 'CheckAuth'], function() {
    Route::get('account/{dashboard}', 'AuthenticateController@account')->name('account.account_dashboard');
    Route::get('account/{driving_history}', 'AuthenticateController@account')->name('account.driving_history');
    Route::get('account/{documents}', 'AuthenticateController@account')->name('account.documents');
    Route::get('account/{payment}', 'AuthenticateController@account')->name('account.payment');
    Route::get('account/{reward}', 'AuthenticateController@account')->name('account.reward');
    Route::get('account/{setting}', 'AuthenticateController@account')->name('account.setting');
    Route::post('store/document', 'DashboardController@store_document')->name('account.store_document');
    Route::post('store/profile', 'DashboardController@store_profile_data')->name('account.store_profile_data');
    Route::post('store/driver_type', 'DashboardController@store_driver_type')->name('account.store_driver_type');
    Route::post('store/bank_info', 'DashboardController@store_bank_info')->name('account.store_bank_info');

    Route::get('logout', 'AuthenticateController@logout')->name('logout');
});

//Admin routes
Route::get('admin', 'Admin\AdminController@index')->name('admin.index');
Route::post('admin/store', 'Admin\AdminController@store')->name('admin.store');
Route::get('admin/account/logout', 'Admin\AdminController@logout')->name('admin.logout');
Route::get('admin/fetchvehicles', 'Admin\VehicleController@fetchVehicleManufacturers');
Route::get('admin/fetchall', 'Admin\VehicleController@fetchAll');
//Route::get('admin/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');


Route::middleware('Admin')->prefix('admin')->namespace('Admin')->name('admin.')->group(function() {
    Route::resource('user', 'UserListController');
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('user/ajax/userarray', 'UserListController@userarray')->name('user.ajax.userarray');

    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('driver', 'DriverListingController');
    Route::get('driver/ajax/update_status', 'DriverListingController@updateStatus');
    Route::get('driver/ajax/driverarray', 'DriverListingController@driverarray')->name('driver.ajax.driverarray');
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('rates', 'UsaRatesController');
    Route::patch('rates/update/', 'UsaRatesController@update');
    //new Driver Application
    Route::resource('newdriver', 'NewDriverApplicationController');
    Route::get('newdriver/ajax/driverarray', 'NewDriverApplicationController@newdriverarray')->name('newdriver.ajax.newdriverarray');
    Route::get('driver/ajax/update_status', 'NewDriverApplicationController@newDriverChangeStatus')->name('newdriver.ajax.newDriverChangeStatus');
});
