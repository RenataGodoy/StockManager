<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Estabelecimento;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'string',
                'email',
            ],
            'password' => 'required|min:5',
        ], [
            'cnpj.required' => '⚠ O campo CNPJ é obrigatório.',
            'cnpj.regex' => '⚠ O formato do CNPJ está inválido. Exemplo: 00.000.000/0000-00',
            'password.required' => '⚠ A senha é obrigatória.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenera sessão para segurança

            return redirect('/produtos')->with('success', 'Login realizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Credenciais inválidas.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // App\Http\Controllers\FrontendController.php

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:255|unique:estabelecimentos,email',
            'password' => 'required|string|min:6|max:30|confirmed',
            'cnpj' => [
                'required',
                'string',
                'min:14',  // CNPJ tem 14 dígitos
                'max:18',  // considerando formatação (ex: 00.000.000/0000-00)
                // regex para validar formato CNPJ
                'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/',
            ],
            'nome_empresa' => 'required|string|min:3|max:255',
            'telefone' => [
                'required',
                'string',
                'min:10',
                'max:15',
                // regex para telefones brasileiros (ex: (11) 99999-9999)
                'regex:/^\(?\d{2}\)?\s?\d{4,5}\-?\d{4}$/',
            ],
        ], [
            'nome.required' => '⚠ O campo nome é obrigatório.',
            'nome.min' => '⚠ O nome deve ter no mínimo :min caracteres.',
            'nome.max' => '⚠ O nome deve ter no máximo :max caracteres.',

            'email.required' => '⚠ O campo email é obrigatório.',
            'email.email' => '⚠ Informe um email válido.',
            'email.max' => '⚠ O email não pode ultrapassar 255 caracteres.',
            'email.unique' => '⚠ Este email já está cadastrado.',

            'password.required' => '⚠ A senha é obrigatória.',
            'password.min' => '⚠ A senha deve ter no mínimo :min caracteres.',
            'password.max' => '⚠ A senha deve ter no máximo :max caracteres.',
            'password.confirmed' => '⚠ As senhas não conferem.',

            'cnpj.required' => '⚠ O campo CNPJ é obrigatório.',
            'cnpj.min' => '⚠ O CNPJ deve ter ao menos :min caracteres.',
            'cnpj.max' => '⚠ O CNPJ não pode ultrapassar :max caracteres.',
            'cnpj.regex' => '⚠ O formato do CNPJ está inválido. Exemplo: 00.000.000/0000-00',

            'nome_empresa.required' => '⚠ O nome da empresa é obrigatório.',
            'nome_empresa.min' => '⚠ O nome da empresa deve ter no mínimo :min caracteres.',
            'nome_empresa.max' => '⚠ O nome da empresa deve ter no máximo :max caracteres.',

            'telefone.required' => '⚠ O telefone é obrigatório.',
            'telefone.min' => '⚠ O telefone deve ter no mínimo :min caracteres.',
            'telefone.max' => '⚠ O telefone deve ter no máximo :max caracteres.',
            'telefone.regex' => '⚠ Formato do telefone inválido. Exemplo: (11) 99999-9999',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nome', 'email', 'password', 'cnpj', 'nome_empresa', 'telefone']);
        $data['password'] = bcrypt($data['password']);

        $estabelecimento = Estabelecimento::create($data);

        Auth::login($estabelecimento);

        return redirect('/produtos')->with('success', 'Cadastro realizado com sucesso! Seja bem-vindo(a)!');
    }

}
