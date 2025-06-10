<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    // Mostrar só os produtos ativos, com estoque e do estabelecimento logado
    public function index()
    {
        $produtos = Produto::where('estabelecimento_id', auth()->id())
            ->where('status', 'ativo')
            ->where('quantidade', '>', 0)
            ->get();

        // Verifica se existe algum produto com estoque menor que 10
        $temEstoqueBaixo = Produto::where('estabelecimento_id', auth()->id())
            ->where('quantidade', '<', 10)
            ->exists();

        return view('vendas.index', compact('produtos', 'temEstoqueBaixo'));
    }


    // Registrar venda associando o estabelecimento logado e atualizar estoque
    public function store(Request $request, $id)
    {
        $request->validate([
            'quantidade_vendida' => 'required|integer|min:1',
        ], [
            'quantidade_vendida.required' => '⚠ Informe a quantidade a ser vendida.',
            'quantidade_vendida.integer' => '⚠ A quantidade deve ser um número inteiro.',
            'quantidade_vendida.min' => '⚠ A quantidade mínima para venda é 1.',
        ]);

        $produto = Produto::where('id', $id)
            ->where('estabelecimento_id', auth()->id())
            ->firstOrFail();

        if ($produto->quantidade >= $request->quantidade_vendida) {
            $valorTotal = $produto->preco * $request->quantidade_vendida;

            Venda::create([
                'produto_id' => $produto->id,
                'quantidade_vendida' => $request->quantidade_vendida,
                'preco_unitario' => $produto->preco,
                'valor_total' => $valorTotal,
                'estabelecimento_id' => auth()->id(),
            ]);

            // Atualiza o estoque
            $produto->atualizarEstoque($request->quantidade_vendida);

            // Mensagem de sucesso
            $mensagem = '✅ Venda realizada com sucesso!';

            // Verifica se o estoque está baixo
            $produto->refresh(); // TODO alterar essa mensagem aqui,q estão aparecendo as duas juntas
            if ($produto->quantidade < 10) {
                $mensagem .= ' ⚠ Estoque baixo de ' . $produto->nome . ': restam apenas ' . $produto->quantidade . ' unidades.';
            }

            return redirect()->route('vendas.index')->with('success', $mensagem);
        } else {
            return redirect()->route('vendas.index')->with('error', '❌ Quantidade insuficiente no estoque!');
        }
    }



    // Relatório mostrando apenas vendas do estabelecimento logado
    public function relatorio()
    {
        $vendas = Venda::with('produto')
            ->where('estabelecimento_id', auth()->id())
            ->get();

        return view('vendas.relatorio', compact('vendas'));
    }
}
