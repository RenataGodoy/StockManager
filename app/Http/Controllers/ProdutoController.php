<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Listar apenas os produtos ativos do estabelecimento logado
    public function index()
    {
        $produtos = Produto::where('estabelecimento_id', auth()->id())
            ->where('status', 'ativo')
            ->get();


        return view('produtos.index', compact('produtos'));
    }

    // Formulário para criar produto
    public function create()
    {
        return view('produtos.create');
    }

    // Salvar produto associando ao estabelecimento logado
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:100',
            'descricao' => 'required|string|min:5|max:1000',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0',
        ], [
            'nome.required' => '⚠ O nome do produto é obrigatório.',
            'nome.min' => '⚠ O nome do produto deve ter no mínimo :min caracteres.',
            'nome.max' => '⚠ O nome do produto deve ter no máximo :max caracteres.',

            'descricao.required' => '⚠ A descrição do produto é obrigatória.',
            'descricao.min' => '⚠ A descrição deve ter no mínimo :min caracteres.',
            'descricao.max' => '⚠ A descrição deve ter no máximo :max caracteres.',

            'preco.required' => '⚠ O preço é obrigatório.',
            'preco.numeric' => '⚠ O preço deve ser um número válido.',
            'preco.min' => '⚠ O preço deve ser maior que zero.',

            'quantidade.required' => '⚠ A quantidade é obrigatória.',
            'quantidade.integer' => '⚠ A quantidade deve ser um número inteiro.',
            'quantidade.min' => '⚠ A quantidade não pode ser negativa.',
        ]);

        // Pega o ID do estabelecimento logado
        $estabelecimentoId = auth()->id();

        // Junta os dados do request com o estabelecimento_id
        $data = $request->all();
        $data['estabelecimento_id'] = $estabelecimentoId;
        $data['status'] = 'ativo';

        Produto::create($data);

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }


    // Formulário para editar produto, só permite se for do estabelecimento
    public function edit($id)
    {
        $produto = Produto::where('id', $id)
            ->where('estabelecimento_id', auth()->id())
            ->firstOrFail();

        return view('produtos.edit', compact('produto'));
    }

    // Atualizar produto (apenas do estabelecimento logado)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|min:3|max:100',
            'descricao' => 'required|string|min:5|max:1000',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0',
        ], [
            'nome.required' => '⚠ O nome do produto é obrigatório.',
            'nome.min' => '⚠ O nome do produto deve ter no mínimo :min caracteres.',
            'nome.max' => '⚠ O nome do produto deve ter no máximo :max caracteres.',

            'descricao.required' => '⚠ A descrição do produto é obrigatória.',
            'descricao.min' => '⚠ A descrição deve ter no mínimo :min caracteres.',
            'descricao.max' => '⚠ A descrição deve ter no máximo :max caracteres.',

            'preco.required' => '⚠ O preço é obrigatório.',
            'preco.numeric' => '⚠ O preço deve ser um número válido.',
            'preco.min' => '⚠ O preço deve ser maior que zero.',

            'quantidade.required' => '⚠ A quantidade é obrigatória.',
            'quantidade.integer' => '⚠ A quantidade deve ser um número inteiro.',
            'quantidade.min' => '⚠ A quantidade não pode ser negativa.',
        ]);

        $produto = Produto::where('id', $id)
            ->where('estabelecimento_id', auth()->id())
            ->firstOrFail();

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Inativar produto (só do estabelecimento logado)
    public function destroy($id)
    {
        $produto = Produto::where('id', $id)
            ->where('estabelecimento_id', auth()->id())
            ->firstOrFail();

        $produto->status = 'inativo';
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto inativado com sucesso!');
    }


}
