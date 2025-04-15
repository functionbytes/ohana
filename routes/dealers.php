<?php


use App\Http\Controllers\Dealers\Customers\CustomersController;
use App\Http\Controllers\Dealers\DashboardController;
use App\Http\Controllers\Dealers\PostalcodeController;
use App\Http\Controllers\Dealers\Settings\SettingsController;
use App\Http\Controllers\Dealers\Notes\NotesController;
use App\Http\Controllers\Dealers\Notes\Worksessions;
use App\Http\Controllers\Dealers\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dealer', 'middleware' => ['auth', 'roles:dealer']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('dealer.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('dealer.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('dealer.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('dealer.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('dealer.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('dealer.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('dealer.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('dealer.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('dealer.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('dealer.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('dealer.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('dealer.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('dealer.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('dealer.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('dealer.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('dealer.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('dealer.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('dealer.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('dealer.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('dealer.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('dealer.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('dealer.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('dealer.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('dealer.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('dealer.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('dealer.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('dealer.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('dealer.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('dealer.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('dealer.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('dealer.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('dealer.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('dealer.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('dealer.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('dealer.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('dealer.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('dealer.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('dealer.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('dealer.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('dealer.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('dealer.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('dealer.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('dealer.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('dealer.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('dealer.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('dealer.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('dealer.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('dealer.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('dealer.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('dealer.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('dealer.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('dealer.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('dealer.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('dealer.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('dealer.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('dealer.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('dealer.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('dealer.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('dealer.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('dealer.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('dealer.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('dealer.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('dealer.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('dealer.notes.history.users');

    });

});
