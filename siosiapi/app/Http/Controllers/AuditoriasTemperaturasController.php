<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Auditorias;
use App\FichasTemperaturas;
use App\Processos;
use App\Setors;
use App\ItensTemperaturas;
use App\NaosconformidadesItens;

class AuditoriasTemperaturasController extends Controller{
    public function createAuditoriasTemperaturas(Request $request, $idprocesso, $idsetor){
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
                $dadosFicha = [
                    'id_auditorias' => $auditoria->id,
                    'id_itens' => $itens[$i]['id'],
                    'conforme' => $itens[$i]['con'],
                    'temperatura_painel' => $itens[$i]['tempPainel'],
                    'temperatura_aferida' => $itens[$i]['tempAferida']

                ];
                $autori = FichasTemperaturas::create($dadosFicha);
                if($autori->conforme == 0){
                    $naoconformidade = $itens[$i]['naoconformidades'];
                    for($j=0; $j < count($naoconformidade); $j++){
                        $dadoss = [
                            'id_fichastemperaturas' => $autori->id,
                            'id_naoconformidades' => $naoconformidade[$j]['id'],
                            'id_acaocorretivaitens' => $naoconformidade[$j]['id_acaocorretivaitens'],
                            'observacoes' => $naoconformidade[$j]['observacoes'],
                            'id_funcionarios' => $naoconformidade[$j]['id_funcionarios'],
                            'id_interdicao' => $naoconformidade[$j]['id_interdicao'],
                            'prazo' => $naoconformidade[$j]['prazo'],
                            'statusC'=>0,
                            'statusNC'=>1
                        ];
                        $nconformeitens = NaosconformidadesItens::create($dadoss);
                    }
                }
            }

