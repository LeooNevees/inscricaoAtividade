<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Services\Validation;
use Exception;

class ActivityController extends Controller
{
    public function home(string $message = null)
    {
        $mensagem = ['msg' => !empty($message) ? Crypt::decrypt($message) : ''];
        $atividades = Activity::all();
        return view('activity', compact('atividades'));
    }

    public function registerActivity(string $message = null)
    {
        $mensagem = [
            'error' => !empty($message) && strpos(Crypt::decrypt($message), 'sucesso') !== false ? false : true,
            'msg' => !empty($message) ? Crypt::decrypt($message) : ''
        ];
        return view('registerActivity', compact('mensagem'));
    }

    public function createActivity(Request $req)
    {
        try {     
            $dados = (array) $req->all();
            $retorno = Validation::activityValidation($dados);
            if($retorno === false){
                throw new Exception($retorno['mensagem']);
            }
                        
            if(Activity::where('title', '=', $retorno['dados']['title'])->count()){
                throw new Exception('Atividade com Título semelhante já cadastrado');
            }

            if(Activity::where('description', '=', $retorno['dados']['description'])->count()){
                throw new Exception('Atividade com Descrição semelhante já cadastrado');
            }

            Activity::create($retorno['dados']);
            $msg = Crypt::encrypt('Atividade cadastrada com sucesso!');
            return redirect()->route('activity.register', $msg);
        } catch (Exception $ex) {
            $msg = Crypt::encrypt($ex->getMessage());
            return redirect()->route('activity.register', $msg);
        }
    }
}