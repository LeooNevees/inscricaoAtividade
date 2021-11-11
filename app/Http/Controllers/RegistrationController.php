<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Services\RegistrationService;
use Exception;
use Illuminate\Support\Facades\Crypt;

class RegistrationController extends Controller
{
    public function userRegistration(int $id)
    {
        try {
            if(empty($id)){
                throw new Exception('Erro ao identificar o ID da atividade. Por favor refaça o procedimento');
            }
            $retorno = RegistrationService::userRegistration($id);
            if($retorno['erro'] === true){
                throw new Exception($retorno['mensagem']);
            }  
            
            Registration::create($retorno['dados']);
            $msg = Crypt::encrypt('Inscrição realizada com sucesso!');
            return redirect()->route('activity.home', $msg);
        } catch (Exception $ex) {
            $msg = Crypt::encrypt($ex->getMessage());
            return redirect()->route('activity.home', $msg);
        }
    }
}
