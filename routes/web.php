<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\JournalController;

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
Route::post('/submit-evaluation', [EvaluationController::class, 'submit'])->name('submit-evaluation');
Route::get('/employee/resources', [ResourceController::class, 'showResources'])->name('employee.resources');
Route::get('/employee/journals', [JournalController::class, 'show'])->name('journals.show');
Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');


