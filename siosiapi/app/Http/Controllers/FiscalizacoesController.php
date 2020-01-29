<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Fiscalizacao;

class FiscalizacoesController extends Controller{

    public function listFiscalizacoes(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $fiscalizacoes = DB::table('fiscalizacao')->get();
            return response()->json(compact('fiscalizacoes'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
