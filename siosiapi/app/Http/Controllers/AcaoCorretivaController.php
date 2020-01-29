<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AcoesCorretivas;

class AcaoCorretivaController extends Controller
{
    public function createAcaoCorretiva(Request $request){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $acoescorretivas = AcoesCorretivas::create($request->all());
            $acoescorretivas->ativo = 1;
            $acoescorretivas->save();
            return response()->json(['Sucesso' => 'Ação Corretiva cadastrada com sucesso'], 201);
        }else {
            return response()->json('Token Inválido!');
        }
    }

    public function listAllAcaoCorretiva(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){

            $acoescorretivasDB = DB::table('acoes_corretivas')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($acoescorretivasDB); $i++) {
                $acoescorretivaAtual = [];
                $acoescorretivaAtual["acaocorretiva"] = $acoescorretivasDB[$i];
                $acoescorretivas[] = $acoescorretivaAtual;
            }
            return compact('acoescorretivas');


            // $acoescorretivas = DB::table('acoes_corretivas')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            // return response()->json(compact('acoescorretivas'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAllAcaoPreventiva(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){

            $acoespreventivasDB = DB::table('acoes_corretivas')->where('ativo', 1)->where('preventiva', 1)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($acoespreventivasDB); $i++) {
                $acoespreventivasAtual = [];
                $acoespreventivasAtual["acaopreventiva"] = $acoespreventivasDB[$i];
                $acoespreventivas[] = $acoespreventivasAtual;
            }
            return compact('acoespreventivas');
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAcaoCorretiva($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $acaocorretiva = AcoesCorretivas::find($id);
            return response()->json(compact('acaocorretiva'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAcaoPreventiva($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $acaopreventiva = AcoesCorretivas::find($id);
            return response()->json(compact('acaocorretiva'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function update($id, Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $acaocorretiva = AcoesCorretivas::find($id);
            $acaocorretiva->update($request->all());
            return response()->json(compact('acaocorretiva'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function deleteAC($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $acaocorretiva = AcoesCorretivas::find($id);
            $acaocorretiva->ativo = 0;
            $acaocorretiva->save();
            return response()->json(['Sucesso' => 'Ação corretiva inativada com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function searchacaocorretiva(Request $request, $busca ){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $nomeacaocorretiva = AcoesCorretivas::where('nome', 'like', '%'.$busca.'%')->get();

            return response()->json(['AcaoCorretiva' => $nomeacaocorretiva]);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
}
