<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Event\AttendeeController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('admin')->group(function(){

    // Dashboard
    Route::controller(DashboardController::class)->name('dashboard.')->group(function(){
        Route::get('/', 'index')->name('index');
    });


    // Event Management
    Route::resource("event", EventController::class);

    // Preview Event
    Route::get('event/preview/{event}', [EventController::class, 'preview'])->name('event.preview');


    // Attendees
    Route::controller(AttendeeController::class)->group(function(){
        Route::get('attendee/show-list-of-attendees', 'show_list')->name('attendee.show_list');
        Route::post('attendee/show-list-of-attendees/upload', 'upload_list')->name('attendee.upload_list');
        Route::get('attendee/export/{id?}', 'export')->name('attendee.export');
        Route::post('attendee/upload', 'upload')->name('attendee.upload');
        Route::get('attendee/{event}', 'index')->name('attendee.index');
        Route::get('attendee/create/{event}', 'create')->name('attendee.create');
        Route::get('attendees/show-list-of-attendees', 'all')->name('attendee.all');
        Route::get('attendee/history/{attendee}', 'show')->name('attendee.show');
        Route::resource("attendee", AttendeeController::class)->except(['index', 'create', 'show']);
    });



    // Admin Management
    Route::middleware('is.super_admin')->resource("admin", AdminController::class)->except(['edit', 'update']);



    // Admin Profile
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/admin/profile/edit', 'edit')->name('admin.profile');
        Route::patch('/admin/profile', 'update')->name('admin.profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Notifications
    Route::get('/getNotifications', [NotificationController::class, 'getNotifications'])->name('get.notifications');
    Route::get('/getUnreadNotifications', [NotificationController::class, 'getUnreadNotifications'])->name('get.unread.notifications');
    Route::get('/markAsRead/{notification_id}', [NotificationController::class, 'markAsRead'])->name('markAsRead.notification');
    Route::get('/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead.notifications');
});

Route::patch('attendee/invitation/store', [AttendeeController::class, 'invitation_store'])->name('attendee.invtiation.store');



// Invitation
Route::get('invitation/{token}', [EventController::class, 'invitation'])->name('event.invitation');

// 404
Route::fallback(fn() => view('dashboard.pages.404'))->name('404');


require __DIR__.'/auth.php';
