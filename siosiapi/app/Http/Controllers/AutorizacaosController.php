<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacaos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\PersonalAccessTokenResult;

class AutorizacaosController extends Controller
{
    //funções de listar as autorizações por papel 
    public function listagemPermissaoPapel($id){
    	$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
	    	$permissoes = DB::table('autorizacaos')->where('id_papels', $id)->get();
	        return response()->json(compact('permissoes'), 200);
        }else{
       		return response()->json('Token Inválido!');
        }  
    }

    //função para listar as autorizações por setor
    public function listagemPermissaoSetor($id){
    	$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
	    	$permissoes = DB::table('autorizacaos')->where('id_setors', $id)->get();
	        return response()->json(compact('permissoes'), 200);
       	}else{
   			return response()->json('Token Inválido!');
        } 
    }
}
