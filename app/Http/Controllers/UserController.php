<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Services\Validation;
use Exception;

class UserController extends Controller
{
    public function home(string $message = null)
    {
        $mensagem = ['msg' => !empty($message) ? Crypt::decrypt($message) : ''];
        return view('user', compact('mensagem'));
    }

    public function entry(Request $req)
    {
        $dados = $req->all();
        $dados['email'] = mb_strtoupper($dados['email']);
        
        if(Auth::attempt(['email' => $dados['email'], 'password' => $dados['password']])){
            $req->session()->regenerate();
            // return redirect()->intended('home');
            return redirect()->route('home');
        }
        $msg = Crypt::encrypt('Credenciais Inválidas');
        return redirect()->route('user.home', ['msg' => $msg]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function registerAccount(string $message = null)
    {
        $mensagem = [
            'error' => !empty($message) && strpos(Crypt::decrypt($message), 'sucesso') !== false ? false : true,
            'msg' => !empty($message) ? Crypt::decrypt($message) : ''
        ];
        return view('registerUser', compact('mensagem'));
    }

    public function createAccount(Request $req)
    {
        try {
            
            $dados = (array) $req->all();
            $retorno = Validation::accountValidation($dados);
            if($retorno === false){
                throw new Exception($retorno['mensagem']);
            }        
            
            // if(DB::table('usuarios')->where('email', $dados['email'])->count()){
            //     throw new Exception('E-mail já cadastrado');
            // }

            if(User::where('email', '=', $retorno['dados']['email'])->count()){
                throw new Exception('E-mail já cadastrado');
            }

            if(User::where('document_number', '=', $retorno['dados']['document_number'])->count()){
                throw new Exception('CPF já cadastrado');
            }

            User::create($retorno['dados']);
            $msg = Crypt::encrypt('Usuário cadastrado com sucesso!');
            return redirect()->route('user.register', $msg);
        } catch (Exception $ex) {
            $msg = Crypt::encrypt($ex->getMessage());
            return redirect()->route('user.register', $msg);
        }
    }
}
