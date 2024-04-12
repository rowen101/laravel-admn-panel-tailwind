<?php

use Inertia\Inertia;

Route::group([
    'namespace' => 'App\Http\Controllers\Wms',
    'prefix' => config('wms.prefix'),
    'middleware' => ['auth'],
    'as' => 'wms.',
], function () {
    Route::get('/', function () {
        return Inertia::render('Wms/Dashboard');
    })->name('dashboard');
    Route::resource('customer-master', 'CustomerMasController');


});
