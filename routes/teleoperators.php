<?php


use App\Http\Controllers\Teleoperators\Customers\CustomersController;
use App\Http\Controllers\Teleoperators\DashboardController;
use App\Http\Controllers\Teleoperators\PostalcodeController;
use App\Http\Controllers\Teleoperators\Settings\SettingsController;
use App\Http\Controllers\Teleoperators\Notes\NotesController;
use App\Http\Controllers\Teleoperators\Notes\Worksessions;
use App\Http\Controllers\Teleoperators\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'teleoperator', 'middleware' => ['auth', 'roles:teleoperator']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('teleoperator.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('teleoperator.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('teleoperator.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('teleoperator.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('teleoperator.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('teleoperator.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('teleoperator.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('teleoperator.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('teleoperator.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('teleoperator.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('teleoperator.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('teleoperator.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('teleoperator.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('teleoperator.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('teleoperator.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('teleoperator.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('teleoperator.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('teleoperator.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('teleoperator.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('teleoperator.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('teleoperator.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('teleoperator.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('teleoperator.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('teleoperator.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('teleoperator.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('teleoperator.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('teleoperator.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('teleoperator.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('teleoperator.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('teleoperator.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('teleoperator.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('teleoperator.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('teleoperator.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('teleoperator.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('teleoperator.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('teleoperator.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('teleoperator.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('teleoperator.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('teleoperator.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('teleoperator.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('teleoperator.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('teleoperator.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('teleoperator.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('teleoperator.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('teleoperator.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('teleoperator.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('teleoperator.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('teleoperator.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('teleoperator.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('teleoperator.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('teleoperator.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('teleoperator.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('teleoperator.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('teleoperator.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('teleoperator.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('teleoperator.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('teleoperator.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('teleoperator.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('teleoperator.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('teleoperator.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('teleoperator.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('teleoperator.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('teleoperator.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('teleoperator.notes.history.users');

    });

});
