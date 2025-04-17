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


use App\Http\Controllers\Managers\Settings\Statements\AccessoriesController as StatementsAccessoriesController;
use App\Http\Controllers\Managers\Settings\Statements\CreamsController as StatementsCreamsController;
use App\Http\Controllers\Managers\Settings\Statements\EmploymentsController as StatementsEmploymentsController;
use App\Http\Controllers\Managers\Settings\Statements\HousingsController as StatementsHousingsController;
use App\Http\Controllers\Managers\Settings\Statements\IncidentSchedulesController as StatementsIncidentSchedulesController;
use App\Http\Controllers\Managers\Settings\Statements\IncidentSoldsController as StatementsIncidentSoldsController;
use App\Http\Controllers\Managers\Settings\Statements\MaritalsController as StatementsMaritalsController;
use App\Http\Controllers\Managers\Settings\Statements\MethodsController as StatementsMethodsController;
use App\Http\Controllers\Managers\Settings\Statements\ModalitiesController as StatementsModalitiesController;
use App\Http\Controllers\Managers\Settings\Statements\PaymentsController as StatementsPaymentsController;
use App\Http\Controllers\Managers\Settings\Statements\RelationshipsController as StatementsRelationshipsController;



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


        Route::prefix('statement/accessories')->group(function () {
            Route::get('/', [StatementsAccessoriesController::class, 'index'])->name('manager.settings.statements.accessories');
            Route::get('/create', [StatementsAccessoriesController::class, 'create'])->name('manager.settings.statements.accessories.create');
            Route::post('/store', [StatementsAccessoriesController::class, 'store'])->name('manager.settings.statements.accessories.store');
            Route::post('/update', [StatementsAccessoriesController::class, 'update'])->name('manager.settings.statements.accessories.update');
            Route::get('/edit/{uid}', [StatementsAccessoriesController::class, 'edit'])->name('manager.settings.statements.accessories.edit');
            Route::get('/destroy/{uid}', [StatementsAccessoriesController::class, 'destroy'])->name('manager.settings.statements.accessories.destroy');
        });

        Route::prefix('statement/creams')->group(function () {
            Route::get('/', [StatementsCreamsController::class, 'index'])->name('manager.settings.statements.creams');
            Route::get('/create', [StatementsCreamsController::class, 'create'])->name('manager.settings.statements.creams.create');
            Route::post('/store', [StatementsCreamsController::class, 'store'])->name('manager.settings.statements.creams.store');
            Route::post('/update', [StatementsCreamsController::class, 'update'])->name('manager.settings.statements.creams.update');
            Route::get('/edit/{uid}', [StatementsCreamsController::class, 'edit'])->name('manager.settings.statements.creams.edit');
            Route::get('/destroy/{uid}', [StatementsCreamsController::class, 'destroy'])->name('manager.settings.statements.creams.destroy');
        });

        Route::prefix('statement/employments')->group(function () {
            Route::get('/', [StatementsEmploymentsController::class, 'index'])->name('manager.settings.statements.employments');
            Route::get('/create', [StatementsEmploymentsController::class, 'create'])->name('manager.settings.statements.employments.create');
            Route::post('/store', [StatementsEmploymentsController::class, 'store'])->name('manager.settings.statements.employments.store');
            Route::post('/update', [StatementsEmploymentsController::class, 'update'])->name('manager.settings.statements.employments.update');
            Route::get('/edit/{uid}', [StatementsEmploymentsController::class, 'edit'])->name('manager.settings.statements.employments.edit');
            Route::get('/destroy/{uid}', [StatementsEmploymentsController::class, 'destroy'])->name('manager.settings.statements.employments.destroy');
        });

        Route::prefix('statement/housings')->group(function () {
            Route::get('/', [StatementsHousingsController::class, 'index'])->name('manager.settings.statements.housings');
            Route::get('/create', [StatementsHousingsController::class, 'create'])->name('manager.settings.statements.housings.create');
            Route::post('/store', [StatementsHousingsController::class, 'store'])->name('manager.settings.statements.housings.store');
            Route::post('/update', [StatementsHousingsController::class, 'update'])->name('manager.settings.statements.housings.update');
            Route::get('/edit/{uid}', [StatementsHousingsController::class, 'edit'])->name('manager.settings.statements.housings.edit');
            Route::get('/destroy/{uid}', [StatementsHousingsController::class, 'destroy'])->name('manager.settings.statements.housings.destroy');
        });

        Route::prefix('statement/incident_schedules')->group(function () {
            Route::get('/', [StatementsIncidentSchedulesController::class, 'index'])->name('manager.settings.statements.incident_schedules');
            Route::get('/create', [StatementsIncidentSchedulesController::class, 'create'])->name('manager.settings.statements.incident_schedules.create');
            Route::post('/store', [StatementsIncidentSchedulesController::class, 'store'])->name('manager.settings.statements.incident_schedules.store');
            Route::post('/update', [StatementsIncidentSchedulesController::class, 'update'])->name('manager.settings.statements.incident_schedules.update');
            Route::get('/edit/{uid}', [StatementsIncidentSchedulesController::class, 'edit'])->name('manager.settings.statements.incident_schedules.edit');
            Route::get('/destroy/{uid}', [StatementsIncidentSchedulesController::class, 'destroy'])->name('manager.settings.statements.incident_schedules.destroy');
        });

        Route::prefix('statement/incident_solds')->group(function () {
            Route::get('/', [StatementsIncidentSoldsController::class, 'index'])->name('manager.settings.statements.incident_solds');
            Route::get('/create', [StatementsIncidentSoldsController::class, 'create'])->name('manager.settings.statements.incident_solds.create');
            Route::post('/store', [StatementsIncidentSoldsController::class, 'store'])->name('manager.settings.statements.incident_solds.store');
            Route::post('/update', [StatementsIncidentSoldsController::class, 'update'])->name('manager.settings.statements.incident_solds.update');
            Route::get('/edit/{uid}', [StatementsIncidentSoldsController::class, 'edit'])->name('manager.settings.statements.incident_solds.edit');
            Route::get('/destroy/{uid}', [StatementsIncidentSoldsController::class, 'destroy'])->name('manager.settings.statements.incident_solds.destroy');
        });

        Route::prefix('statement/maritals')->group(function () {
            Route::get('/', [StatementsMaritalsController::class, 'index'])->name('manager.settings.statements.maritals');
            Route::get('/create', [StatementsMaritalsController::class, 'create'])->name('manager.settings.statements.maritals.create');
            Route::post('/store', [StatementsMaritalsController::class, 'store'])->name('manager.settings.statements.maritals.store');
            Route::post('/update', [StatementsMaritalsController::class, 'update'])->name('manager.settings.statements.maritals.update');
            Route::get('/edit/{uid}', [StatementsMaritalsController::class, 'edit'])->name('manager.settings.statements.maritals.edit');
            Route::get('/destroy/{uid}', [StatementsMaritalsController::class, 'destroy'])->name('manager.settings.statements.maritals.destroy');
        });

        Route::prefix('statement/methods')->group(function () {
            Route::get('/', [StatementsMethodsController::class, 'index'])->name('manager.settings.statements.methods');
            Route::get('/create', [StatementsMethodsController::class, 'create'])->name('manager.settings.statements.methods.create');
            Route::post('/store', [StatementsMethodsController::class, 'store'])->name('manager.settings.statements.methods.store');
            Route::post('/update', [StatementsMethodsController::class, 'update'])->name('manager.settings.statements.methods.update');
            Route::get('/edit/{uid}', [StatementsMethodsController::class, 'edit'])->name('manager.settings.statements.methods.edit');
            Route::get('/destroy/{uid}', [StatementsMethodsController::class, 'destroy'])->name('manager.settings.statements.methods.destroy');
        });

        Route::prefix('statement/modalities')->group(function () {
            Route::get('/', [StatementsModalitiesController::class, 'index'])->name('manager.settings.statements.modalities');
            Route::get('/create', [StatementsModalitiesController::class, 'create'])->name('manager.settings.statements.modalities.create');
            Route::post('/store', [StatementsModalitiesController::class, 'store'])->name('manager.settings.statements.modalities.store');
            Route::post('/update', [StatementsModalitiesController::class, 'update'])->name('manager.settings.statements.modalities.update');
            Route::get('/edit/{uid}', [StatementsModalitiesController::class, 'edit'])->name('manager.settings.statements.modalities.edit');
            Route::get('/destroy/{uid}', [StatementsModalitiesController::class, 'destroy'])->name('manager.settings.statements.modalities.destroy');
        });

        Route::prefix('statement/payments')->group(function () {
            Route::get('/', [StatementsPaymentsController::class, 'index'])->name('manager.settings.statements.payments');
            Route::get('/create', [StatementsPaymentsController::class, 'create'])->name('manager.settings.statements.payments.create');
            Route::post('/store', [StatementsPaymentsController::class, 'store'])->name('manager.settings.statements.payments.store');
            Route::post('/update', [StatementsPaymentsController::class, 'update'])->name('manager.settings.statements.payments.update');
            Route::get('/edit/{uid}', [StatementsPaymentsController::class, 'edit'])->name('manager.settings.statements.payments.edit');
            Route::get('/destroy/{uid}', [StatementsPaymentsController::class, 'destroy'])->name('manager.settings.statements.payments.destroy');
        });

        Route::prefix('statement/relationships')->group(function () {
            Route::get('/', [StatementsRelationshipsController::class, 'index'])->name('manager.settings.statements.relationships');
            Route::get('/create', [StatementsRelationshipsController::class, 'create'])->name('manager.settings.statements.relationships.create');
            Route::post('/store', [StatementsRelationshipsController::class, 'store'])->name('manager.settings.statements.relationships.store');
            Route::post('/update', [StatementsRelationshipsController::class, 'update'])->name('manager.settings.statements.relationships.update');
            Route::get('/edit/{uid}', [StatementsRelationshipsController::class, 'edit'])->name('manager.settings.statements.relationships.edit');
            Route::get('/destroy/{uid}', [StatementsRelationshipsController::class, 'destroy'])->name('manager.settings.statements.relationships.destroy');
        });

    });



});
