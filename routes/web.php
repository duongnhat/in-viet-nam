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
    return redirect('admin/customer/theo-doi-thong-tin-khach-hang');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@registerForm')->name('customer.dang-ky-thong-tin-khach-hang');
        Route::post('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@register')->name('customer.api-dang-ky-thong-tin-khach-hang');
        Route::get('theo-doi-thong-tin-khach-hang', 'Admin\CustomerController@list')->name('customer.theo-doi-thong-tin-khach-hang');
    });
});
