<?php


use App\Http\Controllers\Teleoperators\Customers\CustomersController;
use App\Http\Controllers\Teleoperators\DashboardController;
use App\Http\Controllers\Teleoperators\PostalcodeController;
use App\Http\Controllers\Teleoperators\Settings\SettingsController;
use App\Http\Controllers\Teleoperators\Notes\NotesController;
use App\Http\Controllers\Teleoperators\Notes\Worksessions;
use App\Http\Controllers\Teleoperators\worksessions\worksessionsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'chiefteleoperator', 'middleware' => ['auth', 'roles:chiefteleoperator']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('chiefteleoperator.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('chiefteleoperator.notes.allactiveinprogressnotes');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopennotes'])->name('chiefteleoperator.notes.allactivereopennotes');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdnotes'])->name('chiefteleoperator.notes.allactiveonholdnotes');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignednotes'])->name('chiefteleoperator.notes.allactiveassignednotes');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('chiefteleoperator.settings.profile');
        Route::post('/profile/update', [SettingsController::class, 'update'])->name('chiefteleoperator.settings.profile.update');
    });



    Route::group(['prefix' => 'worksessions'], function () {
        Route::get('/', [WorksessionsController::class, 'index'])->name('chiefteleoperator.worksessions');
        Route::post('/checkin', [WorksessionsController::class, 'checkin'])->name('chiefteleoperator.worksessions.checkin');
        Route::post('/checkout', [WorksessionsController::class, 'checkout'])->name('chiefteleoperator.worksessions.checkout');
        Route::get('/status', [WorksessionsController::class, 'currentStatus'])->name('chiefteleoperator.worksessions.status');

    });


    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('chiefteleoperator.customers');
        Route::get('/create', [CustomersController::class, 'create'])->name('chiefteleoperator.customers.create');
        Route::post('/store', [CustomersController::class, 'store'])->name('chiefteleoperator.customers.store');
        Route::post('/update', [CustomersController::class, 'update'])->name('chiefteleoperator.customers.update');
        Route::get('/edit/{uid}', [CustomersController::class, 'edit'])->name('chiefteleoperator.customers.edit');
        Route::get('/view/{uid}', [CustomersController::class, 'view'])->name('chiefteleoperator.customers.view');
    });

    Route::group(['prefix' => 'postalcodes'], function () {
        Route::get('/search', [PostalcodeController::class, 'search'])->name('chiefteleoperator.postalcodes.search');
    });

    Route::group(['prefix' => 'notes'], function () {

        Route::get('/', [NotesController::class, 'index'])->name('chiefteleoperator.notes');
        Route::get('/create', [NotesController::class, 'create'])->name('chiefteleoperator.notes.create');
        Route::post('/store', [NotesController::class, 'store'])->name('chiefteleoperator.notes.store');
        Route::post('/update', [NotesController::class, 'update'])->name('chiefteleoperator.notes.update');
        Route::get('/edit/{uid}', [NotesController::class, 'edit'])->name('chiefteleoperator.notes.edit');
        Route::get('/view/{uid}', [NotesController::class, 'view'])->name('chiefteleoperator.notes.view');
        Route::get('/generate/{uid}', [NotesController::class, 'generate'])->name('chiefteleoperator.notes.generate');
        Route::get('/reschedule/{uid}', [NotesController::class, 'reschedule'])->name('chiefteleoperator.notes.reschedule');
        Route::get('/check', [NotesController::class, 'check'])->name('chiefteleoperator.notes.check');
        Route::get('/histories', [NotesController::class, 'histories'])->name('chiefteleoperator.notes.histories');
        Route::get('/validate', [NotesController::class, 'validateByPhone'])->name('chiefteleoperator.notes.validate');



        Route::delete('/destroy/{uid}', [NotesController::class, 'destroy'])->name('chiefteleoperator.notes.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('chiefteleoperator.notes.reopen');
        Route::get('/previous/{uid}', [NotesController::class, 'previous'])->name('chiefteleoperator.notes.previous');

        Route::post('/image/upload/{uid}', [NotesController::class, 'storeMedia'])->name('chiefteleoperator.notes.image.store');
        Route::post('/image/upload', [NotesController::class, 'guestmedia'])->name('chiefteleoperator.notes.image.upload');

        Route::post('/priority/change', [NotesController::class, 'changepriority'])->name('chiefteleoperator.notes.change.priority');

        Route::post('/note/create', [NotesController::class, 'note'])->name('chiefteleoperator.notes.note.create');
        Route::delete('/note/{uid}', [NotesController::class, 'notedestroy'])->name('chiefteleoperator.notes.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('chiefteleoperator.notes.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('chiefteleoperator.notes.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('chiefteleoperator.notes.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('chiefteleoperator.notes.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('chiefteleoperator.notes.image.destroy');

        Route::post('/selfassign', [NotesController::class, 'selfassign'])->name('chiefteleoperator.notes.selfassign');
        Route::post('/ticketassigneds', [NotesController::class, 'ticketassigneds'])->name('chiefteleoperator.notes.ticketassigneds');
        Route::post('/ticketunassigns', [NotesController::class, 'ticketunassigns'])->name('chiefteleoperator.notes.ticketunassigns');

        Route::post('/assigned', [NotesController::class, 'create'])->name('chiefteleoperator.notes.assigned');
        Route::get('/assigned/{uid}', [NotesController::class, 'edit'])->name('chiefteleoperator.notes.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesController::class, 'view'])->name('chiefteleoperator.notes.assigned.edit');

        Route::post('/notes/store', [NotesController::class, 'notestore'])->name('chiefteleoperator.notes.notes.store');
        Route::get('/notes/show/{uid}', [NotesController::class, 'noteshow'])->name('chiefteleoperator.notes.notes.show');
        Route::get('/notes/delete/{uid}', [NotesController::class, 'notedelete'])->name('chiefteleoperator.notes.notes.delete');

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

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogressnotes'])->name('chiefteleoperator.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('chiefteleoperator.notes.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignednotes'])->name('chiefteleoperator.notes.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosednotes'])->name('chiefteleoperator.notes.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendnotes'])->name('chiefteleoperator.notes.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('chiefteleoperator.notes.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('chiefteleoperator.notes.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('chiefteleoperator.notes.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('chiefteleoperator.notes.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('chiefteleoperator.notes.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('chiefteleoperator.notes.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('chiefteleoperator.notes.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerpreviousnotes'])->name('chiefteleoperator.notes.history.users');

    });

});
