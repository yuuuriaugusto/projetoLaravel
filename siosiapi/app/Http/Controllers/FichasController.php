<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Fichas;
use App\NaosconformidadesItens;



class FichasController extends Controller
{
    public function createFichas(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $ficha = Fichas::create($request->all());
            return response()->json(['Sucesso' => 'Ficha cadastrada com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAllFichas(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $ficha = Fichas::get();
            return response()->json(compact('ficha'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listOneFicha($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $ficha= Fichas::find($id);
            return response()->json(compact('ficha'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
