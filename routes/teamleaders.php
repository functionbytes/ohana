<?php


use App\Http\Controllers\Teamleaders\Customers\CustomersController;
use App\Http\Controllers\Teamleaders\DashboardController;
use App\Http\Controllers\Teamleaders\PostalcodeController;
use App\Http\Controllers\Teamleaders\Settings\SettingsController;
use App\Http\Controllers\Teamleaders\Notes\NotesController;
use App\Http\Controllers\Teamleaders\Notes\Worksessions;
use App\Http\Controllers\Teamleaders\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'teamleader', 'middleware' => ['auth', 'roles:teamleader']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('teamleader.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('teamleader.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('teamleader.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('teamleader.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('teamleader.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('teamleader.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('teamleader.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('teamleader.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('teamleader.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('teamleader.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('teamleader.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('teamleader.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('teamleader.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('teamleader.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('teamleader.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('teamleader.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('teamleader.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('teamleader.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('teamleader.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('teamleader.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('teamleader.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('teamleader.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('teamleader.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('teamleader.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('teamleader.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('teamleader.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('teamleader.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('teamleader.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('teamleader.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('teamleader.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('teamleader.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('teamleader.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('teamleader.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('teamleader.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('teamleader.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('teamleader.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('teamleader.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('teamleader.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('teamleader.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('teamleader.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('teamleader.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('teamleader.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('teamleader.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('teamleader.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('teamleader.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('teamleader.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('teamleader.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('teamleader.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('teamleader.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('teamleader.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('teamleader.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('teamleader.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('teamleader.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('teamleader.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('teamleader.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('teamleader.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('teamleader.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('teamleader.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('teamleader.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('teamleader.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('teamleader.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('teamleader.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('teamleader.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('teamleader.notes.history.users');

    });

});
