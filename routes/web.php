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
    return redirect('trang-chu');
});

Route::get('trang-chu', 'Business\PrintController@home')->name('customer.trang-chu');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('theo-doi-thong-tin-khach-hang', 'Admin\CustomerController@listPage')->name('customer.theo-doi-thong-tin-khach-hang');
        Route::get('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@registerForm')->name('customer.dang-ky-thong-tin-khach-hang');
        Route::post('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@register')->name('customer.api-dang-ky-thong-tin-khach-hang');
        Route::get('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@updateForm')->name('customer.thay-doi-thong-tin-khach-hang');
        Route::post('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@update')->name('customer.thay-doi-thong-tin-khach-hang');
        Route::get('delete/{id}', 'Admin\CustomerController@delete')->name('customer.xoa-thong-tin-khach-hang');
    });
});
