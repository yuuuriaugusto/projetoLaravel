<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Auditorias;
use App\Fichas;
use App\FichasTemperaturas;
use App\NaosconformidadesItens;
use App\Processos;
use App\ProcessosSetor;
use App\Setors;
use App\Itens;
use App\ItensTemperaturas;

class AuditoriasController extends Controller
{
    public function createAuditorias(Request $request, $idprocesso, $idsetor){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $usuario=Auth::user()->id;
            $dadosaudi=[
                "id_users"=>$usuario,
                "id_processos"=>$idprocesso,
                "id_setors"=>$idsetor
            ];
            $auditoria = Auditorias::create($dadosaudi);
            $itens = $request->input('itens');
            for($i=0; $i < count($itens); $i++){
                $dados = [
                    'id_auditorias' => $auditoria->id,
                    'id_itens' => $itens[$i]['id'],
                    'conforme' => $itens[$i]['con']
                ];
                $autori = Fichas::create($dados);
                if($autori->conforme == 0){
                    $naoconformidade = $itens[$i]['naoconformidades'];
                    for($j=0; $j < count($naoconformidade); $j++){
                        $dadoss = [
                            'id_fichas' => $autori->id,
                            'id_naoconformidades' => $naoconformidade[$j]['id'],
                            'id_acaocorretivaitens' => $naoconformidade[$j]['id_acaocorretivaitens'],
                            'observacoes' => $naoconformidade[$j]['observacoes'],
                            'id_funcionarios' => $naoconformidade[$j]['id_funcionarios'],
                            'prazo' => $naoconformidade[$j]['prazo'],
                            'statusC'=>0,
                            'statusNC'=>1
                        ];
                        $nconformeitens = NaosconformidadesItens::create($dadoss);
                    }
                }
            }

            return response()->json(['Sucesso' => 'Controle cadastrado com sucesso'], 201);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAllAuditorias(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){


            $fichasTemp = [];
            $fichasConf = [];
            $auditoriasDB = Auditorias::orderBy('created_at','desc')->get();
            if (count($auditoriasDB)>0) {
                for ($i=0; $i < count($auditoriasDB); $i++) {
                    $auditoriaAtual = [];
                    $auditoriaAtual['auditoria'] = $auditoriasDB[$i];
                    $fichasConfDB = [];
                    $fichasConfDB = Fichas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
                    $fichasConf = [];
                    $fichaConfs = [];
                    for ($j=0; $j < count($fichasConfDB); $j++) {
                        $fichaConf = [];
                        $fichasConfAtual = [];
                        $fichasConfAtual['ficha'] = $fichasConfDB[$j];
                        $itensDB = Itens::where('id',$fichasConfDB[$j]->id_itens)->get();
                        for ($k=0; $k < count($itensDB); $k++) {
                            $itemAtual = [];
                            $itemAtual['item'] = $itensDB[$k];
                            $processosetor = ProcessosSetor::where('id',$itensDB[$k]->processos_setor_id)->get();
                            for ($l=0; $l < count($processosetor); $l++) {
                                $processo['processo'] = Processos::where('id',$processosetor[$l]->processos_id)->get();
                            }
                            for ($l=0; $l < count($processosetor); $l++) {
                                $setor['setor'] = Setors::where('id',$processosetor[$l]->setors_id)->get();
                            }
                            $processosetores['processosetores'] = array_merge($processo,$setor);
                            $item['itens'] = array_merge($itemAtual,$processosetores);
                        }
                        $fichaConf = array_merge($fichasConfAtual,$item);
                        $fichaConfs[] = $fichaConf;
                    }
                    $fichasConf['FichaItensConf'] = $fichaConfs;
                    $fichasTempDB = [];
                    $fichasTempDB = FichasTemperaturas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
                    $fichasTemp = [];
                    $fichaTemps = [];
                    for ($j=0; $j < count($fichasTempDB); $j++) {
                        $fichaTemp = [];
                        $fichasTempAtual = [];
                        $fichasTempAtual['ficha'] = $fichasTempDB[$j];
                        $itensDB = ItensTemperaturas::where('id',$fichasTempDB[$j]->id_itens)->get();
                        for ($k=0; $k < count($itensDB); $k++) {
                            $itemAtual = [];
                            $itemAtual['item'] = $itensDB[$k];
                            $processosetor = ProcessosSetor::where('id',$itensDB[$k]->processos_setor_id)->get();
                            for ($l=0; $l < count($processosetor); $l++) {
                                $processo['processo'] = Processos::where('id',$processosetor[$l]->processos_id)->get();
                            }
                            for ($l=0; $l < count($processosetor); $l++) {
                                $setor['setor'] = Setors::where('id',$processosetor[$l]->setors_id)->get();
                            }
                            $processosetores['processosetores'] = array_merge($processo,$setor);
                            $item['itens'] = array_merge($itemAtual,$processosetores);
                        }
                        $fichaTemp = array_merge($fichasTempAtual,$item);
                        $fichaTemps[] = $fichaTemp;
                    }
                    $fichasTemp['FichaItensTemp'] = $fichaTemps;
                    $fichas['fichas'] = array_merge($fichasConf,$fichasTemp);
                    $auditorias[] = array_merge($auditoriaAtual,$fichas);
                }
            }else {
                $auditorias = [];
            }
            $resultado['auditorias'] = $auditorias;
            return($resultado);


            // $setor2 = [];
            // $auditoria = [];
            // $listagemhistorico = [];
            // $processos = DB::table('processos')->where('ativo',1)->get();
            // for($i=0; $i<count($processos); $i++){
            //     $processo["processo"] = $processos[$i];
            //     $processosetor = DB::table('processos_setors')->where('processos_id',$processos[$i]->id)->get();
            //     $setor2 = [];
            //     for ($j=0; $j < count($processosetor); $j++) {
            //         $setor = [];
            //         $setor[] = DB::table('setors')->where('id',$processosetor[$j]->setors_id)->get();
            //         for ($k=0; $k < count($setor[0]); $k++) {
            //             $todasauditorias2 = [];
            //             $fichas = [];
            //             $setoratual = [];
            //             $auditoria = DB::table('auditorias')->where('id_setors', $setor[0][$k]->id)->orderBy('created_at', 'DESC')->get();
            //             for ($l=0; $l < count($auditoria); $l++) {
            //                 $auditoria2 = [];
            //                 $todasauditorias = [];
            //                 $todasauditorias[] = $auditoria[$l];
            //                 $fichasConformidade = DB::table('fichas')->where('id_auditorias', $auditoria[$l]->id)->get();
            //                 $fichasTemperatura = DB::table('fichas_temperaturas')->where('id_auditorias', $auditoria[$l]->id)->get();
            //                 $fichas["conformidade"] = $fichasConformidade;
            //                 $fichas["temperatura"] = $fichasTemperatura;
            //                 if(count($fichas) > 0){
            //                     $auditoria2[] = array_merge($todasauditorias, compact('fichas'));
            //                 }
            //                 else{
            //                     $auditoria2[] = array_merge($todasauditorias, []);
            //                 }
            //                 $todasauditorias2[] = $auditoria2;
            //             }
            //             $auditorias["auditorias"] = $todasauditorias2;
            //             $setoratual[] = $setor[0][$k];
            //             $setor2[] = array_merge($setoratual, $auditorias);
            //         }
            //     }
            //     $setors["setor"] = $setor2;
            //     $listagemhistorico[] = array_merge($processo, $setors);
            // }
            // return response()->json(compact('listagemhistorico'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function ordenacao(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processos =DB::table('processos')->where('ativo',1)->orderBy('nome', 'ASC')->get();
            $result = [];
            for($i=0; $i<count($processos); $i++){
                $processo = [];
                $auditoria = [];
                $fichas = [];

                $processo["processo"] = $processos[$i];
                $auditoprox=  DB::table('auditorias')->where('id_processos',$processos[$i]->id)->orderBy('created_at', 'DESC')->get();
                for($j = 0; $j<count($auditoprox); $j++){
                    $auditoriaAtual = [];
                    $auditoriaAtual["auditoria"] = Auditorias::find($auditoprox[$j]->id);
                    $ficha = [];
                    $ficha = DB::table('fichas')->where('id_auditorias',$auditoprox[$j]->id)->get();
                    if(count($ficha) > 0){
                        $auditoria[] = array_merge($auditoriaAtual, compact('ficha'));
                    }else{
                        $auditoria[] = array_merge($auditoriaAtual, []);
                    }
                }


                $result[] = array_merge($processo, compact('auditoria'));
            }

            $teste = $result;

            return response()->json(compact('teste'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function historico($idaudito){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $ficha = [];
            $result = [];
            $confor = [];
            $fichas = DB::table('fichas')->where('id_auditorias',$idaudito)->get();
            for($i=0; $i<count($fichas); $i++){
                $itens = DB::table('itens')->where('id',$fichas[$i]->id_itens)->get();
                for($j=0; $j<count($itens); $j++){
                    $processosetor = DB::table('processos_setors')->where('id',$itens[$j]->processos_setor_id)->get();
                    $setor["setor"] = Setors::find($processosetor[0]->setors_id);
                    $item = [];
                    $item = Itens::find($itens[$j]->id);
                    $ficha[] = array_merge($setor, compact('item'));
                }

            }
            $outroarray = array();
            for($k=0; $k<count($ficha); $k++){
                $resultado = array();
                if($k==0){
                    $resultado[]["setor"]= $ficha[$k]["setor"];
                    $novo = array();
                    $novaficha = array();
                    for($s=0; $s<count($ficha); $s++){
                        $fichacadaitem = DB::table('fichas')->where('id_itens',$ficha[$s]["item"]["id"])->where('id_auditorias',$idaudito)->get();
                        if($ficha[$s]["setor"]["id"] == $resultado[count($resultado)-1]["setor"]["id"]){
                            $novo[] = $ficha[$s]["item"];
                            $novaficha[] = $fichacadaitem;
                        }
                    }
                    $resultado[]["item"]= $novo;
                    $resultado[]["ficha"]= $novaficha;
                    $outroarray[]=$resultado;
                }
                if($outroarray[count($outroarray)-1][0]["setor"]["id"] != $ficha[$k]["setor"]["id"] ){
                    $resultado[]["setor"] = $ficha[$k]["setor"];
                    $novo = array();
                    $novaficha = array();
                    for($s=0; $s<count($ficha); $s++){
                        $fichacadaitem = DB::table('fichas')->where('id_itens',$ficha[$s]["item"]["id"])->where('id_auditorias',$idaudito)->get();
                        if($ficha[$s]["setor"]["id"] == $resultado[count($resultado)-1]["setor"]["id"]){
                            $novo[] = $ficha[$s]["item"];
                            $novaficha[] = $fichacadaitem;
                        }
                    }
                    $resultado[]["item"]= $novo;
                    $resultado[]["ficha"]= $novaficha;
                    $outroarray[]=$resultado;
                }
            }
            return response()->json(compact('outroarray'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOneAuditoria($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){

            $fichasItens = [];
            $fichasDb= DB::table('fichas')->where('id_auditorias', $id)->where('conforme',0)->get();
            for($j = 0; $j<count($fichasDb); $j++){
                $fichaAtual = [];
                $itensFicha = [];
                $fichaAtual["ficha"] = $fichasDb[$j];
                $itensFichaDB = DB::table('itens')->where( 'id', $fichasDb[$j]->id_itens)->get();
                $itensFicha["itens"] = $itensFichaDB;
                $fichasItens[] = array_merge($fichaAtual,$itensFicha);
            }
            return response()->json(compact('fichasItens'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOneAuditoriaHistorico($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){

            $fichasItens = [];
            $fichasDb= DB::table('fichas')->where('id_auditorias', $id)->get();
            for($j = 0; $j<count($fichasDb); $j++){
                if ($fichasDb[$j]->reaudita != '0') {
                    $fichaAtual = [];
                    $itensFicha = [];
                    $fichaAtual["ficha"] = $fichasDb[$j];
                    $itensFichaDB = DB::table('itens')->where('id', $fichasDb[$j]->id_itens)->get();
                    $itensFicha["itens"] = $itensFichaDB;
                    $fichasItens[] = array_merge($fichaAtual,$itensFicha);
                }
            }
            return response()->json(compact('fichasItens'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function searchhistorico($busca){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $nomeprocesso =	Processos::where('nome', $busca)->get();
            $result = [];
            for($i=0; $i<count($nomeprocesso); $i++){
                $processo = [];
                $auditoria = [];
                $fichas = [];

                $processo["processo"] = $nomeprocesso[$i];
                $auditoprox=  DB::table('auditorias')->where('id_processos',$nomeprocesso[$i]->id)->orderBy('created_at', 'DESC')->get();
                for($j = 0; $j<count($auditoprox); $j++){
                    $auditoriaAtual = [];
                    $auditoriaAtual["auditoria"] = Auditorias::find($auditoprox[$j]->id);
                    $ficha = [];
                    $ficha = DB::table('fichas')->where('id_auditorias',$auditoprox[$j]->id)->get();
                    if(count($ficha) > 0){
                        $auditoria[] = array_merge($auditoriaAtual, compact('ficha'));
                    }else{
                        $auditoria[] = array_merge($auditoriaAtual, []);
                    }
                }
                $result[] = array_merge($processo, compact('auditoria'));
            }
            $teste = $result;
            return response()->json(compact('teste'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function searchdata($buscadata){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            return Auditorias::where('created_at', $buscadata)->get();
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listaItensParaReauditoria(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $itemNC =DB::table('naosconformidades_itens')->where('statusC', 0)->where('statusNC',1)->orderBy('prazo','asc')->get();
            if (count($itemNC) > 0) {
                for ($i=0; $i < count($itemNC); $i++) {
                    $itemNCATUAL = [];
                    $itemNCATUAL["itemNC"] = $itemNC[$i];
                    $ncItem = [];
                    if ($itemNC[$i]->id_fichas != null) {
                        $fichaItemDB = DB::table('fichas')->where('id', $itemNC[$i]->id_fichas)->get();
                        for ($j=0; $j < count($fichaItemDB); $j++) {
                            $ficha["ficha"] = $fichaItemDB[$j];
                            $item["item"] = (DB::table('itens')->where('id',$fichaItemDB[$j]->id_itens)->get())[0];
                            $auditoria["auditoria"] = (DB::table('auditorias')->where('id',$fichaItemDB[$j]->id_auditorias)->get())[0];
                            $informItem = [];
                            $informItem = array_merge($ficha, $item, $auditoria, $itemNCATUAL);
                            $ncItem["ncItem"] = $informItem;
                        }
                    }
                    if ($itemNC[$i]->id_fichastemperaturas != null) {
                        $fichaItemDB = DB::table('fichas_temperaturas')->where('id', $itemNC[$i]->id_fichastemperaturas)->get();
                        for ($j=0; $j < count($fichaItemDB); $j++) {
                            $ficha["ficha"] = $fichaItemDB[$j];
                            $item["item"] = (DB::table('itens_temperaturas')->where('id',$fichaItemDB[$j]->id_itens)->get())[0];
                            $auditoria["auditoria"] = (DB::table('auditorias')->where('id',$fichaItemDB[$j]->id_auditorias)->get())[0];
                            $informItem = [];
                            $informItem = array_merge($ficha, $item, $auditoria, $itemNCATUAL);
                            $ncItem["ncItem"] = $informItem;
                        }
                    }
                    $itensParaReauditar[] = $ncItem;
                }
            }else {
                $itensParaReauditar[] = [];
            }
            return $itensParaReauditar;
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function reauditarFichas(Request $request, $NCItemId){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $usuario=Auth::user()->id;
            $validaConf = $request->itens[0]["conforme"];
            if ($validaConf == '0') {
                // gerarar reincidência
                $validaConf = '1';
            }
            if ($validaConf == '1') {
                $dados = [
                    'reaudita' => $request->itens[0]["idficha"],
                    'id_auditorias' => $request->itens[0]["idauditoria"],
                    'id_itens' => $request->itens[0]["iditem"],
                    'conforme' => $request->itens[0]["conforme"]
                ];
                $NovaFicha = Fichas::create($dados);
                $reauditaFicha = Fichas::find($request->itens[0]["idficha"]);
                $reauditaFicha->reaudita = 0;
                $reauditaFicha->save();
                $reauditaNCItem = NaosconformidadesItens::find($request->itens[0]["idncitem"]);
                $reauditaNCItem->statusC = 1;
                $reauditaNCItem->statusNC = 0;
                $reauditaNCItem->save();
                return response()->json(['Sucesso' => 'Item reauditado com sucesso'], 201);
            }
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
}
