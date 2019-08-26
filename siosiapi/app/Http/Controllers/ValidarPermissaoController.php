<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\PersonalAccessTokenResult;

class ValidarPermissaoController extends Controller
{
    public function validarPerfil(){
    	$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
    		//validar qual é a permissão do usuário logado
        		
        }else{
       		return response()->json('Token Inválido!');
        }
    }

    //validar se o setor atual está na permissão

    //retornar o resultado
}
