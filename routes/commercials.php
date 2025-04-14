<?php


use App\Http\Controllers\Commercials\Customers\CustomersController;
use App\Http\Controllers\Commercials\DashboardController;
use App\Http\Controllers\Commercials\PostalcodeController;
use App\Http\Controllers\Commercials\Settings\SettingsController;
use App\Http\Controllers\Commercials\Notes\NotesController;
use App\Http\Controllers\Commercials\Notes\Worksessions;
use App\Http\Controllers\Commercials\Statements\StatementsController;
use App\Http\Controllers\Commercials\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'commercial', 'middleware' => ['auth', 'roles:commercial']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('commercial.dashboard');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('commercial.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('commercial.settings.profile.update');
    });


    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('commercial.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('commercial.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('commercial.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('commercial.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('commercial.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('commercial.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('commercial.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('commercial.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('commercial.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('commercial.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('commercial.postalcodes.search');
    });


    Route::group(['prefix' => 'statements'], function () {

        Route::get('/', [StatementsController::class, 'index'])->name('commercial.statements');
        Route::get('/create', [StatementsController::class, 'create'])->name('commercial.statements.create');
        Route::get('/check', [StatementsController::class, 'check'])->name('commercial.statements.check');
        Route::get('/histories', [StatementsController::class, 'histories'])->name('commercial.statements.histories');
        Route::get('/validate', [StatementsController::class, 'validateByPhone'])->name('commercial.statements.validate');
        Route::post('/store', [StatementsController::class, 'store'])->name('commercial.statements.store');
        Route::post('/update', [StatementsController::class, 'update'])->name('commercial.statements.update');

        Route::get('/edit/{uid}', [StatementsController::class, 'edit'])->name('commercial.statements.edit');
        Route::get('/view/{uid}', [StatementsController::class, 'view'])->name('commercial.statements.view');
        Route::get('/status/{uid}', [StatementsController::class, 'status'])->name('commercial.statements.status');
        Route::get('/arrange/{uid}', [StatementsController::class, 'arrange'])->name('commercial.statements.arrange');
        Route::get('/generate/{uid}', [StatementsController::class, 'generate'])->name('commercial.statements.generate');
        Route::get('/reschedule/{uid}', [StatementsController::class, 'reschedule'])->name('commercial.statements.reschedule');
        Route::post('/arrange/annotation', [StatementsController::class, 'annotation'])->name('commercial.statements.annotation.store');
        Route::post('/arrange/statuses', [StatementsController::class, 'statuses'])->name('commercial.statements.statuses.store');

        Route::get('/bundle/{id}/content', [StatementsController::class, 'loadBundle'])->name('commercial.statements.bundle.content');



    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('commercial.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('commercial.notes.create');
        Route::get('/check', [NotesController::class, 'check'])->name('commercial.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('commercial.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('commercial.notes.validate');
        Route::post('/store', [NotesController::class, 'store'])->name('commercial.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('commercial.notes.update');

        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('commercial.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('commercial.notes.view');
        Route::get('/status/{uid}', [NotesController::class, 'status'])->name('commercial.notes.status');
        Route::get('/arrange/{uid}', [NotesController::class, 'arrange'])->name('commercial.notes.arrange');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('commercial.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('commercial.notes.reschedule');

        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('commercial.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('commercial.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('commercial.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('commercial.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('commercial.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('commercial.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('commercial.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('commercial.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('commercial.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('commercial.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('commercial.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('commercial.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('commercial.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('commercial.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('commercial.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('commercial.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('commercial.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('commercial.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('commercial.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('commercial.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('commercial.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('commercial.notes.notes.delete');

        Route::post('/employeesreplyingremove', 'AdminTicketController@employeesreplyingremove')->name('employeesreplyingremove');
        Route::post('/employeesreplyingstore', 'AdminTicketController@employeesreplyingstore')->name('employeesreplyingstore');
        Route::get('/getemployeesreplying/{id}', 'AdminTicketController@getemployeesreplying')->name('getemployeesreplying');
        Route::get('/ticket/{ticket_id}', 'AdminTicketController@destroy');
        Route::post('/priority/change/', 'AdminTicketController@changepriority');
        Route::get('/ticket/delete/notes', 'AdminTicketController@ticketmassdestroy')->name('admin.ticket.sremove');
        Route::get('/ticket-view/{ticket_id}', 'AdminTicketController@show')->name('admin.noteshow');
        Route::post('/ticket-comment/{ticket_id}', 'AdminTicketController@commentshow')->name('admin.ticketcomment');

        Route::post('/closed/{ticket_id}', 'AdminTicketController@close');
        Route::get('/delete-ticket/{id}', 'AdminTicketController@destroy');

        Route::get('/createticket', 'AdminTicketController@createticket');
        Route::post('/createticket', 'AdminTicketController@gueststore');
        Route::post('/imageupload', 'AdminTicketController@guestmedia')->name('imageuploadadmin');
        Route::get('/allnotes', 'AdminTicketController@allnotes')->name('admin.allnotes');

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('commercial.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('commercial.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('commercial.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('commercial.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('commercial.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('commercial.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('commercial.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('commercial.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('commercial.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('commercial.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('commercial.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('commercial.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('commercial.notes.history.users');

    });

});
