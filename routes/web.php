<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Route::get('/dashboard', [AdminController::class, 'dashboard'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/songs', [AdminController::class, 'songs'])->name('admin.songs');
    Route::get('/admin/songs/add', [AdminController::class, 'addSong'])->name('admin.addSong');
    Route::post('/admin/songs', [AdminController::class, 'createSong'])->name('admin.createSong');
    Route::get('/admin/songs/{id}/edit', [AdminController::class, 'editSong'])->name('admin.editSong');
    Route::patch('/admin/songs/{id}', [AdminController::class, 'updateSong'])->name('admin.updateSong');
    Route::delete('/admin/songs/{id}', [AdminController::class, 'deleteSong'])->name('admin.deleteSong');
    Route::get('/admin/albums', [AdminController::class, 'albums'])->name('admin.albums');
    Route::post('/admin/albums', [AdminController::class, 'createAlbum'])->name('admin.createAlbum');
    Route::delete('/admin/albums/{id}', [AdminController::class, 'deleteAlbum'])->name('admin.deleteAlbum');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/songs/edit/{id}', [AdminController::class, 'editSong'])->name('admin.editSong');
    Route::put('/admin/songs/update/{id}', [AdminController::class, 'updateSong'])->name('admin.updateSong');   
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
// Route::get('/admin/songs', [AdminController::class, 'showAdminDashboard'])->name('admin.songs');