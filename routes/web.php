<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

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
Route::get('/face/register', [FaceController::class, 'create'])->name('face.create');
Route::post('/face/register', [FaceController::class, 'store'])->name('face.store');
Route::get('/face/edit', [FaceController::class, 'edit'])->name('face.edit');
Route::put('/face/update/{id}', [FaceController::class, 'update'])->name('face.update');
Route::get('/face/delete/{id}', [FaceController::class, 'delete'])->name('face.delete');
Route::get('/face/login', [FaceController::class, 'showFaceLogin'])->name('face.login');
Route::post('/face/login', [FaceController::class, 'faceLogin'])->name('face.submit');

