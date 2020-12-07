<?php
$namespace = 'App\Modules\Admin\Controllers';
Route::group(['module' => 'Admin', 'namespace' => $namespace],
    function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::group(['prefix' => 'customer'], function () {
                Route::get('tao-khach-hang', 'CustomerController@newForm')->name('customer.newForm');
            });
        });
    }
);
