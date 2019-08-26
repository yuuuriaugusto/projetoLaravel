<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\PersonalAccessTokenResult;
use App\PapelsUsers;
use Illuminate\Support\Facades\DB;

class ValidarPapelController extends Controller
{
    public function validarPapel(Request $request){
    	$setores = $request->input('setor'); //vai ser um array com os setores que o usuário logado está tentando ver
    	$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
    		//conferir os setores dos papeis do usuário logado
	    	$papeis = DB::table('papels_users')->where('id_users', $id)->get();

	    	$autorizado = [];

	    	for($i=0; $i<count($papeis); $i++){
	    		for($j=0; $j<count($setores); $j++){
	    			if($papeis[$i] == $setores[$j]){
	    				$autorizado = ['setor' => $setores[$j]];
	    			}
	    		}
	    	}

       		return response()->json(compact('autorizado'), 200);

        	//pegar os setores dos papeis
        }else{
       		return response()->json('Token Inválido!');
        }
    }
}
