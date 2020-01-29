<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Interdicoes;

class InterdicoesController extends Controller{

    public function listInterdicoes(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $interdicoes = DB::table('interdicoes')->get();
            return response()->json(compact('interdicoes'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listInterdicao($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $interdicao = DB::table('interdicoes')->where('id', $id)->get();
            return response()->json(compact('interdicao'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
