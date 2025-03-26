<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    // Exibir lista de produtos para venda
    public function index()
    {
        // Exibindo apenas produtos com estoque disponível
        $produtos = Produto::where('status', 'ativo')->where('quantidade', '>', 0)->get();
        return view('vendas.index', compact('produtos'));
    }

    // Registrar a venda e atualizar a quantidade do produto
    public function store(Request $request, $id)
    {
        // Validação da quantidade a ser vendida
        $request->validate([
            'quantidade_vendida' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($id);

        // Verificar se há estoque suficiente
        if ($produto->quantidade >= $request->quantidade_vendida) {
            // Calcular o valor total da venda
            $valorTotal = $produto->preco * $request->quantidade_vendida;

            // Registrar a venda
            $venda = Venda::create([
                'produto_id' => $produto->id,
                'quantidade_vendida' => $request->quantidade_vendida,
                'preco_unitario' => $produto->preco,
                'valor_total' => $valorTotal,
            ]);

            // Atualizar o estoque do produto
            $produto->atualizarEstoque($request->quantidade_vendida);

            return redirect()->route('vendas.index')->with('success', 'Venda realizada com sucesso!');
        } else {
            return redirect()->route('vendas.index')->with('error', 'Quantidade insuficiente no estoque!');
        }
    }
    public function relatorio()
    {
        $vendas = Venda::with('produto')->get(); // Eager loading para obter o produto associado à venda
        return view('vendas.relatorio', compact('vendas'));
    }

}
