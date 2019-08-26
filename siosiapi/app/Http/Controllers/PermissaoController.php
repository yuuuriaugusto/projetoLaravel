<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laravel\Passport\PersonalAccessTokenResult;
use App\Permissoes;

class PermissaoController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $permissao = Permissoes::create($request->all());
            return response()->json(['Sucesso' => 'Permissão cadastrada com sucesso']);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function update(Request $request, $id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $permissao = Permissoes::find($id);
            $permissao->update($request->all());
            return response()->json(['Sucesso' => 'Permissão editada com sucesso']);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAll(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $permissoes = Permissoes::get();
            return response()->json(compact('permissoes'));
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listOne($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $permissao = Permissoes::find($id);
            return response()->json(compact('permissao'));
        }else{
            return response()->json('Token Inválido!');
        }
    }

}
