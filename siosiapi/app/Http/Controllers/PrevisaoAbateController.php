<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\PrevisaoAbates;

class PrevisaoAbateController extends Controller
{
    public function createPrevisaoAbate(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $previsaoAbate = [];
            $itensPrevisao = $request->input('itensPrevisao');
            for($i = 0; $i < count($itensPrevisao); $i++){
                $previsaoAbate = PrevisaoAbates::create($itensPrevisao[$i]);
                $previsaoAbate->save();
            };
            return response()->json(['Sucesso' => 'Previsão de abate cadastrado com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listPrevisaoAbateByDate($dataBusca){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            
            $listagemPrevisao = DB::table('previsao_abates')->where('data_previsao_abate', $dataBusca)->get();

            return response()->json($listagemPrevisao);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
