<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Itens;
use App\ProcessosSetor;
use App\NcItens;
use App\NaosConformidades;

class ItensController extends Controller
{
    public function createItens(Request $request, $idprocesso, $idsetor){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$item= DB::table('processos_setors')->where('processos_id', $idprocesso)->where('setors_id', $idsetor)->first();
			$processosetor = [
				"ativo"=>1,
				"nome"=>$request->input('nome'),
				"processos_setor_id"=>$item->id,
				"ajuda"=>$request->input('ajuda')
			];
			$teste = Itens::create($processosetor);
			$naocitens = $request->input('naoconformidades');
			if(isset($naocitens)){
	            for($i=0; $i < count($naocitens); $i++){
	                $ncitens = [
	                    'id_itens' => $teste->id,
	                    'id_ncitens' => $naocitens[$i]['id']
	                ];
	        		$naoconItens = NcItens::create($ncitens);		
	        	}
			}
			return response()->json(['Sucesso' => 'Item cadastrado com sucesso'], 201);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function deleteItens($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$item = Itens::find($id);
			$item->ativo = 0;
			$item->save();
			return response()->json(['Sucesso' => 'Item inativado com sucesso'], 200);	
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function listAllItens(){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$itenss = [];
			$itens = DB::table('itens')->where('ativo', 1)->get();
			$arrayitem=[];
			$itemncc=[];
			for($i=0; $i<count($itens); $i++){
				$teste = [];
				$ncitem = DB::table('nc_itens')->where('id_itens', $itens[$i]->id)->get();
				$teste[] = $itens[$i];
				for($j=0; $j<count($ncitem); $j++){
				$teste[] = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $ncitem[$j]->id_ncitens)->get();
				
				// if(count($naocitens)>0){
					$itemncc[]= $teste;
				// }else{
				// 	$itemncc[]= array_merge(compact($itens[$i]), []);
				// }
				}
				$itenss[] = $teste;
			}
			

			return response()->json(compact('itenss'), 200);	
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function listOneItens($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$item = DB::table('itens')->where('ativo', 1)->where('id', $id)->get();
			$ncitem[] = DB::table('nc_itens')->where('id_itens', $id)->get();
		
			if(count($ncitem[0]) > 0){
				for($i=0; $i<count($ncitem[0]); $i++){
					$naocitens[] = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $ncitem[0][$i]->id_ncitens)->get();
				}
				return response()->json(compact('item', 'naocitens'), 200);
			}else	{
				return response()->json(compact('item'), 200);	
			}
		}else{
			return response()->json('Token Inválido!');
		}
	}
	public function listitensbyprocessosetor($idprocesso, $idsetor){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$listitens= DB::table('processos_setors')->where('processos_id', $idprocesso)->where('setors_id', $idsetor)->first();
			$itens=DB::table('itens')->where('processos_setor_id', $listitens->id)->get();
			return response()->json(compact('itens'), 200);	
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function updateItens($id,$idprocesso, $idsetor, Request $request){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$aut = DB::table('nc_itens')->where('id_itens', $id)->delete();
			$itemid = Itens::find($id);
			$item= DB::table('processos_setors')->where('processos_id', $idprocesso)->where('setors_id', $idsetor)->first();
				$itemid->nome = $request->input('nome');
				$itemid->ajuda = $request->input('ajuda');
				$itemid->save();
			$naocitens = $request->input('naoconformidades');
			if(isset($naocitens)){
	            for($i=0; $i < count($naocitens); $i++){
	                $ncitens = [
	                    'id_itens' => $itemid->id,
	                    'id_ncitens' => $naocitens[$i]['id']
	                ];
	        		$naoconItens = NcItens::create($ncitens);		
	        	}
			}
			return response()->json(['Sucesso' => 'Item atualizado com sucesso'], 201);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function verificacaoToken(){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			return response()->json('Token Válido!');	
		}else{
			return response()->json('Token Inválido!');
		}
	}
}
