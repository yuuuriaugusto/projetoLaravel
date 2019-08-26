<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Papels;
use App\Autorizacaos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Setors;
use Laravel\Passport\PersonalAccessTokenResult;


class PapelsController extends Controller
{
    public function create(Request $request){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            //cria o papel
            $data = $request->all();
            $papel = Papels::create($data);
            $papel->ativo = 1;
            $papel->save();

            //cria uma autorização para o papel recém criado em cada setor que foi passado como parametro
            $setores = $request->input('setores');
            if ($setores > 0) {
                for($i=0; $i < count($setores); $i++){
                    $dados = [
                        'id_papels' => $papel->id,
                        'id_setors' => $setores[$i]
                    ];
                    $autori = Autorizacaos::create($dados);
                }
            }
            return response()->json(['Sucesso' => 'Papel criado com sucesso'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listAll(Request $request){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $papeisDB = DB::table('papels')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($papeisDB); $i++) {
                $papelAtual = [];
                $papelAtual["papel"] = $papeisDB[$i];

                $papeis[] = $papelAtual;
            }
            return compact('papeis');

        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listOne($id){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $papel = Papels::find($id);
            $autorizacaos = DB::table('autorizacaos')->where('id_papels', $id)->get();
            $setores = [];
            for($i=0; $i<count($autorizacaos); $i++){
                $setores[] = Setors::find($autorizacaos[$i]->id_setors);
            }
            return response()->json(compact('papel', 'setores'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    //deletar (inativar) o papel
    public function delete($id){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $papel = Papels::find($id);
            $papel->ativo = 0;
            $papel->save();
            return response()->json(['Sucesso' => 'Papel deletado com sucesso!'], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }


    //editar o papel
    public function edit(Request $request, $id){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            //deletar os que já existem na tabela de autorização
            $aut = DB::table('autorizacaos')->where('id_papels', $id)->delete();

            //alterar o nome do papel
            $papel = Papels::find($id);
            $papel->nome = $request->input('nome');
            $papel->save();

            //inserir novamente os dados na tabela de autorização
            $setores = $request->input('setores');
            for($i=0; $i < count($setores); $i++){
                $dados = [
                    'id_papels' => $papel->id,
                    'id_setors' => $setores[$i]
                ];
                $autori[] = Autorizacaos::create($dados);

            }
            $papeis = DB::table('papels_users')->where('id_users', $userr->id)->get();
            $setoresListar = [];
            for($i=0; $i<count($papeis); $i++){
                $setor = DB::table('autorizacaos')->where('id_papels', $papeis[$i]->id_papels)->get();
                for($j=0; $j<count($setor); $j++){
                    $set = Setors::find($setor[$j]->id_setors);
                    $setoresListar[] = $set;
                }
            }
            // $setoresListar = [];
            // for($i=0; $i < count($autori); $i++){
            //     $setoresListar = Setors::find($autori[$i]->id_papels);
            // }

            return response()->json(['setores' => $setoresListar]);
        }else{
            return response()->json('Token Inválido!');
        }

    }

}
