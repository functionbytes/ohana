<?php


use App\Http\Controllers\Teleoperators\DashboardController;
use App\Http\Controllers\Teleoperators\Settings\SettingsController;
use App\Http\Controllers\Teleoperators\Notes\NotesControllerv;
use App\Http\Controllers\Teleoperators\Notes\Worksessions;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'teleoperator', 'middleware' => ['auth', 'roles:teleoperators']], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('teleoperator.dashboard');

    Route::group(['prefix' => 'assigneds'], function () {
        Route::get('/assigned', [AssignedsController::class, 'markNotification'])->name('teleoperator.tickets.allactiveinprogresstickets');
        Route::get('/reopen', [AssignedsController::class, 'allactivereopentickets'])->name('teleoperator.tickets.allactivereopentickets');
        Route::get('/onhold', [AssignedsController::class, 'allactiveonholdtickets'])->name('teleoperator.tickets.allactiveonholdtickets');
        Route::get('/assigned', [AssignedsController::class, 'allactiveassignedtickets'])->name('teleoperator.tickets.allactiveassignedtickets');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('teleoperator.settings.profile');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('teleoperator.settings.notifications');
        Route::post('/profile/update', [SettingsController::class, 'updateProfile'])->name('teleoperator.settings.profile.update');
        Route::post('/notifications/update', [SettingsController::class, 'updateNotifications'])->name('teleoperator.settings.notifications.update');
    });


    Route::group(['prefix' => 'tickets'], function () {

        Route::get('/', [NotesControllerv::class, 'index'])->name('teleoperator.tickets');
        Route::get('/create', [NotesControllerv::class, 'create'])->name('teleoperator.tickets.create');
        Route::post('/store', [NotesControllerv::class, 'store'])->name('teleoperator.tickets.store');
        Route::post('/update', [NotesControllerv::class, 'update'])->name('teleoperator.tickets.update');
        Route::get('/edit/{uid}', [NotesControllerv::class, 'edit'])->name('teleoperator.tickets.edit');
        Route::get('/view/{uid}', [NotesControllerv::class, 'view'])->name('teleoperator.tickets.view');

        Route::delete('/destroy/{uid}', [NotesControllerv::class, 'destroy'])->name('teleoperator.tickets.destroy');
        Route::post('/reopen/{uid}', [CommentsController::class, 'reopenticket'])->name('teleoperator.tickets.reopen');
        Route::get('/previous/{uid}', [NotesControllerv::class, 'previous'])->name('teleoperator.tickets.previous');

        Route::post('/image/upload/{uid}', [NotesControllerv::class, 'storeMedia'])->name('teleoperator.tickets.image.store');
        Route::post('/image/upload', [NotesControllerv::class, 'guestmedia'])->name('teleoperator.tickets.image.upload');

        Route::post('/priority/change', [NotesControllerv::class, 'changepriority'])->name('teleoperator.tickets.change.priority');

        Route::post('/note/create', [NotesControllerv::class, 'note'])->name('teleoperator.tickets.note.create');
        Route::delete('/note/{uid}', [NotesControllerv::class, 'notedestroy'])->name('teleoperator.tickets.note.destroy');

        Route::get('/comment/{uid}', [CommentsController::class, 'view'])->name('teleoperator.tickets.comments');
        Route::post('/comment/post/{uid}', [CommentsController::class, 'postComment'])->name('teleoperator.tickets.comments.post');
        Route::post('/comment/edit/{uid}', [CommentsController::class, 'updateedit'])->name('teleoperator.tickets.comments.edit');
        Route::get('/comment/delete/{uid}', [CommentsController::class, 'deletecomment'])->name('teleoperator.tickets.comments.delete');
        Route::delete('/comment/image/upload/{uid}', [CommentsController::class, 'imagedestroy'])->name('teleoperator.tickets.image.destroy');

        Route::post('/selfassign', [NotesControllerv::class, 'selfassign'])->name('teleoperator.tickets.selfassign');
        Route::post('/ticketassigneds', [NotesControllerv::class, 'ticketassigneds'])->name('teleoperator.tickets.ticketassigneds');
        Route::post('/ticketunassigns', [NotesControllerv::class, 'ticketunassigns'])->name('teleoperator.tickets.ticketunassigns');

        Route::post('/assigned', [NotesControllerv::class, 'create'])->name('teleoperator.tickets.assigned');
        Route::get('/assigned/{uid}', [NotesControllerv::class, 'edit'])->name('teleoperator.tickets.assigned.view');
        Route::get('/assigned/edit/{uid}', [NotesControllerv::class, 'view'])->name('teleoperator.tickets.assigned.edit');

        Route::post('/notes/store', [NotesControllerv::class, 'notestore'])->name('teleoperator.tickets.notes.store');
        Route::get('/notes/show/{uid}', [NotesControllerv::class, 'noteshow'])->name('teleoperator.tickets.notes.show');
        Route::get('/notes/delete/{uid}', [NotesControllerv::class, 'notedelete'])->name('teleoperator.tickets.notes.delete');

        Route::post('/employeesreplyingremove', 'AdminTicketController@employeesreplyingremove')->name('employeesreplyingremove');
        Route::post('/employeesreplyingstore', 'AdminTicketController@employeesreplyingstore')->name('employeesreplyingstore');
        Route::get('/getemployeesreplying/{id}', 'AdminTicketController@getemployeesreplying')->name('getemployeesreplying');
        Route::get('/ticket/{ticket_id}', 'AdminTicketController@destroy');
        Route::post('/priority/change/', 'AdminTicketController@changepriority');
        Route::get('/ticket/delete/tickets', 'AdminTicketController@ticketmassdestroy')->name('admin.ticket.sremove');
        Route::get('/ticket-view/{ticket_id}', 'AdminTicketController@show')->name('admin.ticketshow');
        Route::post('/ticket-comment/{ticket_id}', 'AdminTicketController@commentshow')->name('admin.ticketcomment');

        Route::post('/closed/{ticket_id}', 'AdminTicketController@close');
        Route::get('/delete-ticket/{id}', 'AdminTicketController@destroy');

        Route::get('/createticket', 'AdminTicketController@createticket');
        Route::post('/createticket', 'AdminTicketController@gueststore');
        Route::post('/imageupload', 'AdminTicketController@guestmedia')->name('imageuploadadmin');
        Route::get('/alltickets', 'AdminTicketController@alltickets')->name('admin.alltickets');

        Route::get('/inprogress', [NotificationsController::class, 'allactiveinprogresstickets'])->name('teleoperator.notifications.markallnotify');

        Route::get('/selfassigneds', [TrashedsController::class, 'selfassignticketview'])->name('teleoperator.tickets.selfassigned');
        Route::get('/assigneds', [TrashedsController::class, 'myassignedTickets'])->name('teleoperator.tickets.assigneds');
        Route::get('/closeds', [TrashedsController::class, 'myclosedtickets'])->name('teleoperator.tickets.closeds');
        Route::get('/suspends', [TrashedsController::class, 'mysuspendtickets'])->name('teleoperator.tickets.history.suspendss');

        Route::get('/trasheds', [TrashedsController::class, 'tickettrashed'])->name('teleoperator.tickets.trasheds');
        Route::get('/trasheds/view/{uid}', [TrashedsController::class, 'tickettrashedview'])->name('teleoperator.tickets.trasheds.view');
        Route::post('/trasheds/restore/{uid}', [TrashedsController::class, 'tickettrashedrestore'])->name('teleoperator.tickets.trasheds.restore');
        Route::delete('/trasheds/destroy/{uid}', [TrashedsController::class, 'tickettrasheddestroy'])->name('teleoperator.tickets.trasheds.destroy');
        Route::post('/trasheds/restore/all', [TrashedsController::class, 'alltrashedticketrestore'])->name('teleoperator.tickets.trasheds.restore.all');
        Route::post('/trasheds/destroy/all', [TrashedsController::class, 'alltrashedticketdelete'])->name('teleoperator.tickets.trasheds.destroy.all');

        Route::get('/history/{uid}', [TrashedsController::class, 'tickethistory'])->name('teleoperator.tickets.history');
        Route::get('/history/users/{uid}', [TrashedsController::class, 'customerprevioustickets'])->name('teleoperator.tickets.history.users');

    });

});
