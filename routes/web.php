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
Route::group(['middleware' => 'load.common'], function () {

    Route::get('/', function () {
        return redirect('trang-chu');
    });

    Route::get('login', 'auth\LoginController@loginPage')->name('login');
    Route::post('login', 'auth\LoginController@login')->name('post-login');
    Route::get('logout', 'auth\LoginController@logout')->name('logout');

    Route::get('trang-chu', 'Business\HomeController@homePage')->name('business.trang-chu');

    Route::group(['prefix' => 'f'], function () {
        Route::get('/{id}/{nameFolder}', 'Business\FolderPageController@folderLevelPage')->name('business.thu-muc');
    });

    Route::group(['prefix' => 'pf'], function () {
        Route::get('/{folderId}/{currentProductId}/{nameFolder}', 'Business\ProductPageController@productByFolderPage')->name('business.san-pham');
    });

    Route::group(['prefix' => 'p'], function () {
        Route::get('/{productId}/{nameProduct}', 'Business\ProductPageController@productDetailPage')->name('business.chi-tiet-san-pham');
    });

    Route::group(['prefix' => 'rg'], function () {
        Route::get('{id}/dang-ky-thong-tin-san-pham', 'Business\RegisteredGuestController@registerForm')->name('registered-guest.dang-ky-thong-tin-san-pham');
        Route::post('{id}/dang-ky-thong-tin-san-pham', 'Business\RegisteredGuestController@register')->name('registered-guest.post-dang-ky-thong-tin-san-pham');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        Route::group(['prefix' => 'customer'], function () {
            Route::get('theo-doi-thong-tin-khach-hang', 'Admin\CustomerController@listPage')->name('customer.theo-doi-thong-tin-khach-hang');
            Route::get('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@registerForm')->name('customer.dang-ky-thong-tin-khach-hang');
            Route::post('dang-ky-thong-tin-khach-hang', 'Admin\CustomerController@register')->name('customer.post-dang-ky-thong-tin-khach-hang');
            Route::get('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@updateForm')->name('customer.thay-doi-thong-tin-khach-hang');
            Route::post('thay-doi-thong-tin-khach-hang/{id}', 'Admin\CustomerController@update')->name('customer.post-thay-doi-thong-tin-khach-hang');
            Route::get('delete/{id}', 'Admin\CustomerController@delete')->name('customer.xoa-thong-tin-khach-hang');
        });

        Route::group(['prefix' => 'folder'], function () {
            Route::get('quan-ly-thu-muc-cap-1', 'Admin\FolderController@listPage1')->name('folder.quan-ly-thu-muc-cap-1');
            Route::get('quan-ly-thu-muc-cap-2', 'Admin\FolderController@listPage2')->name('folder.quan-ly-thu-muc-cap-2');
            Route::get('tao-moi-thu-muc-cap-1', 'Admin\FolderController@registerForm1')->name('folder.tao-moi-thu-muc-cap-1');
            Route::get('tao-moi-thu-muc-cap-2', 'Admin\FolderController@registerForm2')->name('folder.tao-moi-thu-muc-cap-2');
            Route::post('tao-moi-thu-muc', 'Admin\FolderController@register')->name('folder.post-tao-moi-thu-muc');
            Route::get('chinh-sua-thu-muc/{id}', 'Admin\FolderController@updateForm')->name('folder.chinh-sua-thu-muc');
            Route::post('chinh-sua-thu-muc/{id}', 'Admin\FolderController@update')->name('folder.post-chinh-sua-thu-muc');
            Route::get('delete/{id}', 'Admin\FolderController@delete')->name('folder.xoa-thu-muc');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('quan-ly-san-pham', 'Admin\ProductController@listPage')->name('product.quan-ly-san-pham');
            Route::get('dang-ky-san-pham', 'Admin\ProductController@registerForm')->name('product.dang-ky-san-pham');
            Route::post('dang-ky-san-pham', 'Admin\ProductController@register')->name('product.post-dang-ky-san-pham');
            Route::get('thay-doi-san-pham/{id}', 'Admin\ProductController@updateForm')->name('product.thay-doi-san-pham');
            Route::post('thay-doi-san-pham/{id}', 'Admin\ProductController@update')->name('product.post-thay-doi-san-pham');
            Route::get('delete/{id}', 'Admin\ProductController@delete')->name('product.xoa-san-pham');
        });

        Route::group(['prefix' => 'registered-guest'], function () {
            Route::get('danh-sach-dang-ky-thong-tin-san-pham', 'Business\RegisteredGuestController@listPage')->name('registered-guest.danh-sach-dang-ky-thong-tin-san-pham');
            Route::get('change-status/{id}/{status}', 'Business\RegisteredGuestController@changeStatus')->name('registered-guest.thay-doi-trang-thai');
            Route::get('delete/{id}', 'Business\RegisteredGuestController@delete')->name('registered-guest.xoa');
        });

        Route::group(['prefix' => 'ad'], function () {
            Route::get('tao-bai-dang-mang-xa-hoi/{id}', 'Admin\AdvertisementController@createNewsProduct')->name('advertisement.tao-bai-dang-mang-xa-hoi');
            Route::post('luu-log-bai-post-facebook', 'Admin\AdvertisementController@saveLogFacebook')->name('advertisement.luu-log-bai-post-facebook');
            Route::post('luu-log-bai-post-zalo', 'Admin\AdvertisementController@saveLogZalo')->name('advertisement.luu-log-bai-post-zalo');
        });

        Route::group(['prefix' => 'pano'], function () {
            Route::get('quan-ly-pano', 'Admin\PanoController@listPage')->name('pano.quan-ly-pano');
            Route::get('them-pano', 'Admin\PanoController@registerForm')->name('pano.them-pano');
            Route::post('them-pano', 'Admin\PanoController@register')->name('pano.post-them-pano');
            Route::get('delete/{id}', 'Admin\PanoController@delete')->name('pano.xoa-pano');
        });
    });
});
