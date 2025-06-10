<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas públicas de login e registro
Route::get('/login', [FrontendController::class, 'showLogin'])->name('login');
Route::post('/login', [FrontendController::class, 'login']);

Route::get('/register', [FrontendController::class, 'showRegister']);
Route::post('/register', [FrontendController::class, 'register']);

// Rotas protegidas - só para usuários autenticados
Route::middleware('auth')->group(function () {


    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas/{id}', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/relatorio-vendas', [VendaController::class, 'relatorio'])->name('vendas.relatorio');

    // Rota para logout (se quiser, posso te ajudar a implementar)
    Route::post('/logout', function() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logout realizado com sucesso!');
    })->name('logout');

});
