<?php
$namespace = 'App\Modules\Admin\Controllers';
Route::group(['module' => 'Admin', 'namespace' => $namespace],
    function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', 'HomeController@index')->name('admin.home');
        });
    }
);
