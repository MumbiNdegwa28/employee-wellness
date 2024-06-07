<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\EvaluationFormReportController;
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
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[HomeController::class,'index'] )->name('dashboard');
});

Route::get('/employee/dashboard',[EmployeeController::class,'index'])->name('employee.home');
//Evaluation Form Routes
Route::get('/employee/evaluation_form',[EmployeeController::class,'eval_form'])->name('employee.form');
// Route::get('/employee/journaling',[EmployeeController::class,'journaling'])->name('employee.journal');
Route::get('/employee/resources',[EmployeeController::class,'resources'])->name('employee.resources');
Route::get('/employee/appointments',[EmployeeController::class,'appointment'])->name('employee.appointment');
Route::get('/employee/chats',[EmployeeController::class,'chats'])->name('employee.chats');
Route::post('/submit-evaluation', [EvaluationFormController::class, 'submit'])->name('submit-evaluation');
Route::get('/evaluation-report', [EvaluationFormController::class, 'showReport'])->name('evaluation.report');
Route::get('/employee/resources', [ResourceController::class, 'showResources'])->name('employee.resources');
Route::get('/employee/journals', [JournalController::class, 'show'])->name('journals.show');
Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');

 // Manager specific routes
 Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.home');
 Route::get('/evaluation-form-report', [EvaluationFormReportController::class, 'index'])->name('evaluation-form-report.index');
 Route::get('/plan-activities', [PlanActivitiesController::class, 'index'])->name('plan-activities.index');
 Route::get('/plan-activities', [ActivityController::class, 'index'])->name('activities.index');
 Route::post('/plan-activities', [ActivityController::class, 'store'])->name('activities.store');
 Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');
 Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.home');
 
 //Route::get('/admin/view-user-records', [ViewUserRecordsController::class, 'show'])->name('admin.viewUserRecords'); //
 Route::get('/admin/users', [ViewUserRecordsController::class, 'index'])->name('admin.users.index');
 Route::get('/admin/users/{user}', [ViewUserRecordsController::class, 'show'])->name('admin.users.show');
 Route::get('/admin/manage-user-permissions', [ManageUserPermissionsController::class, 'update'])->name('admin.manageUserPermissions');

 //therapist routes
 Route::get('/therapist/home', [TherapistController::class, 'index'])->name('therapist.home');
 Route::get('/therapist/planner', [PlannerController::class, 'index'])->name('therapist.planner');
 Route::get('/therapist/chats', [ChatController::class, 'index'])->name('therapist.chats');
 
 //Route::get('/admin/manage-user-permissions', [ManageUserPermissionsController::class, 'update'])->name('admin.manageUserPermissions');//
 // Route to edit user permissions
Route::get('/admin/users/{user}/edit', [ManageUserPermissionsController::class, 'edit'])->name('admin.users.edit');

// Route to update user permissions
Route::put('/admin/users/{user}', [ManageUserPermissionsController::class, 'update'])->name('admin.users.update');
