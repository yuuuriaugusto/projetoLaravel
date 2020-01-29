<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Processos;
use Illuminate\Support\Facades\DB;
use App\Setors;

class ProcessosController extends Controller
{
    public function createProcesso(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processo = Processos::create($request->all());
            $processo->ativo = 1;
            $processo->save();
            return response()->json(['Sucesso' => 'Processo cadastrado com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function deleteProcesso($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processo = Processos::find($id);
            $processo->ativo = 0;
            $processo->save();
            return response()->json(['Sucesso' => 'Processo inativado com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listAllProcessos(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
           $processos = DB::table('processos')->where('ativo', 1)->orderBy('nome', 'ASC')->get();
            $result = [];
            for($i=0; $i<count($processos); $i++){
                $processo = [];
                $setores = [];
                $itens = [];
                $processo["processo"] = $processos[$i];
                $setorproc = DB::table('processos_setors')->select('setors_id','processos_setors.id AS _idprocessos_setors')->join('setors', 'setors.id', '=', 'processos_setors.setors_id')->where('setors.ativo', 1)->where('processos_id', $processos[$i]->id)->orderBy('setors.nome', 'ASC')->get();
                for($j = 0; $j<count($setorproc); $j++){
                    $setorAtual = [];
                    $setorAtual['setor'] = Setors::find($setorproc[$j]->setors_id);

                    $item = [];
                    $itemConformidade = DB::table('itens')->where('ativo', 1)->where('processos_setor_id' ,$setorproc[$j]->_idprocessos_setors)->orderBy('nome', 'ASC')->get();
                    $itemTemperatura = DB::table('itens_temperaturas')->where('ativo', 1)->where('processo_setor_id', $setorproc[$j]->_idprocessos_setors)->orderBy('nome', 'ASC')->get();
                    $item["conformidade"] = $itemConformidade;
                    $item["temperatura"] = $itemTemperatura;
                    if(count($item) > 0){
                        $setores[] = array_merge($setorAtual, compact('item'));
                    }
                    else{
                        $setores[] = array_merge($setorAtual, []);
                    };
                };
                $result[] = array_merge($processo, compact('setores'));
            };
            $listagem = $result;
            return response()->json(compact('listagem'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listOneProcesso($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processo=[];
            $processo[] = Processos::find($id);
            $setorproc= DB::table('processos_setors')->where('processos_id', $processo[0]->id)->get();
            if (count($setorproc) > 0) {
                for($j = 0; $j<count($setorproc); $j++){
                    $setorAtual = [];
                    $setorAtual["setor"] = Setors::find($setorproc[$j]->setors_id);
                    $item = [];
                    $itemConformidade = DB::table('itens')->where('ativo', 1)->where('processos_setor_id', $setorproc[$j]->id)->get();
                    $itemTemperatura = DB::table('itens_temperaturas')->where('ativo', 1)->where('processo_setor_id', $setorproc[$j]->id)->get();
                    $item["conformidade"] = $itemConformidade;
                    $item["temperatura"] = $itemTemperatura;

                    if(count($item) > 0){
                        $setor[] = array_merge($setorAtual, compact('item'));
                    }else{
                        $setor[] = array_merge($setorAtual, []);
                    }
                }
                $result[] = array_merge($processo, compact('setor'));
            }else {
                $result[] = $processo;
            }
            $listagem = $result;
            return response()->json(compact('listagem'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function updateProcesso($id, Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processo = Processos::find($id);
            $processo->update($request->all());
            return response()->json(compact('processo'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
}
