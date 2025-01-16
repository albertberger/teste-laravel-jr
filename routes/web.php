<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; // Importando a classe DB
use App\Http\Controllers\ProductController;

// Rota inicial (lista de produtos)
Route::get('/', [ProductController::class, 'index'])->name('product.index');

// Rota para exibir o formulário de criação de produto
Route::get('/create', [ProductController::class, 'create'])->name('product.create');

// Rota para salvar o produto
Route::post('/store', [ProductController::class, 'store'])->name('product.store');

// Rota para lidar com o redirecionamento do Mercado Livre
Route::get('/callback', [ProductController::class, 'callback'])->name('callback');

// Rota para testar a conexão com o banco de dados
Route::get('/test-database', function () {
    $results = DB::select('SHOW TABLES');
    return response()->json($results);
});
