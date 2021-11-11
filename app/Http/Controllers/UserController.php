<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    public function entry(Request $req)
    {
        $dados = $req->all();
        $dados['email'] = mb_strtoupper($dados['email']);
        
        if(Auth::attempt(['email' => $dados['email'], 'password' => $dados['password']])){
            $req->session()->regenerate();
            // return redirect()->intended('home');
            return redirect()->route('home');
        }

        $mensagem['msg'] = 'Credenciais Inválidas';
        return view('user', compact('mensagem'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function createAccount(Request $req)
    {
        try {
            $dados = (array) $req->all();
            $retorno = UserService::accountValidation($dados);
            if($retorno === false){
                throw new Exception($retorno['mensagem']);
            }        

            User::create($retorno['dados']);
            $mensagem = [
                'error' => false,
                'msg' => 'Usuário cadastrado com sucesso!'
            ];
            return view('registerUser', compact('mensagem'));
        } catch (Exception $ex) {
            $mensagem = [
                'error' => true,
                'msg' => $ex->getMessage()
            ];
            return view('registerUser', compact('mensagem'));
        }
    }
}
