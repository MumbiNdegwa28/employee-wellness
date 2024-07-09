<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\EvaluationReportController;
use App\Http\Controllers\PlanActivitiesController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvaluationFormController;
use App\Http\Controllers\ViewUserRecordsController;
use App\Http\Controllers\ManageUserPermissionsController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\RequestAppointmentController;
use App\Http\Controllers\AppointmentRequestController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MessageController;
use App\Http\Livewire\ManageRoles;
use App\Http\Controllers\RoleManagementController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

//not sure
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        // Only accessible by admins
    });
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', function () {
        // Only accessible by managers
    });
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee', function () {
        // Only accessible by employee
    });
});

Route::middleware(['auth', 'role:therapist'])->group(function () {
    Route::get('/therapist', function () {
        // Only accessible by therapists
    });
});


//
Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    
// Employee Routes
Route::get('/employee/dashboard', [EmployeeController::class, 'index'])->name('employee.home');
//Evaluation Form Routes
Route::get('/employee/evaluation_form', [EmployeeController::class, 'eval_form'])->name('employee.form');
// Route::get('/employee/journaling',[EmployeeController::class,'journaling'])->name('employee.journal');
Route::get('/employee/resources', [EmployeeController::class, 'resources'])->name('employee.resources');
Route::get('/employee/appointments', [EmployeeController::class, 'appointment'])->name('employee.appointment');
Route::get('/employee/chats', [EmployeeController::class, 'chats'])->name('employee.chats');
Route::get('/employee/resources',[EmployeeController::class,'resources'])->name('employee.resources');
// Route::get('/employee/appointments',[EmployeeController::class,'appointment'])->name('employee.appointment');
Route::get('/employee/chats',[EmployeeController::class,'chats'])->name('employee.chats');
Route::post('/submit-evaluation', [EvaluationFormController::class, 'submit'])->name('submit-evaluation');
Route::get('/employee/resources', [ResourceController::class, 'showResources'])->name('employee.resources');
Route::get('/employee/journals', [JournalController::class, 'show'])->name('journals.show');
Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
Route::get('/employee/request-appointment', [RequestAppointmentController::class, 'index'])->name('request-appointment');
Route::post('/send-message', [RequestAppointmentController::class, 'sendMessage'])->name('send-message');
Route::post('/send-reply/{message}',[RequestAppointmentController::class,'sendReply'])->name('send-reply');

// Manager specific routes
Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.home');

Route::get('/report', [EvaluationFormController::class, 'showReport'])->name('manager.evaluation-report');
Route::get('/evaluation-report', [EvaluationReportController::class, 'index'])->name('evaluation.report.index');
Route::get('/evaluation/{id}', [EvaluationFormController::class, 'show'])->name('evaluation.show');
Route::get('/evaluation-report', [EvaluationFormController::class, 'evaluationReport'])->name('evaluation.report');

Route::get('/manager/plan-activities/summary', [PlanActivitiesController::class, 'index'])->name('manager.plan-activities.summary');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/manager/plan-activities', [ActivityController::class, 'showActivities'])->name('manager.plan-activities.index');
Route::post('/activities/store', [ActivityController::class, 'store'])->name('activities.store');
//feedback
Route::get('/manager/feedback', [FeedbackController::class, 'index'])->name('manager.feedback.index');
Route::get('/manager/feedback/{id}', [FeedbackController::class, 'show'])->name('manager.feedback.show');
Route::post('/feedback/{feedback}/messages', [FeedbackController::class, 'storeMessage']);
Route::get('/feedback/{feedback}/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/feedback/{feedback}/messages', [MessageController::class, 'store'])->name('messages.store');

// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.home');
//Route::get('/admin/view-user-records', [ViewUserRecordsController::class, 'show'])->name('admin.viewUserRecords'); //
Route::get('/admin/users', [ViewUserRecordsController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{user}', [ViewUserRecordsController::class, 'show'])->name('admin.users.show');
//
    Route::get('/admin/role-management', [RoleManagementController::class, 'index'])->name('admin.role-management.index');
    Route::post('/role-management/assign', [RoleManagementController::class, 'assignRole'])->name('role-management.assign');

Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');

//therapist routes
// Route::get('/therapist/home', [TherapistController::class, 'index'])->name('therapist.home');
// Route::get('/therapist/planner', [PlannerController::class, 'index'])->name('therapist.planner');
// Route::get('/therapist/appointmentrequests', [AppointmentRequestController::class, 'index'])->name('therapist.chats');
// Route::post('therapist/events', [PlannerController::class, 'store']);
// Route::get('/appointmentrequests', [AppointmentRequestController::class, 'showNotifications'])->name('appointmentrequests.index');
// Route::put('/notifications/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
// Route::post('/send-reply', [AppointmentRequestController::class, 'sendReply'])->name('send-reply');

// Chat routes
    Route::get('/chat', [ChatsController::class, 'index'])->middleware('auth')->name('chat');
    Route::get('/messages', [ChatsController::class, 'fetchMessages'])->middleware('auth');
    Route::post('/messages', [ChatsController::class, 'sendMessage'])->middleware('auth');


// Therapist routes
    Route::get('/therapist/home', [TherapistController::class, 'index'])->name('therapist.home');
    Route::get('/therapist/planner', [PlannerController::class, 'index'])->name('therapist.planner');
    Route::post('therapist/events', [PlannerController::class, 'store']);
    Route::get('/therapist/appointmentrequests', [AppointmentRequestController::class, 'index'])->name('therapist.appointmentrequests');
    Route::post('/notifications/mark-as-read/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/appointmentrequests', [AppointmentRequestController::class, 'showNotifications'])->name('appointmentrequests.showNotifications');
    Route::put('/notifications/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/therapist-send-reply/{message}', [AppointmentRequestController::class, 'sendReply'])->name('therapist-send-reply');

    // Route::post('/send-reply', [AppointmentRequestController::class, 'sendReply'])->name('send-reply');

// jaba
//  Route::get('/appointmentrequests', [AppointmentRequestController::class, 'index'])->name('appointmentrequests.index');
//  Route::post('/send-message', [AppointmentRequestController::class, 'sendMessage'])->name('send-message');
//  Route::get('/notifications', [AppointmentRequestController::class, 'showNotifications'])->name('notifications.show');
//  Route::post('/notifications/mark-as-read/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
//  Route::post('/send-reply/{notificationId}', [AppointmentRequestController::class, 'sendReply'])->name('send-reply');


 
