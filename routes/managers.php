<?php

use App\Http\Controllers\Managers\Automations\AutomationsController;
use App\Http\Controllers\Managers\Campaigns\CampaignsController;
use App\Http\Controllers\Managers\DashboardController;
use App\Http\Controllers\Managers\Delegations\DelegationsController;
use App\Http\Controllers\Managers\Delegations\LocationsController as DelegationsLocationController;

use App\Http\Controllers\Managers\Inventaries\InventariesController;
use App\Http\Controllers\Managers\Inventaries\LocationssController as InventariesLocationsController;
use App\Http\Controllers\Managers\Products\BarcodeController as ProductsBarcodesController;
use App\Http\Controllers\Managers\Products\ReportController;
use App\Http\Controllers\Managers\Settings\MantenanceSettingsController;
use App\Http\Controllers\Managers\Settings\SettingsController;
use App\Http\Controllers\Managers\Users\UsersController;
use App\Http\Controllers\Managers\PulseController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'roles:manager']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('manager.dashboard');


    Route::group(['prefix' => 'pulse'], function () {
        Route::get('/', [PulseController::class, 'dashboard'])->name('manager.pulse');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('/validate', [DelegationsController::class, 'validate'])->name('manager.products');
        Route::get('/validate/products', [DelegationsController::class, 'validateProductShop'])->name('manager.products.shop');
        Route::get('/validate/productss', [DelegationsController::class, 'validateProductShops'])->name('manager.products.shop');
        Route::get('/validate/apps', [DelegationsController::class, 'validateManagement'])->name('manager.products.apps');

        Route::get('/', [DelegationsController::class, 'index'])->name('manager.products');
        Route::get('/all/barcode', [ProductsBarcodesController::class, 'index'])->name('manager.products.barcodes.all');
        Route::get('/reporte/generate/inventary', [ReportController::class, 'generateInventary'])->name('manager.products.generate.inventary');
        Route::get('/reporte/generate/kardex', [ReportController::class, 'generateKardex'])->name('manager.products.generate.kardex');
        Route::get('/create', [DelegationsController::class, 'create'])->name('manager.products.create');
        Route::post('/store', [DelegationsController::class, 'store'])->name('manager.products.store');
        Route::post('/update', [DelegationsController::class, 'update'])->name('manager.products.update');
        Route::get('/edit/{uid}', [DelegationsController::class, 'edit'])->name('manager.products.edit');
        Route::get('/view/{uid}', [DelegationsController::class, 'view'])->name('manager.locations.view');
        Route::get('/destroy/{uid}', [DelegationsController::class, 'destroy'])->name('manager.products.destroy');

        Route::get('/locations/{uid}', [DelegationsController::class, 'locations'])->name('manager.products.locations');
        Route::get('/locations/details/{uid}', [DelegationsController::class, 'details'])->name('manager.products.locations.details');

        Route::get('/single/barcode/{uid}', [ProductsBarcodesController::class, 'destroy'])->name('manager.products.barcodes.single');
    });

    Route::group(['prefix' => 'inventaries'], function () {

        Route::get('/', [InventariesController::class, 'index'])->name('manager.inventaries');
        Route::get('/create', [InventariesController::class, 'create'])->name('manager.inventaries.create');
        Route::post('/update', [InventariesController::class, 'update'])->name('manager.inventaries.update');
        Route::get('/edit/{uid}', [InventariesController::class, 'edit'])->name('manager.inventaries.edit');
        Route::get('/view/{uid}', [InventariesController::class, 'view'])->name('manager.inventaries.view');
        Route::get('/destroy/{uid}', [InventariesController::class, 'destroy'])->name('manager.inventaries.destroy');
        Route::get('/report/{uid}', [InventariesController::class, 'report'])->name('manager.inventaries.report');

        Route::get('/historys/{uid}', [TemplatesController::class, 'index'])->name('manager.inventaries.historys');
        Route::get('/history/edit/{uid}', [TemplatesController::class, 'edit'])->name('manager.historys.edit');
        Route::get('/history/destroy/{uid}', [TemplatesController::class, 'destroy'])->name('manager.historys.destroy');
        Route::get('/history/update', [TemplatesController::class, 'update'])->name('manager.historys.update');

        Route::get('/historys/locations/{uid}', [InventariesLocationsController::class, 'index'])->name('manager.inventaries.locations');
        Route::get('/history/locations/details/{uid}', [InventariesLocationsController::class, 'details'])->name('manager.inventaries.locations.details');
        Route::get('/history/locations/edit/{uid}', [InventariesLocationsController::class, 'edit'])->name('manager.inventaries.locations.edit');
        Route::get('/history/locations/destroy/{uid}', [InventariesLocationsController::class, 'destroy'])->name('manager.inventaries.locations.destroy');
        Route::post('/history/locations/update', [InventariesLocationsController::class, 'update'])->name('manager.inventaries.locations.update');

        Route::get('/history/locations/destroy/items/{uid}', [InventariesLocationsController::class, 'destroyItem'])->name('manager.historys.items.destroy');
        Route::get('/historys/locationss/{uid}', [InventariessLocationsController::class, 'index'])->name('manager.inventaries.locationss');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingsController::class, 'index'])->name('manager.settings');
        Route::post('/update', [SettingsController::class, 'update'])->name('manager.settings.update');
    });



    Route::group(['prefix' => 'delegations'], function () {

        Route::get('/', [DelegationsController::class, 'index'])->name('manager.delegations');
        Route::get('/create', [DelegationsController::class, 'create'])->name('manager.delegations.create');
        Route::post('/store', [DelegationsController::class, 'store'])->name('manager.delegations.store');
        Route::post('/update', [DelegationsController::class, 'update'])->name('manager.delegations.update');
        Route::get('/edit/{uid}', [DelegationsController::class, 'edit'])->name('manager.delegations.edit');
        Route::get('/view/{uid}', [DelegationsController::class, 'view'])->name('manager.delegations.view');
        Route::get('/destroy/{uid}', [DelegationsController::class, 'destroy'])->name('manager.delegations.destroy');
        Route::get('/navegation/{slack}', [DelegationsController::class, 'navegation'])->name('manager.delegations.navegation');

        Route::get('/locations/{slack}', [DelegationsLocationController::class, 'index'])->name('manager.delegations.locations');
        Route::get('/locations/create/{slack}', [DelegationsLocationController::class, 'create'])->name('manager.delegations.locations.create');
        Route::post('/locations/store', [DelegationsLocationController::class, 'store'])->name('manager.delegations.locations.store');
        Route::post('/locations/update', [DelegationsLocationController::class, 'update'])->name('manager.delegations.locations.update');
        Route::get('/locations/edit/{uid}', [DelegationsLocationController::class, 'edit'])->name('manager.delegations.locations.edit');
        Route::get('/locations/view/{uid}', [DelegationsLocationController::class, 'view'])->name('manager.delegations.locations.view');
        Route::get('/locations/destroy/{uid}', [DelegationsLocationController::class, 'destroy'])->name('manager.delegations.locations.destroy');
        Route::get('/locations/navegation/{slack}', [DelegationsLocationController::class, 'navegation'])->name('manager.delegations.locations.navegation');

        Route::get('/employess/{slack}', [DelegationsEmployeeController::class, 'index'])->name('manager.delegations.employees');
        Route::post('/employess/store', [DelegationsEmployeeController::class, 'store'])->name('manager.delegations.employess.store');
        Route::post('/employess/update', [DelegationsEmployeeController::class, 'update'])->name('manager.delegations.employess.update');
        Route::get('/employess/create/{slack}', [DelegationsEmployeeController::class, 'create'])->name('manager.delegations.employess.create');
        Route::get('/employess/edit/{slack}', [DelegationsEmployeeController::class, 'edit'])->name('manager.delegations.employess.edit');
        Route::get('/employess/view/{slack}', [DelegationsEmployeeController::class, 'view'])->name('manager.delegations.employess.view');
        Route::get('/employess/reports/{slack}', [DelegationsEmployeeController::class, 'reports'])->name('manager.delegations.employess.reports');
        Route::get('/employess/destroy/{slack}', [DelegationsEmployeeController::class, 'destroy'])->name('manager.delegations.staffs.destroy');
        Route::get('/employess/history/{slack}', [DelegationsEmployeeController::class, 'history'])->name('manager.delegations.employess.history');

        Route::get('/notes/{slack}', [DelegationsNoteController::class, 'index'])->name('manager.delegations.notes');
        Route::get('/notes/create', [DelegationsNoteController::class, 'create'])->name('manager.delegations.notes.create');
        Route::post('/notes/store', [DelegationsNoteController::class, 'store'])->name('manager.delegations.notes.store');
        Route::post('/notes/update', [DelegationsNoteController::class, 'update'])->name('manager.delegations.notes.update');
        Route::get('/notes/edit/{uid}', [DelegationsNoteController::class, 'edit'])->name('manager.delegations.notes.edit');
        Route::get('/notes/view/{uid}', [DelegationsNoteController::class, 'view'])->name('manager.delegations.notes.view');
        Route::get('/notes/destroy/{uid}', [DelegationsNoteController::class, 'destroy'])->name('manager.delegations.notes.destroy');

        Route::get('/customers/{slack}', [DelegationsCustomerController::class, 'index'])->name('manager.delegations.customers');
        Route::get('/customers/create', [DelegationsCustomerController::class, 'create'])->name('manager.delegations.customers.create');
        Route::post('/customers/store', [DelegationsCustomerController::class, 'store'])->name('manager.delegations.customers.store');
        Route::post('/customers/update', [DelegationsCustomerController::class, 'update'])->name('manager.delegations.customers.update');
        Route::get('/customers/edit/{uid}', [DelegationsCustomerController::class, 'edit'])->name('manager.delegations.customers.edit');
        Route::get('/customers/view/{uid}', [DelegationsCustomerController::class, 'view'])->name('manager.delegations.customers.view');
        Route::get('/customers/destroy/{uid}', [DelegationsCustomerController::class, 'destroy'])->name('manager.delegations.customers.destroy');



    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('manager.users');
        Route::get('/create', [UsersController::class, 'create'])->name('manager.users.create');
        Route::post('/store', [UsersController::class, 'store'])->name('manager.users.store');
        Route::post('/update', [UsersController::class, 'update'])->name('manager.users.update');
        Route::get('/edit/{uid}', [UsersController::class, 'edit'])->name('manager.users.edit');
        Route::get('/view/{uid}', [UsersController::class, 'view'])->name('manager.users.view');
        Route::get('/destroy/{uid}', [UsersController::class, 'destroy'])->name('manager.users.destroy');
    });

    Route::group(['prefix' => 'settings'], function () {

        Route::get('/', [SettingsController::class, 'index'])->name('manager.settings');
        Route::post('/update', [SettingsController::class, 'update'])->name('manager.settings.update');

        Route::post('/favicon', [SettingsController::class, 'storeFavicon'])->name('manager.settings.favicon');
        Route::get('/delete/favicon/{id}', [SettingsController::class, 'deleteFavicon'])->name('manager.settings.favicon.delete');
        Route::get('/get/favicon/{id}', [SettingsController::class, 'getFavicon'])->name('manager.settings.favicon.get');

        Route::post('/logo', [SettingsController::class, 'storeLogo'])->name('manager.settings.logo');
        Route::get('/delete/logo/{id}', [SettingsController::class, 'deleteLogo'])->name('manager.settings.logo.delete');
        Route::get('/get/logo/{id}', [SettingsController::class, 'getLogo'])->name('manager.settings.logo.get');

        Route::get('/maintenance', [MantenanceSettingsController::class, 'index'])->name('manager.settings.maintenance');
        Route::post('/maintenance/update', [MantenanceSettingsController::class, 'update'])->name('manager.settings.maintenance.update');

    });


    Route::group(['prefix' => 'settings'], function () {

        Route::get('/', [SettingsController::class, 'index'])->name('manager.settings');
        Route::post('/update', [SettingsController::class, 'update'])->name('manager.settings.update');

        Route::post('/favicon', [SettingsController::class, 'storeFavicon'])->name('manager.settings.favicon');
        Route::get('/delete/favicon/{id}', [SettingsController::class, 'deleteFavicon'])->name('manager.settings.favicon.delete');
        Route::get('/get/favicon/{id}', [SettingsController::class, 'getFavicon'])->name('manager.settings.favicon.get');

        Route::post('/logo', [SettingsController::class, 'storeLogo'])->name('manager.settings.logo');
        Route::get('/delete/logo/{id}', [SettingsController::class, 'deleteLogo'])->name('manager.settings.logo.delete');
        Route::get('/get/logo/{id}', [SettingsController::class, 'getLogo'])->name('manager.settings.logo.get');

        Route::get('/maintenance', [MantenanceSettingsController::class, 'index'])->name('manager.settings.maintenance');
        Route::post('/maintenance/update', [MantenanceSettingsController::class, 'update'])->name('manager.settings.maintenance.update');

        Route::get('/tickets', [TicketsSettingsController::class, 'index'])->name('manager.settings.tickets');
        Route::post('/tickets/update', [TicketsSettingsController::class, 'update'])->name('manager.settings.tickets.update');

        Route::get('/lives', [LiveSettingsController::class, 'index'])->name('manager.settings.lives');
        Route::post('/lives/update', [LiveSettingsController::class, 'update'])->name('manager.settings.lives.update');

        Route::get('/emails', [EmailsSettingsController::class, 'index'])->name('manager.settings.emails');
        Route::post('/emails/update', [EmailsSettingsController::class, 'update'])->name('manager.settings.emails.update');

        Route::get('/hours', [HoursSettingsController::class, 'index'])->name('manager.settings.hours');
        Route::post('/hours/update', [HoursSettingsController::class, 'update'])->name('manager.settings.hours.update');

    });



});
