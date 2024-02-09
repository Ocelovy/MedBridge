<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CommentController, Controller, DoctorController, PatientController, UserController};
use Illuminate\Support\Facades\Auth;

Route::view('/', 'home')->name('home');

Auth::routes(['verify' => true]);
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::post('/user/updatePhoto', [UserController::class, 'updatePhoto'])->name('user.updatePhoto');
    Route::delete('/user/deletePhoto', [UserController::class, 'deletePhoto'])->name('user.deletePhoto');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::resource('comments', CommentController::class);

Route::prefix('doctors')->group(function () {
    Route::get('/kontakt', [DoctorController::class, 'index'])->name('kontakt');
});

Route::prefix('patients')->group(function () {
    Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
    Route::get('/pacient', [PatientController::class, 'pacientView'])->name('pacient');
    Route::post('/', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::get('/form', [PatientController::class, 'showForm'])->name('pacient.form');
    Route::get('/{patient}', [PatientController::class, 'getPatientInfo'])->name('patients.info');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
});

Route::get('/comment', [UserController::class, 'commentView'])->name('comment');
Route::get('/fotogaleria', [Controller::class, 'fotogaleriaView'])->name('fotogaleria');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('name', UserController::class)->except(['create', 'edit', 'update', 'destroy']);
    Route::get('/user/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
});

Route::get('/text', [Controller::class, 'textView'])->name('text');
