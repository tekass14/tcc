<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ItemVendaController;
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

//Route::resource('categoria', CategoriaController::class);
//ROTAS CATEGORIA
Route::get('/categoria',               [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/categoria/create',        [CategoriaController::class, 'create'])->name('categoria.create');
Route::post('/categoria/create',       [CategoriaController::class, 'store'])->name('categoria.store');
Route::get('/categoria/edit/{id}',     [CategoriaController::class, 'edit'])->name('categoria.edit');
Route::put('/categoria/update/{id}',  [CategoriaController::class, 'update'])->name('categoria.update');
Route::get('/categoria/delete/{id}',   [CategoriaController::class, 'delete'])->name('categoria.delete');

//ROTAS PRODUTO
Route::get('/produto',               [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/produto/create',        [ProdutoController::class, 'create'])->name('produto.create');
Route::post('/produto/create',       [ProdutoController::class, 'store'])->name('produto.store');
Route::get('/produto/edit/{id}',     [ProdutoController::class, 'edit'])->name('produto.edit');
Route::post('/produto/update/{id}',  [ProdutoController::class, 'update'])->name('produto.update');
Route::get('/produto/delete/{id}',   [ProdutoController::class, 'delete'])->name('produto.delete');

//ROTAS CLIENTE
Route::get('/cliente',               [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create',        [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente/create',       [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}',     [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}',  [ClienteController::class, 'update'])->name('cliente.update');
Route::get('/cliente/delete/{id}',   [ClienteController::class, 'delete'])->name('cliente.delete');

//ROTAS VENDA
Route::get('/venda',               [VendaController::class, 'index'])->name('venda.index');
Route::get('/venda/create',        [VendaController::class, 'create'])->name('venda.create');
Route::get('/venda/show/{id}',    [VendaController::class, 'show'])->name('venda.show');
Route::post('/venda/create',       [VendaController::class, 'store'])->name('venda.store');
Route::get('/venda/edit/{id}',     [VendaController::class, 'edit'])->name('venda.edit');
Route::put('/venda/update/{id}',  [VendaController::class, 'update'])->name('venda.update');
Route::get('/venda/delete/{id}',   [VendaController::class, 'delete'])->name('venda.delete');

//ROTAS ITEM_VENDA
Route::get('/itemVenda/{idVenda}',                         [ItemVendaController::class, 'index'])->name('itemVenda.index');
Route::get('/itemVenda/create/{idVenda}',                  [ItemVendaController::class, 'create'])->name('itemVenda.create');
Route::post('/itemVenda/create',                           [ItemVendaController::class, 'store'])->name('itemVenda.store');
Route::get('/itemVenda/edit/{id}',                         [ItemVendaController::class, 'edit'])->name('itemVenda.edit');
Route::put('/itemVenda/update/{id}',                      [ItemVendaController::class, 'update'])->name('itemVenda.update');
Route::get('/itemVenda/delete/{id}',                       [ItemVendaController::class, 'delete'])->name('itemVenda.delete');

