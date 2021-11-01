<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Hash;

class Validation
{
    public static function accountValidation(Array $dados)
    {
        try {
            if(!count($dados)){
                return false;
            }
            
            $validacoes = ['name', 'document_number', 'birth_date', 'email', 'password', 'phone_number'];
            //Validação campos obrigatórios
            foreach ($validacoes as $campo) {
                if(!isset($dados[$campo])){
                    throw new Exception("$campo não fornecido");
                }

                switch (true) {
                    case $campo == 'name':
                        $dados[$campo] = mb_strtoupper($dados[$campo]);
                        break;
                    case $campo == 'document_number':
                        $dados[$campo] = str_replace(array("-", "."), '', $dados[$campo]);
                        break;
                    case $campo == 'email':
                        if(mb_strpos($dados[$campo], '@') === false){
                            throw new Exception('E-mail inválido');
                        }
                        break;
                    case $campo == 'password':
                        $dados[$campo] = Hash::make($dados[$campo]);
                        break;
                    case $campo == 'phone_number':
                        $dados[$campo] = str_replace(array("-", "(", ")"), '', $dados[$campo]);
                        break;
                    default:
                        break;
                }

                if(empty($dados[$campo])){
                    throw new Exception("Campo $campo inválido");
                }
            }

            $dados['user_type'] = 1;
            $dados['created_at'] = date('Y-m-d H:i:s');
            $dados['situation'] = 'A';

            return [
                'erro' => false,
                'dados' => $dados
            ];
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return [
                'erro' => true,
                'mensagem' => $ex->getMessage()
            ];
        }
    }
}
