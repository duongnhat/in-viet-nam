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

Route::get('login', 'auth\LoginController@loginPage')->name('auth.trang-login');
Route::post('login', 'auth\LoginController@login')->name('auth.post-trang-login');
Route::get('logout', 'auth\LoginController@logout')->name('auth.post-trang-logout');

Route::get('trang-chu', 'Business\PrintController@home')->name('business.trang-chu');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('theo-doi-thong-tin-khach-hang', 'Admin\CustomerController@listPage')->name('customer.theo-doi-thong-tin-khach-hang');
        Route::get('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@registerForm')->name('customer.dang-ky-thong-tin-khach-hang');
        Route::post('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@register')->name('customer.post-dang-ky-thong-tin-khach-hang');
        Route::get('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@updateForm')->name('customer.thay-doi-thong-tin-khach-hang');
        Route::post('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@update')->name('customer.post-thay-doi-thong-tin-khach-hang');
        Route::get('delete/{id}', 'Admin\CustomerController@delete')->name('customer.xoa-thong-tin-khach-hang');
    });

    Route::group(['prefix' => 'folder'], function () {
        Route::get('quan-ly-thu-muc', 'Admin\FolderController@listPage')->name('folder.quan-ly-thu-muc');
        Route::get('tao-moi-thu-muc', 'Admin\FolderController@registerForm')->name('folder.tao-moi-thu-muc');
        Route::post('tao-moi-thu-muc', 'Admin\FolderController@register')->name('folder.post-tao-moi-thu-muc');
        Route::get('chinh-sua-thu-muc/{id}', 'Admin\FolderController@updateForm')->name('folder.chinh-sua-thu-muc');
        Route::post('chinh-sua-thu-muc/{id}', 'Admin\FolderController@update')->name('folder.post-chinh-sua-thu-muc');
        Route::get('delete/{id}', 'Admin\FolderController@delete')->name('folder.xoa-thu-muc');
    });
});
