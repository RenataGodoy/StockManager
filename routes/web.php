<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

Route::get('/login', [FrontendController::class, 'showLogin']);
Route::post('/login', [FrontendController::class, 'login']);

Route::get('/register', [FrontendController::class, 'showRegister']);
Route::post('/register', [FrontendController::class, 'register']);


    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index'); // Lista de produtos
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create'); // Criar produto
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store'); // Armazenar produto
    Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit'); // Editar produto
    Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update'); // Atualizar produto
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy'); // Inativar produto

Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
Route::post('/vendas/{id}', [VendaController::class, 'store'])->name('vendas.store');
Route::get('/relatorio-vendas', [VendaController::class, 'relatorio'])->name('vendas.relatorio');


