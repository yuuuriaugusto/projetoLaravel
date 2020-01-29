<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Auditorias;
use App\Fichas;
use App\FichasTemperaturas;
use App\NaosConformidades;
use App\AcoesCorretivas;
use App\NaosconformidadesItens;
use App\Funcionarios;
use App\Processos;
use App\ProcessosSetor;
use App\Setors;
use App\Itens;
use App\ItensTemperaturas;

class RelatoriosController extends Controller
{
    public function filtraDadosPDF(Request $request){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){

            $idprocesso = $request["processo"];
            $idtipo = $request["tipo"];
            $idtempo = $request["data"];

            $dataIni = date('Y-m-d H:i:s');
            $dataFim = date('Y-m-d H:i:s');
            if ($idtempo == "dia") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 day'));}
            if ($idtempo == "hora") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 hour'));}
            if ($idtempo == "semana") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 week'));}
            if ($idtempo == "mes") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 month'));}
            if ($idtempo == "ano") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 year'));}

            $permissao = 0;

            if ($idtipo == "conf") {
                $auditoriasDB = Auditorias::where('id_processos', $idprocesso)->whereBetween('created_at', [$dataIni, $dataFim])->orderBy('created_at','desc')->get();
                for ($i=0; $i < count($auditoriasDB); $i++) {
                    $fichasDB = Fichas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
                    for ($j=0; $j < count($fichasDB); $j++) {
                        $permissao = 1;
                    };
                };
            };
            if ($idtipo == "temp") {
                $auditoriasDB = Auditorias::where('id_processos', $idprocesso)->whereBetween('created_at', [$dataIni, $dataFim])->orderBy('created_at','desc')->get();
                for ($i=0; $i < count($auditoriasDB); $i++) {
                    $fichasDB = FichasTemperaturas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
                    for ($j=0; $j < count($fichasDB); $j++) {
                        $permissao = 1;
                    };
                };
            };


            if($permissao == 1){
                $auditoriasDB = Auditorias::where('id_processos', $idprocesso)->whereBetween('created_at', [$dataIni, $dataFim])->orderBy('created_at','desc')->get();
                if (count($auditoriasDB)) {
                    $processoDB = Processos::where('id', $auditoriasDB[0]->id_processos)->get();
                    if (count($processoDB)) {
                        $processo = $processoDB[0];
                        $auditorias = [];
                        for ($i=0; $i < count($auditoriasDB); $i++) {
                            $auditoriasAtual["auditoria"] = $auditoriasDB[$i];
                            $usuarioDB = User::where('id', $auditoriasDB[$i]->id_users)->get();
                            $usuario = $usuarioDB[0];
                            $setorDB = Setors::where('id', $auditoriasDB[$i]->id_setors)->get();
                            $setor = $setorDB[0];
                            if($idtipo == "conf"){
                                $fichasDB = Fichas::where('id_auditorias', $auditoriasDB[$i]->id)->get();
                                $fichas = [];
                                for ($j=0; $j < count($fichasDB); $j++) {
                                    $fichaAtual["ficha"] = $fichasDB[$j];
                                    $itensDB["item"] = Itens::where('id', $fichasDB[$j]->id_itens)->where('ativo', '1')->get();
                                    $ncitensDB = NaosconformidadesItens::where('id_fichas', $fichasDB[$j]->id)->get();
                                    $ncitem = [];
                                    for ($k=0; $k < count($ncitensDB); $k++) {
                                        $ncitemAtual["ncitem"] = $ncitensDB[$k];
                                        $funcionarioDB = Funcionarios::where('id', $ncitensDB[$k]->id_funcionarios)->get();
                                        $funcionario["funcionario"] = $funcionarioDB[0];
                                        $naoConformidadeDB = NaosConformidades::where('id', $ncitensDB[$k]->id_naoconformidades)->get();
                                        if (count($naoConformidadeDB) > 0) {
                                            $naoConformidade["naoConformidade"] = $naoConformidadeDB[0];
                                            $acaoCorretivaDB = AcoesCorretivas::where('id', $ncitensDB[$k]->id_acaocorretivaitens)->get();
                                            if (count($acaoCorretivaDB) > 0) {
                                                $acaoCorretiva["acaoCorretiva"] = $acaoCorretivaDB[0];
                                            }else {
                                                $acaoCorretiva["acaoCorretiva"] = [];
                                            };
                                        }else {
                                            $naoConformidade["naoConformidade"] = [];
                                            $acaoCorretiva["acaoCorretiva"] = [];
                                        };
                                        $ncitem[] = array_merge($ncitemAtual, $funcionario, $naoConformidade, $acaoCorretiva);
                                    };
                                    $fichas[] = array_merge($fichaAtual,$itensDB,compact('ncitem'));
                                };
                                if(count($fichas) > 0){
                                    $auditorias[] = array_merge($auditoriasAtual, compact('usuario'), compact('setor'), compact('fichas'));
                                };
                            };
                            if($idtipo == "temp"){
                                $fichasDB = FichasTemperaturas::where('id_auditorias', $auditoriasDB[$i]->id)->get();
                                $fichas = [];
                                for ($j=0; $j < count($fichasDB); $j++) {
                                    $fichaAtual["ficha"] = $fichasDB[$j];
                                    $itensDB["item"] = ItensTemperaturas::where('id', $fichasDB[$j]->id_itens)->where('ativo', '1')->get();
                                    $ncitensDB = NaosconformidadesItens::where('id_fichastemperaturas', $fichasDB[$j]->id)->get();
                                    $ncitem = [];
                                    for ($k=0; $k < count($ncitensDB); $k++) {
                                        $ncitemAtual["ncitem"] = $ncitensDB[$k];
                                        $funcionarioDB = Funcionarios::where('id', $ncitensDB[$k]->id_funcionarios)->get();
                                        $funcionario["funcionario"] = $funcionarioDB[0];
                                        $naoConformidadeDB = NaosConformidades::where('id', $ncitensDB[$k]->id_naoconformidades)->get();
                                        if (count($naoConformidadeDB) > 0) {
                                            $naoConformidade["naoConformidade"] = $naoConformidadeDB[0];
                                            $acaoCorretivaDB = AcoesCorretivas::where('id', $ncitensDB[$k]->id_acaocorretivaitens)->get();
                                            if (count($acaoCorretivaDB) > 0) {
                                                $acaoCorretiva["acaoCorretiva"] = $acaoCorretivaDB[0];
                                            }else {
                                                $acaoCorretiva["acaoCorretiva"] = [];
                                            };
                                        }else {
                                            $naoConformidade["naoConformidade"] = [];
                                            $acaoCorretiva["acaoCorretiva"] = [];
                                        };
                                        $ncitem[] = array_merge($ncitemAtual, $funcionario, $naoConformidade, $acaoCorretiva);
                                    };
                                    $fichas[] = array_merge($fichaAtual,$itensDB,compact('ncitem'));
                                };
                                if(count($fichas) > 0){
                                    $auditorias[] = array_merge($auditoriasAtual, compact('usuario'), compact('setor'), compact('fichas'));
                                };
                            };
                        };
                    }else {
                        $processo = [];
                    };
                }else {
                    $processo = [];
                    $auditorias = [];
                };
                return response()->json(array_merge(compact('processo'),compact('auditorias')));
            }else{
                return response()->json([]);
            };


            

        }else{
            return response()->json('Token Inválido!');
        };
    }
    // public function filtraDadosPDF(Request $request){
    //     $user = Auth::user();
    //     $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
    //     $data_atual = date('Y-m-d H:i:s');
    //     if($data_atual <=  $data_ultimoacesso){
    //
    //         $dataIni = date('Y-m-d H:i:s');
    //         $dataFim = date('Y-m-d H:i:s');
    //
    //         $idprocesso = $request["processo"];
    //         $idtipo = $request["tipo"];
    //         $idtempo = $request["data"];
    //         $iddata1 = $request["data1"];
    //         $iddata2 = $request["data2"];
    //
    //         if ($idtempo) {
    //             if ($idtempo == "hora") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 hour'));}
    //             if ($idtempo == "dia") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 day'));}
    //             if ($idtempo == "semana") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 week'));}
    //             if ($idtempo == "mes") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 month'));}
    //             if ($idtempo == "ano") {$dataIni = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s') . ' -1 year'));}
    //
    //         }else {
    //             if ($iddata1 && $iddata2) {
    //                 $dataIni = $iddata1;
    //                 $dataFim = $iddata2;
    //             }
    //         }
    //
    //
    //         $auditoriasDB = Auditorias::where('id_processos',$idprocesso)->whereBetween('created_at', [$dataIni, $dataFim])->orderBy('created_at','desc')->get();
    //
    //         $fichasTemp = [];
    //         $fichasConf = [];
    //         $auditorias = [];
    //         if (count($auditoriasDB)>0) {
    //
    //
    //             for ($i=0; $i < count($auditoriasDB); $i++) {
    //                 $varPermissao = 0;
    //                 $auditoriaAtual = [];
    //                 $auditoriaAtual['auditoria'] = $auditoriasDB[$i];
    //                 if ($idtipo == "temp") {
    //                     $fichasTempDB = FichasTemperaturas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
    //                     for ($j=0; $j < count($fichasTempDB); $j++) {
    //                         $itensDB = ItensTemperaturas::where('id',$fichasTempDB[$j]->id_itens)->get();
    //                         if (count($itensDB)>0) {
    //                             $varPermissao = 1;
    //                         }
    //                     }
    //                 }
    //                 if ($idtipo == "conf") {
    //                     $fichasConfDB = Fichas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
    //                     for ($j=0; $j < count($fichasConfDB); $j++) {
    //                         $itensDB = Itens::where('id',$fichasConfDB[$j]->id_itens)->get();
    //                         if (count($itensDB)>0) {
    //                             $varPermissao = 1;
    //                         }
    //                     }
    //                 }
    //                 if ($varPermissao == 1) {
    //                     if ($idtipo == "conf") {
    //                         $fichasConfDB = [];
    //                         $fichasConfDB = Fichas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
    //                         $fichasConf = [];
    //                         $fichaConfs = [];
    //                         for ($j=0; $j < count($fichasConfDB); $j++) {
    //                             $fichaConf = [];
    //                             $fichasConfAtual = [];
    //                             $fichasConfAtual['ficha'] = $fichasConfDB[$j];
    //                             $itensDB = Itens::where('id',$fichasConfDB[$j]->id_itens)->get();
    //                             if (count($itensDB)>0) {
    //                                 for ($k=0; $k < count($itensDB); $k++) {
    //                                     $itemAtual = [];
    //                                     $itemAtual['item'] = $itensDB[$k];
    //                                     $processosetor = ProcessosSetor::where('id',$itensDB[$k]->processos_setor_id)->get();
    //                                     for ($l=0; $l < count($processosetor); $l++) {
    //                                         $processo['processo'] = Processos::where('id',$processosetor[$l]->processos_id)->get();
    //                                     }
    //                                     for ($l=0; $l < count($processosetor); $l++) {
    //                                         $setor['setor'] = Setors::where('id',$processosetor[$l]->setors_id)->get();
    //                                     }
    //                                     $processosetores['processosetores'] = array_merge($processo,$setor);
    //                                     $item['itens'] = array_merge($itemAtual,$processosetores);
    //                                 }
    //                                 $fichaConf = array_merge($fichasConfAtual,$item);
    //                                 $fichaConfs[] = $fichaConf;
    //                             }
    //                         }
    //                         $fichasConf['FichaItensConf'] = $fichaConfs;
    //                         $fichas['fichas'] = $fichasConf;
    //                     }
    //                     if ($idtipo == "temp") {
    //                         $fichasTempDB = [];
    //                         $fichasTempDB = FichasTemperaturas::where('id_auditorias',$auditoriasDB[$i]->id)->get();
    //                         $fichasTemp = [];
    //                         $fichaTemps = [];
    //                         for ($j=0; $j < count($fichasTempDB); $j++) {
    //                             $fichaTemp = [];
    //                             $fichasTempAtual = [];
    //                             $fichasTempAtual['ficha'] = $fichasTempDB[$j];
    //                             $itensDB = ItensTemperaturas::where('id',$fichasTempDB[$j]->id_itens)->get();
    //                             if (count($itensDB)>0) {
    //                                 for ($k=0; $k < count($itensDB); $k++) {
    //                                     $itemAtual = [];
    //                                     $itemAtual['item'] = $itensDB[$k];
    //                                     $processosetor = ProcessosSetor::where('id',$itensDB[$k]->processo_setor_id)->get();
    //                                     $processo = [];
    //                                     $setor = [];
    //                                     for ($l=0; $l < count($processosetor); $l++) {
    //                                         $processo['processo'] = Processos::where('id',$processosetor[$l]->processos_id)->get();
    //                                         $setor['setor'] = Setors::where('id',$processosetor[$l]->setors_id)->get();
    //                                     }
    //                                     $processosetores['processosetores'] = array_merge($processo,$setor);
    //                                     $item['itens'] = array_merge($itemAtual,$processosetores);
    //                                 }
    //                                 $fichaTemp = array_merge($fichasTempAtual,$item);
    //                                 $fichaTemps[] = $fichaTemp;
    //                             }
    //                         }
    //                         $fichasTemp['FichaItensTemp'] = $fichaTemps;
    //                         $fichas['fichas'] = $fichasTemp;
    //                     }
    //                     if (count($fichas) > 0) {
    //                         $auditorias[] = array_merge($auditoriaAtual,$fichas);
    //                     }
    //                 }
    //             }
    //         }else {
    //             $auditorias = [];
    //         }
    //         $resultado['resultado'] = $auditorias;
    //         return($resultado);
    //     }
    //     else{
    //         return response()->json('Token Inválido!');
    //     }
    // }
    public function listaSelectProcessos(Request $request){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $processosDB = DB::table('processos')->where('ativo', 1)->orderBy('nome', 'ASC')->get();
            for ($i=0; $i < count($processosDB); $i++) {
                $processoAtual = [];
                $processoAtual["processo"] = $processosDB[$i];

                $processos[] = $processoAtual;
            }
            return compact('processos');

        }else{
            return response()->json('Token Inválido!');
        }
    }
}
