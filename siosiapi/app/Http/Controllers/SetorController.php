<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Processos;
use App\Setors;
use App\ProcessosSetor;
use App\User;

class SetorController extends Controller
{
    public function create(Request $request){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$setor = Setors::create($request->all());
			$setor->ativo = 1;
			$setor->save();
			$processo = Processos::find($request->input('processos_id'));
			$qualquer = ProcessosSetor::create(['setors_id'=>$setor->id,'processos_id'=>$request->input('processos_id')]);
		//  $processo->setor()->attach($setor->id);
			return response()->json(['Sucesso' => 'Setor cadastrado com sucesso'], 201);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function delete($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$setor = Setors::find($id);
			$setor->ativo = 0;
			$setor->save();
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
			// $setores = Setors::get();
			$setores = DB::table('setors')->where('ativo', 1)->get();
			return response()->json(compact('setores'), 200);	
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function listOne($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$setor = Setors::find($id);
			return response()->json(compact('setor'), 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}
	public function listsetorbyprocesso($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$listsetorprocess= DB::table('processos_setors')->where('processos_id', $id)->get();
			$retorno=[];
			for($i=0;$i<count($listsetorprocess);$i++){
				$retorno[]=Setors::find($listsetorprocess[$i]->setors_id);
			}
			return response()->json(compact('retorno'), 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function update($id, Request $request){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$setor = Setors::find($id);
			$setor->update($request->all());
			return response()->json(compact('setor'), 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}
	public function searchsetor(Request $request, $busca ){
		$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
			$nomesetor = Setors::where('nome', 'like', '%'.$busca.'%')->get();
			
			return response()->json(['Setores' => $nomesetor]);	
		}
		else{
			return response()->json('Token Inválido!');
		}
	}
}
