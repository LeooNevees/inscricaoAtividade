<?php

namespace App\Services;

use App\Models\Activity;
use Exception;

class ActivityService
{
    public static function activityValidation(Array $dados)
    {
        try {
            if(!count($dados)){
                throw new Exception('Necessário fornecer os dados do formulário');
            }
            $validacoes = ['title', 'description'];
            //Validação campos obrigatórios
            foreach ($validacoes as $campo) {
                if(!isset($dados[$campo])){
                    throw new Exception("$campo não fornecido");
                }

                switch (true) {
                    case $campo == 'title':
                        $dados[$campo] = mb_strtoupper($dados[$campo]);
                        break;
                    case $campo == 'description':
                        $dados[$campo] = mb_strtoupper($dados[$campo]);
                        break;
                    default:
                        break;
                }

                if(empty($dados[$campo])){
                    throw new Exception("Campo $campo inválido");
                }
            }

            if(Activity::where('title', '=', $dados['title'])->count()){
                throw new Exception('Atividade com Título semelhante já cadastrado');
            }

            if(Activity::where('description', '=', $dados['description'])->count()){
                throw new Exception('Atividade com Descrição semelhante já cadastrado');
            }

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
