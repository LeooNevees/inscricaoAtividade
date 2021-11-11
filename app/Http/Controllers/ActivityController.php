<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Services\ActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function home(string $message = null)
    {
        $mensagem = [
            'error' => !empty($message) && strpos(Crypt::decrypt($message), 'sucesso') !== false ? false : true,
            'msg' => !empty($message) ? Crypt::decrypt($message) : '',
            'userRegistration' => Registration::select('id_activity')->where('id_user', '=', Auth::user()->id)->get(),
            'activities' => Activity::where('situation', '=', 'A')->get()
        ];
        
        return view('activity', compact('mensagem'));
    }

    public function createActivity(Request $req)
    {
        try {     
            $dados = (array) $req->all();
            $retorno = ActivityService::activityValidation($dados);
            if($retorno === false){
                throw new Exception($retorno['mensagem']);
            }

            Activity::create($retorno['dados']);

            $mensagem = [
                'error' => false,
                'msg' => 'Atividade cadastrada com sucesso!'
            ];
            return view('registerActivity', compact('mensagem'));
        } catch (Exception $ex) {
            $mensagem = [
                'error' => true,
                'msg' => $ex->getMessage()
            ];
            return view('registerActivity', compact('mensagem'));
        }
    }

    public function InactivateActivity(int $idActivity)
    {
        try {
            if(empty($idActivity)){
                throw new Exception("Não fornecido o ID para desativar Atividade");
            }

            if(!Activity::where('id', '=', $idActivity)->count()){
                throw new Exception("Id $idActivity não localizado. Por favor recarregue a Página");
            }
            
            if(!Activity::where('id', $idActivity)->update(['situation' => 'I'])){
                throw new Exception("Erro ao tentar inativar Atividade. Por favor refaça o procedimento");
            }

            $msg = Crypt::encrypt('Atividade inatividada com sucesso!');
            return redirect()->route('activity.home', $msg);
        } catch (Exception $ex) {
            $msg = Crypt::encrypt($ex->getMessage());
            return redirect()->route('activity.home', $msg);
        }
    }
}