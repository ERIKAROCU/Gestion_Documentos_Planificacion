<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
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


require __DIR__.'/auth.php';
