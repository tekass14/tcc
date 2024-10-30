<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;

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
Route::get('/face/register', [FaceController::class, 'create'])->name('face.create');
Route::post('/face/register', [FaceController::class, 'store'])->name('face.store');
Route::get('/face/edit/{id}', [FaceController::class, 'edit'])->name('face.edit');
Route::get('/face/update/{id}', [FaceController::class, 'edit'])->name('face.edit');
Route::get('/face/delete/{id}', [FaceController::class, 'delete'])->name('face.delete');

