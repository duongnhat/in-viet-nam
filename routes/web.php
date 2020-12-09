<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/customer/tao-khach-hang');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('tao-khach-hang', 'Admin\CustomerController@registerForm')->name('customer.trang-tao-moi-khach-hang');
        Route::post('tao-khach-hang', 'Admin\CustomerController@register')->name('customer.api-tao-moi-khach-hang');
    });
});
