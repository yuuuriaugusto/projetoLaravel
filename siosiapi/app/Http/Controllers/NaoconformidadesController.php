<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\NaosConformidades;
use App\AcoesNaoconformidades;

class NaoconformidadesController extends Controller
{
    public function create(Request $request){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$naoconformidade = NaosConformidades::create($request->all());
			$naoconformidade->ativo = 1;
			$naoconformidade->save();

			$acaocorretiva = $request->input('acaocorretivas');
            for($i=0; $i < count($acaocorretiva); $i++){
                $dados = [
                    'id_naoconformidade' => $naoconformidade->id,
                    'id_acoescorretivas' => $acaocorretiva[$i]['id']
                ];
        		$ncacoes = AcoesNaoconformidades::create($dados);
        	}
			return response()->json(['Sucesso' => 'Não conformidade cadastrada com sucesso'], 201);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function delete($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$naoconformidade = NaosConformidades::find($id);
			$naoconformidade->ativo = 0;
			$naoconformidade->save();
			return response()->json(['Sucesso' => 'Não conformidade inativada com sucesso'], 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function listAll(){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
            $naoconformidadesDB = DB::table('naos_conformidades')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($naoconformidadesDB); $i++) {
                $naoconformidadeAtual = [];
                $naoconformidadeAtual["naoconformidade"] = $naoconformidadesDB[$i];
                $naoconformidades[] = $naoconformidadeAtual;
            }
            return compact('naoconformidades');
		}else{
			return response()->json('Token Inválido!');
		}
	}
	public function listnaocorretivasitem($iditem){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$item = DB::table('itens')->where('ativo', 1)->where('id', $iditem)->get();
			$ncitem  = DB::table('nc_itens')->where('id_itens', $iditem)->get();
			$naoConformidadesEAcoesCorretivas = [];
			$resultado = [];
			if(count($ncitem)>0){
				for($i=0; $i<count($ncitem); $i++){
					$naoconformidades[] = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $ncitem[$i]->id_ncitens)->get();
					for($j = 0; $j<count($naoconformidades); $j++){
						$acao[] = DB::table('acoes_naoconformidades')->where('id_naoconformidade',$naoconformidades[$j][0]->id)->get();
					}
					for($k = 0; $k<count($acao); $k++){
						$acoescorretivas = [];
						for($l = 0; $l<count($acao[$k]); $l++){
							$acoescorretivas[] = DB::table('acoes_corretivas')->where('id',$acao[$k][$l]->id_acoescorretivas)->get();
						}
					}
					$nconfatual = $naoconformidades[$i];
					$resultado[] = array_merge(compact('nconfatual'), compact('acoescorretivas'));
					$acao = [];
				}
				$naoConformidadesEAcoesCorretivas = $resultado;
			}else{
				$naoConformidadesEAcoesCorretivas = [];
			}
				return response()->json(compact('naoConformidadesEAcoesCorretivas'), 200);

		}else{
			return response()->json('Token Inválido!');
		}
	}
    public function listnaocorretivasitemtemp($iditem){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $item = DB::table('itens')->where('ativo', 1)->where('id', $iditem)->get();
            $ncitem  = DB::table('nc_itens_temps')->where('id_itens_temperatura', $iditem)->get();
            $naoConformidadesEAcoesCorretivas = [];
            $resultado = [];
            if(count($ncitem)>0){
                for($i=0; $i<count($ncitem); $i++){
                    $naoconformidades[] = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $ncitem[$i]->id_ncitens)->get();
                    for($j = 0; $j<count($naoconformidades); $j++){
                        $acao[] = DB::table('acoes_naoconformidades')->where('id_naoconformidade',$naoconformidades[$j][0]->id)->get();
                    }
                    for($k = 0; $k<count($acao); $k++){
                        $acoescorretivas = [];
                        for($l = 0; $l<count($acao[$k]); $l++){
                            $acoescorretivas[] = DB::table('acoes_corretivas')->where('id',$acao[$k][$l]->id_acoescorretivas)->get();
                        }
                    }
                    $nconfatual = $naoconformidades[$i];
                    $resultado[] = array_merge(compact('nconfatual'), compact('acoescorretivas'));
                    $acao = [];
                }
                $naoConformidadesEAcoesCorretivas = $resultado;
            }else{
                $naoConformidadesEAcoesCorretivas = [];
            }
                return response()->json(compact('naoConformidadesEAcoesCorretivas'), 200);

        }else{
            return response()->json('Token Inválido!');
        }
    }
	public function listOne($id){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			// $naoconformidade = NaosConformidades::find($id);
			$naoconformidade = DB::table('naos_conformidades')->where('ativo', 1)->where('id', $id)->get();
			$acoesnc = DB::table('acoes_naoconformidades')->where('id_naoconformidade', $id)->get();
			$acoescorretivas = [];
            for($i=0; $i<count($acoesnc); $i++){
				$acoescorretivas[] = DB::table('acoes_corretivas')->where('ativo', 1)->where('id', $acoesnc[$i]->id_acoescorretivas)->get();
			}
			return response()->json(compact('naoconformidade','acoescorretivas'), 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function update($id, Request $request){
		$user = Auth::user();
		$data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
		$data_atual = date('Y-m-d H:i:s');
		if($data_atual <=  $data_ultimoacesso){
			$aut = DB::table('acoes_naoconformidades')->where('id_naoconformidade', $id)->delete();
			$naoconformidade = NaosConformidades::find($id);
			$naoconformidade->nome = $request->input('nome');
			$naoconformidade->descricao = $request->input('descricao');
			$naoconformidade->save();

			$acaocorretiva = $request->input('acaocorretivas');
			if(isset($acaocorretiva)){
				for($i=0; $i < count($acaocorretiva); $i++){
	                $dados = [
	                    'id_naoconformidade' => $naoconformidade->id,
	                    'id_acoescorretivas' => $acaocorretiva[$i]['id']
	                ];
	        		$ncacoes = AcoesNaoconformidades::create($dados);
        		}
        	}
			return response()->json(['Sucesso' => 'Nao Conformidade editado com sucesso!'], 200);
		}else{
			return response()->json('Token Inválido!');
		}
	}

	public function searchnaoconformidade(Request $request, $busca ){
		$userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
			$nomenaoconformidade = NaosConformidades::where('nome', 'like', '%'.$busca.'%')->get();

			return response()->json(['NaoConformidade' => $nomenaoconformidade]);
		}
		else{
			return response()->json('Token Inválido!');
		}
	}
}
