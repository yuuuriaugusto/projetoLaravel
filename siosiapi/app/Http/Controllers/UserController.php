<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Papels;
use App\PapelsUsers;
use App\Permissoes;
use App\PermissoesUsers;
use App\Auditorias;
use App\Fichas;
use App\FichasTemperaturas;
use App\Itens;
use App\ItensTemperaturas;
use App\ProcessosSetor;
use App\Processos;
use App\Setors;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\PersonalAccessTokenResult;

class UserController extends Controller
{
    public function create(Request $request){
        $users = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $users->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $user = $request->all();
            $user['password'] = bcrypt($user['password']);
            $usuario = User::create($user);
            $usuario->ativo = 1;
            $usuario->save();
            $papels = $request->input('papels');
            if(isset($papels)){
                for($i=0; $i < count($papels); $i++){
                    $dadospapels = [
                        'id_users' => $usuario->id,
                        'id_papels' => $papels[$i]
                    ];
                    $papel = PapelsUsers::create($dadospapels);
                }
                $permissoes = $request->input('permissoes');
            }
            if(isset($permissoes)){
                for($i=0; $i < count($permissoes); $i++){
                    $dadospermissoes = [
                        'id_users' => $usuario->id,
                        'id_permissoes' => $permissoes[$i]
                    ];
                    $permissao= PermissoesUsers::create($dadospermissoes);
                }

            }

            $token = $usuario->createToken('MyApp')->accessToken;
            return response()->json(['user' => $usuario, 'token' => $token]);
            return response()->json('Usuário Cadastrado!');
        }
        else{
            return response()->json('Token Inválido!');
        }
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            $user->ultimoacesso=date('Y-m-d H:i:s');
            $user->save();
            $idUser = User::find($user->id);
            $papeis = DB::table('papels_users')->where('id_users', $user->id)->get();
            $papel = [];
            $setores = [];
            for($i=0; $i<count($papeis); $i++){
                $setor = DB::table('autorizacaos')->where('id_papels', $papeis[$i]->id_papels)->get();
                $papel[] = DB::table('papels')->where('id', $papeis[$i]->id_papels)->get();

                for($j=0; $j<count($setor); $j++){
                    $set = Setors::find($setor[$j]->id_setors);
                    $setores[] = $set;
                }
            }

            $permissao = DB::table('permissoes_users')->where('id_users', $user->id)->get();
            $permissoes = [];
            for($i=0; $i<count($permissao); $i++){
                $per = Permissoes::find($permissao[$i]->id_permissoes);
                $permissoes[] = $per;
            }

            return response()->json(['token' => $token, 'id_user' => $idUser,'user' => $user, 'setores' => $setores, 'permissoes' => $permissoes, 'papeis' => $papel], 200);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function profile(){
        $user = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $user->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            return response()->json(compact('user'),200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listOneUser($id){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $usuario = User::find($id);
            $papeis = DB::table('papels_users')->where('id_users', $id)->get();
            $permissoes = DB::table('permissoes_users')->where('id_users', $id)->get();
            $papels = [];
            $permissoels = [];
            for($i=0; $i<count($papeis); $i++){
                $papels[] = Papels::find($papeis[$i]->id_papels);
            }
            for($j=0; $j<count($permissoes); $j++){
                $permissoels[] = Permissoes::find($permissoes[$j]->id_permissoes);
            }
            return response()->json(compact('usuario', 'papels','permissoels'), 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function listar(){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $user = [];
            $usuario = DB::table('users')->where('ativo', 1)->orderBy('created_at', 'DESC')->get();
            for($i=0; $i<count($usuario); $i++){
                $papeis = DB::table('papels_users')->where('id_users', $usuario[$i]->id)->get();


                $permissao = DB::table('permissoes_users')->where('id_users', $usuario[$i]->id)->get();
                $permissoes = [];
                for($j=0; $j<count($permissao); $j++){
                    $per = Permissoes::find($permissao[$j]->id_permissoes);
                    $permissoes[] = $per;
                }

                $user[] = ['usuario' => $usuario[$i], 'permissoes' => $permissoes, 'papeis' => $papeis];
            }
            return response()->json(compact('user'),200);
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function delete($id){
        $user = User::find($id);
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $user->ativo=0;
            $user->save();
            return response()->json('Usuário Deletado!');
        }else{
            return response()->json('Token Inválido!');
        }
    }

    public function editUser(Request $request, $id){
        $user = User::find($id);
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            if (isset($request['password'])) {
                $newUser = [
                    'nome' => $request['nome'],
                    'telefone' => $request['telefone'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password'])
                ];
            }else {
                $newUser = [
                    'nome' => $request['nome'],
                    'telefone' => $request['telefone'],
                    'email' => $request['email']
                ];
            }
            $user->update($newUser);
            $papelsedit= DB::table('papels_users')->where('id_users', $id)->delete();
            $permissoessedit= DB::table('permissoes_users')->where('id_users', $id)->delete();
            $papels = $request->input('papels');
            $papelListar = [];
            if (isset($papels)) {
                for($i=0; $i < count($papels); $i++){
                    $dadospapels = [
                        'id_users' => $user->id,
                        'id_papels' => $papels[$i]
                    ];
                    $papel = PapelsUsers::create($dadospapels);
                }
            }
            $permissoes = $request->input('permissoes');
            if (isset($permissoes)) {
                for($i=0; $i < count($permissoes); $i++){
                    $dadospermissoes = [
                        'id_users' => $user->id,
                        'id_permissoes' => $permissoes[$i]
                    ];
                    $permissao= PermissoesUsers::create($dadospermissoes);
                }
            }
            $permissao = DB::table('permissoes_users')->where('id_users', $user->id)->get();
            $permissaoListar = [];
            $setores = [];
            $papelListar = [];
            for($i=0; $i<count($permissao); $i++){
                $per = Permissoes::find($permissao[$i]->id_permissoes);
                $permissaoListar[] = $per;
            }
            $papeis = DB::table('papels_users')->where('id_users', $user->id)->get();
            for($i=0; $i<count($papeis); $i++){
                $setor = DB::table('autorizacaos')->where('id_papels', $papeis[$i]->id_papels)->get();
                $papelListar = DB::table('papels')->where('id', $papeis[$i]->id_papels)->get();

                for($j=0; $j<count($setor); $j++){
                    $set = Setors::find($setor[$j]->id_setors);
                    $setores[] = $set;
                }
            }

            return response()->json(['papeis' => $papelListar, 'permissoes' => $permissaoListar, 'setores' => $setores], 200);
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function listAuditoriasUser($id){
        $user = User::find($id);
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            $fichasTemp = [];
            $fichasConf = [];
            $auditoriasDB = Auditorias::where('id_users',$id)->orderBy('created_at','desc')->get();
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
        }else{
            return response()->json('Token Inválido!');
        }
    }
    public function verificaLogin(){
        $userr = Auth::user();
        $data_ultimoacesso = date('Y-m-d H:i:s', strtotime( $userr->ultimoacesso . ' +12 hour'));
        $data_atual = date('Y-m-d H:i:s');
        if($data_atual <=  $data_ultimoacesso){
            return '1';
        }else{
            return '0';
        }
    }
}
