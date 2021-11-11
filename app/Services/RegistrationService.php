<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Exception;
use Illuminate\Support\Facades\Auth;

class RegistrationService
{
    public static function userRegistration(string $id)
    {
        try {
            if(empty($id)){
                throw new Exception('Necessário fornecer o ID da atividade');
            }

            if(!Activity::where('id', '=', $id)->count()){
                throw new Exception("Atividade de ID $id não encontrada na base. Por favor refaça o procedimento");
            }

            if(Registration::where('id_user', '=', Auth::user()->id)->where('id_activity', '=', $id)->count()){
                throw new Exception("Usuário já cadastrado nessa Atividade");
            }
            
            $dados['id_user'] = Auth::user()->id;
            $dados['id_activity'] = $id;
            $dados['created_at'] = date('Y-m-d H:i:s');
            $dados['situation'] = 'A';
            
            return [
                'erro' => false,
                'dados' => $dados
            ];
        } catch (Exception $ex) {
            return [
                'erro' => true,
                'mensagem' => $ex->getMessage()
            ];
        }
    }

}
