<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Empresas;
use Illuminate\Http\Request;
use App\Events\Tenant\CriandoEmpresa;
use App\Events\Tenant\CriandoPassport;

class EmpresasController extends Controller{

    public function createEmpresa(Request $request) {
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $empresa = Empresas::create($request->all());
            $empresa->ativo = 1;
            $empresa->save();
            $segmento = $request->input('segmento');
            $_SESSION["segmento"] = $segmento;
            $fiscalizacao = $request->input('fiscalizacao');
            $_SESSION["fiscalizacao"] = $fiscalizacao;
            if($empresa->ativo == 1){
                event(new CriandoEmpresa($empresa));
            };
            return response()->json(['Sucesso' => 'Empresa cadastrada com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }

    }

    public function delete($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $empresa = Empresas::find($id);
            $empresa->ativo = 0;
            $empresa->save();
            return response()->json(['Sucesso' => 'Setor inativado com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listAll(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $empresasDB = DB::table('empresas')->where('ativo', 1)->orderBy('created_at','desc')->get();
            for ($i=0; $i < count($empresasDB); $i++) {
                $empresaAtual = [];
                $empresaAtual = $empresasDB[$i];
                $cidade = DB::table('cidades')->where('id',$empresasDB[$i]->municipio)->get();
                $uf = DB::table('estados')->where('id',$empresasDB[$i]->uf)->get();
                $cidadeEstado = array_merge(compact('cidade'),compact('uf'));

                $empresas[] = array_merge(compact('empresaAtual'),compact('cidadeEstado'));
            }
            return response()->json(compact('empresas'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOne($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $empresa = Empresas::find($id);
            return response()->json(compact('empresa'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function update($id, Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $empresa = Empresas::find($id);
            $empresa->update($request->all());
            return response()->json(compact('empresa'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listEstados(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $estados = DB::table('estados')->get();
            return response()->json(compact('estados'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listSegmentos(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $segmentos = DB::table('segmento')->get();
            return response()->json(compact('segmentos'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listCidades($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $cidades = DB::table('cidades')->where('id_estado',$id)->get();
            return response()->json(compact('cidades'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
