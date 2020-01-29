<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ItensTemperaturas;
use App\ProcessosSetor;
use App\NcItensTemps;

class ItensTemperaturasController extends Controller{
    public function createItensTemperaturas(Request $request, $idprocesso, $idsetor){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $item= DB::table('processos_setors')->where('processos_id', $idprocesso)->where('setors_id', $idsetor)->first();
            $tempMin = $request->input('temperatura_minima');
            $tempMax = $request->input('temperatura_maxima');
            $processosetor = [
                "ativo"=>1,
                "nome"=>$request->input('nome'),
                "processo_setor_id"=>$item->id,
                "temperatura_minima"=>$tempMin,
                "temperatura_maxima"=>$tempMax,
				"ajuda"=>$request->input('ajuda')
            ];
            $criarItem = ItensTemperaturas::create($processosetor);
            $naocitens = $request->input('naoconformidades');
            if(isset($naocitens)){
                for($i=0; $i < count($naocitens); $i++){
                    $ncitens = [
                        'id_itens_temperatura' => $criarItem->id,
                        'id_ncitens' => $naocitens[$i]['id']
                    ];
                    $naoconItens = NcItensTemps::create($ncitens);
                }
            }
            return response()->json(['Sucesso' => 'Item cadastrado com sucesso'], 201);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }

    public function deleteItensTemperaturas($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $item = ItensTemperaturas::find($id);
            $item->ativo = 0;
            $item->save();
            return response()->json(['Sucesso' => 'Item inativado com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function updateItensTemperaturas($id, $idprocesso, $idsetor, Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $aut = DB::table('nc_itens_temps')->where('id_itens_temperatura', $id)->delete();
            $itemid = ItensTemperaturas::find($id);
            $item= DB::table('processos_setors')->where('processos_id', $idprocesso)->where('setors_id', $idsetor)->first();
            $itemid->nome = $request->input('nome');
            $itemid->temperatura_minima = $request->input('temperatura_minima');
            $itemid->temperatura_maxima = $request->input('temperatura_maxima');
            $itemid->ajuda = $request->input('ajuda');
            $itemid->save();
            $naocitens = $request->input('naoconformidades');
			if(isset($naocitens)){
	            for($i=0; $i < count($naocitens); $i++){
	                $ncitens = [
	                    'id_itens_temperatura' => $itemid->id,
	                    'id_ncitens' => $naocitens[$i]['id']
	                ];
	        		$naoconItens = NcItensTemps::create($ncitens);
	        	}
			}
            return response()->json(['Sucesso' => 'Item atualizado com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAllItensTemperaturas(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $itensTemperatura = DB::table('itens_temperaturas')->where('ativo', 1)->get();

            return response()->json(compact('itensTemperatura'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOneItensTemperaturas($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            // $itemTemperatura = DB::table('itens_temperaturas')->where('ativo', 1)->where('id', $id)->first();
            //
            // return response()->json(compact('itemTemperatura'), 200);

            $itemTemperatura = DB::table('itens_temperaturas')->where('ativo', 1)->where('id', $id)->first();
            $ncitem[] = DB::table('nc_itens_temps')->where('id_itens_temperatura', $id)->get();

            if(count($ncitem[0]) > 0){
                for($i=0; $i<count($ncitem[0]); $i++){
                    $naocitens[] = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $ncitem[0][$i]->id_ncitens)->get();
                }
                return response()->json(compact('itemTemperatura', 'naocitens'), 200);
            }else	{
                return response()->json(compact('itemTemperatura'), 200);
            }

        }
        else{
            return response()->json('Token Inválido!');
        }
    }
}
