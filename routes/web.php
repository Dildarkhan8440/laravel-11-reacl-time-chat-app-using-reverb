<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [AdminController::class,'users'])->name('users');
    Route::get('/user/add', [AdminController::class,'addUser'])->name('users.add');
    Route::post('/user/add', [AdminController::class,'store'])->name('users.store');
    Route::get('/user/edit/{id}', [AdminController::class,'edit'])->name('users.edit');
    Route::post('/user/update/{id}', [AdminController::class,'update'])->name('users.update');
    Route::get('/user/delete/{id}', [AdminController::class,'delete'])->name('users.delete');


   
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/chatbox/{id}', [AdminController::class,'chatbox'])->name('chatbox');
    Route::post('/send', [AdminController::class,'send'])->name('send');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
