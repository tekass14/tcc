<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//ROTAS FACE
Route::get('/face/register', [UserController::class, 'create'])->name('face.create');
Route::post('/face/register', [UserController::class, 'store'])->name('face.store');
Route::get('/face/edit/{id}', [UserController::class, 'edit'])->name('face.edit');
Route::get('/face/update/{id}', [UserController::class, 'edit'])->name('face.edit');
Route::get('/face/delete/{id}', [UserController::class, 'delete'])->name('face.delete');

