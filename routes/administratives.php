<?php


use App\Http\Controllers\Administratives\Customers\CustomersController;
use App\Http\Controllers\Administratives\DashboardController;
use App\Http\Controllers\Administratives\PostalcodeController;
use App\Http\Controllers\Administratives\Settings\SettingsController;
use App\Http\Controllers\Administratives\Notes\NotesController;
use App\Http\Controllers\Administratives\Notes\Worksessions;
use App\Http\Controllers\Administratives\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'administrative', 'middleware' => ['auth', 'roles:administrative']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('administrative.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('administrative.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('administrative.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('administrative.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('administrative.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('administrative.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('administrative.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('administrative.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('administrative.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('administrative.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('administrative.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('administrative.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('administrative.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('administrative.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('administrative.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('administrative.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('administrative.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('administrative.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('administrative.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('administrative.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('administrative.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('administrative.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('administrative.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('administrative.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('administrative.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('administrative.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('administrative.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('administrative.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('administrative.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('administrative.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('administrative.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('administrative.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('administrative.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('administrative.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('administrative.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('administrative.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('administrative.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('administrative.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('administrative.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('administrative.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('administrative.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('administrative.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('administrative.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('administrative.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('administrative.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('administrative.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('administrative.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('administrative.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('administrative.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('administrative.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('administrative.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('administrative.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('administrative.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('administrative.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('administrative.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('administrative.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('administrative.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('administrative.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('administrative.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('administrative.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('administrative.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('administrative.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('administrative.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('administrative.notes.history.users');

    });

});
