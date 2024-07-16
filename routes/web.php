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
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\FeedbackChatsController;
use App\Http\Controllers\PusherAuthController;

use App\Models\EvaluationForm;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.suspended'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
//update latest evaluation forms data
Route::get('/api/evaluation-forms', function () {
    $evaluationForms = EvaluationForm::all();
    return response()->json($evaluationForms);
});

//
//Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

// Employee Routes
Route::get('/employee/dashboard', [EmployeeController::class, 'index'])->name('employee.home');
//Evaluation Form Routes
Route::get('/employee/evaluation_form', [EmployeeController::class, 'eval_form'])->name('employee.form');
Route::get('/employee/resources', [EmployeeController::class, 'resources'])->name('employee.resources');
Route::get('/employee/appointments', [EmployeeController::class, 'appointment'])->name('employee.appointment');
Route::get('/employee/chats', [EmployeeController::class, 'chats'])->name('employee.chats');
Route::get('/employee/resources', [EmployeeController::class, 'resources'])->name('employee.resources');
Route::get('/resources/search', [ResourceController::class, 'searchResources'])->name('resources.search');
Route::get('/employee/chats', [EmployeeController::class, 'chats'])->name('employee.chats');
Route::post('/submit-evaluation', [EvaluationFormController::class, 'submit'])->name('submit-evaluation');
Route::get('/employee/resources', [ResourceController::class, 'showResources'])->name('employee.resources');
Route::get('/employee/journals', [JournalController::class, 'show'])->name('journals.show');
Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
Route::get('/employee/fullcalendar', [FullCalenderController::class, 'display'])->name('employee.fullcalendar');
// Route::post('/employee/fullcalendarAjax', [FullCalenderController::class, 'ajax'])->name('employee.fullcalendar.ajax');
Route::get('/employee/request-appointment', [RequestAppointmentController::class, 'index'])->name('request-appointment');
Route::post('/send-message', [RequestAppointmentController::class, 'sendMessage'])->name('send-message');
Route::post('/send-reply/{message}', [RequestAppointmentController::class, 'sendReply'])->name('send-reply');

// Manager specific routes
Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.home');
//Route::get('/report', [EvaluationFormController::class, 'showReport'])->name('manager.evaluation-report');
Route::get('/manager/evaluation-report', [EvaluationReportController::class, 'index'])->name('manager.evaluation-report');
Route::get('/evaluation-report', [EvaluationReportController::class, 'index'])->name('evaluation.report.index');
Route::get('/evaluation/{id}', [EvaluationFormController::class, 'show'])->name('evaluation.show');
Route::get('/evaluation-report', [EvaluationFormController::class, 'evaluationReport'])->name('evaluation.report');
Route::get('/manager/plan-activities/summary', [PlanActivitiesController::class, 'index'])->name('manager.plan-activities.summary');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/manager/plan-activities', [ActivityController::class, 'showActivities'])->name('manager.plan-activities.index');
Route::post('/activities/store', [ActivityController::class, 'store'])->name('activities.store');
//feedback sheila
Route::get('/feedback', [FeedbackController::class, 'index'])->name('manager.feedback.index');
Route::post('/feedback/messages', [FeedbackController::class, 'sendMessage'])->name('feedback.sendMessage');
Route::post('/feedback/messages/reply', [FeedbackController::class, 'sendReply'])->name('feedback.sendReply');

//employee chats
Route::get('/chats', [FeedbackChatsController::class, 'index'])->name('employee.chats.index');
Route::post('/chats/send-message', [FeedbackChatsController::class, 'sendMessage'])->name('chat.sendMessage');
Route::post('/chats/{chat}/reply', [FeedbackChatsController::class, 'sendReply'])->name('chat.sendReply');
Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate']);
    // Admin Routes
//feedback
// Route::get('/feedback', [FeedbackController::class, 'index'])->name('manager.feedback.index');
// Route::get('/feedback/show/{id}', [FeedbackController::class, 'show'])->name('manager.feedback.show');
// Route::post('/feedback/{feedback}/messages', [FeedbackController::class, 'storeMessage'])->name('feedback.store-message');
// Route::post('/feedback/{feedback}/replies', [FeedbackController::class, 'storeReply'])->name('feedback.store-reply');
// Route::get('/feedback/{feedback}/messages', [FeedbackController::class, 'indexMessages'])->name('messages.index');

// Admin Routes

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.home');
// Route::get('/admin/view-user-records', [ViewUserRecordsController::class, 'show'])->name('admin.viewUserRecords'); //

 Route::get('/admin/users', [ViewUserRecordsController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{user}', [ViewUserRecordsController::class, 'show'])->name('admin.users.show');
// Mumbi admin routes
Route::get('/admin/roles', [AdminController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/roles/create', [AdminController::class, 'create'])->name('admin.roles.create');
Route::post('/admin/roles', [AdminController::class, 'store'])->name('admin.roles.store');
Route::get('/admin/roles/{role}/edit', [AdminController::class, 'editRole'])->name('admin.roles.edit');
Route::put('/admin/roles/{role}', [AdminController::class, 'update'])->name('admin.roles.update');
Route::delete('/admin/roles/{role}', [AdminController::class, 'destroy'])->name('admin.roles.destroy');
// Manage user routes
Route::resource('/users', UserController::class)->names([
    'index' => 'admin.user.index',
    'create' => 'admin.user.create',
    'store' => 'admin.user.store',
    'edit' => 'admin.user.edit',
    'update' => 'admin.user.update',
    'destroy' => 'admin.user.destroy',
]);
Route::post('/admin/users/{user}/suspend', [UserController::class, 'suspend'])->name('admin.user.suspend');
Route::post('/admin/users/{user}/unsuspend', [UserController::class, 'unsuspend'])->name('admin.user.unsuspend');
// End of Mumbi admin routes


Route::get('/admin/role-management', [RoleManagementController::class, 'index'])->name('admin.role-management.index');
Route::post('/role-management/assign', [RoleManagementController::class, 'assignRole'])->name('role-management.assign');
Route::get('/setup-roles-permissions', [RoleManagementController::class, 'setupRolesAndPermissions']);
Route::post('/user/suspend', [UserController::class, 'suspendUser'])->name('user.suspend');

Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');


// Therapist routes
Route::get('/therapist/home', [TherapistController::class, 'index'])->name('therapist.home');
Route::get('/therapist/planner', [PlannerController::class, 'index'])->name('therapist.planner');
Route::post('therapist/planner', [PlannerController::class, 'store']);
Route::get('/therapist/appointmentrequests', [AppointmentRequestController::class, 'index'])->name('therapist.appointmentrequests');
Route::post('/notifications/mark-as-read/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/appointmentrequests', [AppointmentRequestController::class, 'showNotifications'])->name('appointmentrequests.showNotifications');
Route::put('/notifications/{id}', [AppointmentRequestController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/therapist-send-reply/{message}', [AppointmentRequestController::class, 'sendReply'])->name('therapist-send-reply');
//fullcalender
Route::get('therapist/fullcalendar', [FullCalenderController::class, 'index'])->name('therapist.fullcalendar');
Route::post('therapist/fullcalendarAjax', [FullCalenderController::class, 'ajax'])->name('therapist.fullcalendar.ajax');

    // Route::post('/send-reply', [AppointmentRequestController::class, 'sendReply'])->name('send-reply');
