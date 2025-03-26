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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verifique se o usuário existe e se a senha está correta
        $estabelecimento = Estabelecimento::where('email', $request->email)->first();

        if (!$estabelecimento || !Hash::check($request->password, $estabelecimento->password)) {
            return redirect()->back()->with('error', 'Credenciais inválidas.');
        }

        // Autentica o usuário e cria o token de autenticação
        Auth::login($estabelecimento);
        $token = $estabelecimento->createToken('auth_token')->plainTextToken;

        return redirect('/produtos')->with('success', 'Login realizado com sucesso!');
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:3',
            'email' => 'required|email|unique:estabelecimentos,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            // Retorne para a página de cadastro com os dados e erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nome', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $estabelecimento = Estabelecimento::create($data);
        $token = $estabelecimento->createToken('auth_token')->plainTextToken;

        return redirect('/login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }

}
