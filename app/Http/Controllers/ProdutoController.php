<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Metodo para listar todos os produtos
    public function index()
    {
        $produtos = Produto::where('status', 'ativo')->get();
        return view('produtos.index', compact('produtos'));
    }

    // Metodo para exibir o formulário de cadastro de produto
    public function create()
    {
        return view('produtos.create');
    }

    // Metodo para salvar o produto no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    // Metodo para exibir o formulário de edição
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    // Metodo para atualizar o produto no banco
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Metodo para inativar um produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->status = 'inativo';
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto inativado com sucesso!');
    }
}

