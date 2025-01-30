<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDocumentsController;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\EditUser;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('documents', DocumentController::class);
Route::post('documents/{document}/files', [FileController::class, 'store'])->name('files.store');
Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
Route::delete('files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

// Ruta para mostrar el formulario de actualización (GET)
Route::get('documents/{id}/update-derivation', [DocumentController::class, 'editDerivation'])
    ->name('documents.editDerivation');

// Ruta para procesar la actualización (POST o PUT)
Route::put('documents/{id}/update-derivation', [DocumentController::class, 'updateDerivation'])
    ->name('documents.updateDerivation');

Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->role == 'admin') {
        return view('admin.dashboard');
    }

    return redirect()->route('login');
});

Route::put('/documents/{document}/update-derivation', [DocumentController::class, 'updateDerivation'])->name('documents.update-derivation');

// routes/web.php
Route::get('/documents/search', [DocumentController::class, 'search'])->name('documents.search');





Route::resource('users', UserController::class);
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::resource('ad', AdminDocumentsController::class);
Route::get('/admin-documents', [AdminDocumentsController::class, 'index'])->name('ad.index');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', CreateUser::class)->name('users.create');

Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');

/* Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}/edit', \App\Http\Livewire\EditUser::class)->name('users.edit'); */

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Otras rutas necesarias...



require __DIR__.'/auth.php';
