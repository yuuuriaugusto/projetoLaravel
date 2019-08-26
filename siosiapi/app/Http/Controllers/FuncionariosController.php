<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Funcionarios;

class FuncionariosController extends Controller
{
    public function createFuncionario(Request $request){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $funcionario = Funcionarios::create($request->all());
            $funcionario->ativo = 1;
            $funcionario->save();
            return response()->json(['Sucesso' => 'Funcionário cadastrado com sucesso'], 201);
        }else {
            return response()->json('Token Inválido!');
        }
    }

    public function listAllFuncionario(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $funcionariosDB = DB::table('funcionarios')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($funcionariosDB); $i++) {
                $funcionarioAtual = [];
                $funcionarioAtual["funcionario"] = $funcionariosDB[$i];
                $funcionarios[] = $funcionarioAtual;
            }
            return compact('funcionarios');
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listFuncionario($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $funcio = Funcionarios::find($id);
            return response()->json(compact('funcio'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function updateFuncionario($id, Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $funcio = Funcionarios::find($id);
            $funcio->update($request->all());
            return response()->json(compact('funcio'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function deleteFuncionario($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $funcionario = Funcionarios::find($id);
            $funcionario->ativo = 0;
            $funcionario->save();
            return response()->json(['Sucesso' => 'Funcionário inativado com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
