<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);
Route::put('/users/{user}',[ApiController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/logout', [ApiController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});

Route::get('/categorias', [ApiController::class, 'getCategorias']);

Route::get('/produtos', [ApiController::class, 'getProdutos']);

Route::get('/clientes', [ApiController::class, 'getClientes']);

Route::get('/usuarios', [ApiController::class, 'getUsuarios']);

Route::get('/vendas', [ApiController::class, 'getVendas']);
Route::delete('/venda/{idVenda}/delete', [ApiController::class, 'deletarVenda']);
Route::post('/venda', [ApiController::class, 'postVenda']);
Route::put('/venda/{idVenda}/update', [ApiController::class, 'editarVenda']);

Route::post('/itemVenda/{idVenda}', [ApiController::class, 'postItemVenda']);
Route::get('/itemVenda/{idVenda}/produtos', [ApiController::class, 'getItemsVenda']);
Route::delete('/itemVenda/{idVenda}/delete/{idProduto}', [ApiController::class, 'deleteProdutoVenda']);

