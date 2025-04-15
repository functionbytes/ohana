<?php


use App\Http\Controllers\Salesmanagers\Customers\CustomersController;
use App\Http\Controllers\Salesmanagers\DashboardController;
use App\Http\Controllers\Salesmanagers\PostalcodeController;
use App\Http\Controllers\Salesmanagers\Settings\SettingsController;
use App\Http\Controllers\Salesmanagers\Notes\NotesController;
use App\Http\Controllers\Salesmanagers\Notes\Worksessions;
use App\Http\Controllers\Salesmanagers\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'salesmanager', 'middleware' => ['auth', 'roles:salesmanager']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('salesmanager.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('salesmanager.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('salesmanager.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('salesmanager.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('salesmanager.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('salesmanager.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('salesmanager.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('salesmanager.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('salesmanager.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('salesmanager.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('salesmanager.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('salesmanager.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('salesmanager.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('salesmanager.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('salesmanager.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('salesmanager.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('salesmanager.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('salesmanager.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('salesmanager.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('salesmanager.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('salesmanager.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('salesmanager.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('salesmanager.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('salesmanager.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('salesmanager.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('salesmanager.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('salesmanager.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('salesmanager.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('salesmanager.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('salesmanager.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('salesmanager.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('salesmanager.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('salesmanager.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('salesmanager.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('salesmanager.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('salesmanager.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('salesmanager.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('salesmanager.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('salesmanager.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('salesmanager.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('salesmanager.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('salesmanager.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('salesmanager.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('salesmanager.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('salesmanager.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('salesmanager.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('salesmanager.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('salesmanager.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('salesmanager.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('salesmanager.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('salesmanager.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('salesmanager.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('salesmanager.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('salesmanager.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('salesmanager.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('salesmanager.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('salesmanager.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('salesmanager.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('salesmanager.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('salesmanager.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('salesmanager.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('salesmanager.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('salesmanager.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('salesmanager.notes.history.users');

    });

});