            return response()->json(['Sucesso' => 'Controle cadastrado com sucesso'], 201);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listAllAuditoriasTemperaturas(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processos =DB::table('processos')->where('ativo',1)->orderBy('nome', 'ASC')->get();
            $result = [];
            //pego todos os setores de cada processo
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
                    $ficha = DB::table('fichas_temperaturas')->where('id_auditorias',$auditoprox[$j]->id)->get();
                    if(count($ficha) > 0){
                        $auditoria[] = array_merge($auditoriaAtual, compact('ficha'));
                    }


                }
                if(count($auditoria) > 0){
                    $result[] = array_merge($processo, compact('auditoria'));
                }
            }
            $listagem = $result;
            return response()->json(compact('listagem'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function historicoTemperatura($idaudito){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $ficha = [];
            $result = [];
            $confor = [];
            $fichasTemperaturas = DB::table('fichas_temperaturas')->where('id_auditorias',$idaudito)->get();
            for($i=0; $i<count($fichasTemperaturas); $i++){
                $itensTemperaturas = DB::table('itens_temperaturas')->where('id',$fichasTemperaturas[$i]->id_itens)->get();
                for($j=0; $j<count($itensTemperaturas); $j++){
                    $processosetor = DB::table('processos_setors')->where('id',$itensTemperaturas[$j]->processo_setor_id)->get();
                    $setor["setor"] = Setors::find($processosetor[0]->setors_id);
                    $item = [];
                    $item["itens"] = ItensTemperaturas::find($itensTemperaturas[$j]->id);
                    $pegarFicha = DB::table('fichas_temperaturas')->where('id_itens', $itensTemperaturas[$j]->id)->get();
                    $item["fichas"] = $pegarFicha;
                    $ficha[] = array_merge($setor, compact('item'));
                }
            }
            $listagemHistorico = $ficha;
            return response()->json(compact('listagemHistorico'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOneAuditoria($id){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $fichasItens = [];
            $fichasDb= DB::table('fichas_temperaturas')->where('id_auditorias', $id)->where('conforme',0)->get();
            for($j = 0; $j<count($fichasDb); $j++){
                $fichaAtual = [];
                $itensFicha = [];
                $fichaAtual["ficha"] = $fichasDb[$j];
                $itensFichaDB = DB::table('itens_temperaturas')->where( 'id', $fichasDb[$j]->id_itens)->get();
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
            $fichasDb= DB::table('fichas_temperaturas')->where('id_auditorias', $id)->orderBy('updated_at', 'desc')->get();
            for($j = 0; $j<count($fichasDb); $j++){
                // if ($fichasDb[$j]->reaudita != '0') {
                    $fichaAtual = [];
                    $itensFicha = [];
                    $fichaAtual["ficha"] = $fichasDb[$j];
                    $itensFichaDB = DB::table('itens_temperaturas')->where( 'id', $fichasDb[$j]->id_itens)->get();
                    $itensFicha["itens"] = $itensFichaDB;
                    $fichasItens[] = array_merge($fichaAtual,$itensFicha);
                // }
            }
            return response()->json(compact('fichasItens'), 200);
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function listaItensParaReauditoriaTemperatura(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $itensNaoConforme =	NaosconformidadesItens::where('statusC', 0)->where('statusNC',1)->whereNotNull('id_fichastemperaturas')->orderBy('prazo','asc')->get();
            if (count($itensNaoConforme) > 0) {
                for ($i=0; $i < count($itensNaoConforme); $i++) {
                    $resultado = [];
                    $informItem = [];
                    $itensNaoConformeATUAL = [];
                    $itensNaoConformeATUAL["itemNC"] = $itensNaoConforme[$i];
                    $fichaItemDB[] = DB::table('fichas_temperaturas')->where('id', $itensNaoConforme[$i]->id_fichastemperaturas)->get();
                    for ($j=0; $j < count($fichaItemDB); $j++) {
                        $fichaItemATUAL = [];
                        $fichaItemATUAL["ficha"] = $fichaItemDB[$j];
                        $infoItem = [];
                        $infoItem["itens"] = DB::table('itens_temperaturas')->get();
                        $informItem["fichaItem"] = array_merge($fichaItemATUAL, $infoItem);
                    }
                    $resultado[] = array_merge($itensNaoConformeATUAL, $informItem);
                    $itensParaReauditar[] = $resultado;
                }
            }else {
                $itensParaReauditar = [];
            }
            return(compact('itensParaReauditar'));
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
    public function reauditarFichasTemperatura(Request $request, $NCItemId){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $usuario=Auth::user()->id;

            $validaConf = $request->input('validaConf');
            $temperatura_painel = $request->input('valorPainel');
            $temperatura_aferida = $request->input('valorAferid');
            if ($validaConf == '0') {
                // gerarar reincidência
                $validaConf = '1';
            }
            if ($validaConf == '1') {
                $NCItemDB = NaosconformidadesItens::where('id',$NCItemId)->get();
                for ($i=0; $i < count($NCItemDB); $i++) {
                    $FichaDB = FichasTemperaturas::where('id',$NCItemDB[$i]->id_fichastemperaturas)->get();
                    for ($j=0; $j < count($FichaDB); $j++) {
                        $dados = [
                            'reaudita' => $FichaDB[$i]["id"],
                            'id_auditorias' => $FichaDB[$i]["id_auditorias"],
                            'id_itens' => $FichaDB[$i]['id_itens'],
                            'temperatura_painel' => $temperatura_painel,
                            'temperatura_aferida' => $temperatura_aferida,
                            'conforme' => 1
                        ];
                        $NovaFicha = FichasTemperaturas::create($dados);
                        $reauditaFicha = FichasTemperaturas::find($FichaDB[$j]->id);
                        $reauditaFicha->reaudita = 0;
                        $reauditaFicha->save();
                        $reauditaNCItem = NaosconformidadesItens::find($NCItemDB[$i]->id);
                        $reauditaNCItem->statusC = 1;
                        $reauditaNCItem->statusNC = 0;
                        $reauditaNCItem->save();
                    }
                }
                return response()->json(['Sucesso' => 'Item reauditado com sucesso'], 201);
            }
        }
        else{
            return response()->json('Token Inválido!');
        }
    }
}
