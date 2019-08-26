<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

// Route::post('novaEmpresa', 'EmpresasController@createEmpresa');

//rotas usuario

Route::post('login',"UserController@login");
// Route::post('registrar',"UserController@create");

Route::group(['middleware' => 'auth:api'], function(){
    //rotas usuario
    Route::post('registrar',"UserController@create");
    Route::post('profile',"UserController@profile");
    Route::get('detalheUser/{id}',"UserController@listOneUser");
    Route::get('listar',"UserController@listar");
    Route::delete('deletar/{id}',"UserController@delete");
    Route::post('atualizar/{id}',"UserController@editUser");
    Route::get('listAuditoriasUser/{id}',"UserController@listAuditoriasUser");
    Route::get('verificaLogin',"UserController@verificaLogin");
    //rotas processo
    Route::post('/novoProcesso', 'ProcessosController@createProcesso');
    Route::delete('/deleteProcesso/{id}', 'ProcessosController@deleteProcesso');
    Route::get('/listagemProcessos', 'ProcessosController@listAllProcessos');
    Route::get('/detalheProcesso/{id}', 'ProcessosController@listOneProcesso');
    Route::post('/atualizarProcesso/{id}', 'ProcessosController@updateProcesso');
    //rotas setor
    Route::post('/novoSetor', 'SetorController@create');
    Route::delete('/deleteSetor/{id}', 'SetorController@delete');
    Route::get('/listagem', 'SetorController@listAll');
    Route::get('/detalhe/{id}', 'SetorController@listOne');
    Route::get('/listsetorporprocesso/{id}', 'SetorController@listsetorbyprocesso');
    Route::post('/atualizarSetor/{id}', 'SetorController@update');
    Route::get('/pesquisarSetor/{busca}', 'SetorController@searchsetor');
    //rotas itens
    Route::post('/novoItem/{idprocesso}/{idsetor}', 'ItensController@createItens');
    Route::delete('/deleteItem/{id}', 'ItensController@deleteItens');
    Route::get('/listagemItem', 'ItensController@listAllItens');
    Route::get('/detalheItem/{id}', 'ItensController@listOneItens');
    Route::post('/atualizarItem/{id}/{idprocesso}/{idsetor}', 'ItensController@updateItens');
    Route::get('/listaritenssetor/{idprocesso}/{idsetor}', 'ItensController@listitensbyprocessosetor');

    //rotas papel
    Route::post('/novoPapel', 'PapelsController@create');
    Route::get('/listagemPapel', 'PapelsController@listAll');
    Route::get('/detalhePapel/{id}', 'PapelsController@listOne');
    Route::delete('/deletarPapel/{id}', 'PapelsController@delete');
    Route::post('/editarPapel/{id}', 'PapelsController@edit');
  //rotas fichas
    Route::post('/novaFicha', 'FichasController@createFichas');
    Route::get('/listagemFichas', 'FichasController@listAllFichas');
    Route::get('/detalheFicha/{id}', 'FichasController@listOneFicha');
    //rotas auditoria e histórico
    Route::post('/novaAuditoria/{idprocesso}/{idsetor}', 'AuditoriasController@createAuditorias');
    Route::get('/listagemAuditorias', 'AuditoriasController@listAllAuditorias');
    Route::get('/detalheAuditoria/{id}', 'AuditoriasController@listOneAuditoria');
    Route::get('/detalheAuditoriaTemperatura/{id}', 'AuditoriasTemperaturasController@listOneAuditoria');
    Route::get('/detalheAuditoriaHistorico/{id}', 'AuditoriasController@listOneAuditoriaHistorico');
    Route::get('/detalheAuditoriaHistoricoTemperatura/{id}', 'AuditoriasTemperaturasController@listOneAuditoriaHistorico');
    Route::post('/reauditarFicha/{processoid}','AuditoriasController@reauditarFichas');
    Route::get('/listaItensParaReauditoria','AuditoriasController@listaItensParaReauditoria');
    Route::get('/listaItensParaReauditoriaTemperatura','AuditoriasTemperaturasController@listaItensParaReauditoriaTemperatura');
    Route::get('/historico/{idaudito}','AuditoriasController@historico');
    Route::get('/searchprocesso/{busca}','AuditoriasController@searchhistorico');
    Route::get('/ordenar','AuditoriasController@ordenacao');
    Route::get('/searchdata/{buscadata}','AuditoriasController@searchdata');

    //rotas buscas de autorização
    Route::get('/buscaPapel/{id}', 'AutorizacaosController@listagemPermissaoPapel');
    Route::get('/buscaSetor/{id}', 'AutorizacaosController@listagemPermissaoSetor');

    //rotas permissoes
    Route::post('/novaPermissao', 'PermissaoController@create');
    Route::post('/editarPermissao/{id}', 'PermissaoController@update');
    Route::get('/listagemPermissoes', 'PermissaoController@listAll');
    Route::get('/detalhePermissao/{id}', 'PermissaoController@listOne');

    //rotas não conformidades
    Route::post('/novaNaoConformidade', 'NaoconformidadesController@create');
    Route::post('/editarNaoconformidade/{id}', 'NaoconformidadesController@update');
    Route::get('/listagemNaoconformidade', 'NaoconformidadesController@listAll');
    Route::get('/detalheNaoconformidade/{id}', 'NaoconformidadesController@listOne');
    Route::get('/ncitens/{iditem}', 'NaoconformidadesController@listnaocorretivasitem');
    Route::get('/ncitenstemp/{iditem}', 'NaoconformidadesController@listnaocorretivasitemtemp');
    Route::delete('/deletarNaoConformidade/{id}', 'NaoconformidadesController@delete');
    Route::get('/pesquisarNC/{busca}', 'NaoconformidadesController@searchnaoconformidade');
    //rotas acao corretiva
    Route::post('/novaAcaoCorretiva', 'AcaoCorretivaController@createAcaoCorretiva');
    Route::post('/editarAcaoCorretiva/{id}', 'AcaoCorretivaController@update');
    Route::get('/listagemAcaoCorretiva', 'AcaoCorretivaController@listAllAcaoCorretiva');
    Route::get('/detalheAcaoCorretiva/{id}', 'AcaoCorretivaController@listAcaoCorretiva');
    Route::delete('/deletarAcaoCorretiva/{id}', 'AcaoCorretivaController@deleteAC');
    Route::get('/pesquisarAcaoCorretiva/{busca}', 'AcaoCorretivaController@searchacaocorretiva');
    //rotas funcionario
    Route::post('/novaFuncionario', 'FuncionariosController@createFuncionario');
    Route::post('/editarFuncionario/{id}', 'FuncionariosController@updateFuncionario');
    Route::get('/listagemFuncionario', 'FuncionariosController@listAllFuncionario');
    Route::get('/detalheFuncionario/{id}', 'FuncionariosController@listFuncionario');
    Route::delete('/deletarFuncionario/{id}', 'FuncionariosController@deleteFuncionario');
    // Rotas Itens Temperaturas
    Route::post('/novoItemTemperatura/{idprocesso}/{idsetor}', 'ItensTemperaturasController@createItensTemperaturas');
    Route::delete('/deleteItemTemperatura/{id}', 'ItensTemperaturasController@deleteItensTemperaturas');
    Route::post('/atualizarItemTemperatura/{id}/{idprocesso}/{idsetor}', 'ItensTemperaturasController@updateItensTemperaturas');
    Route::get('/listagemItemTemperatura', 'ItensTemperaturasController@listAllItensTemperaturas');
    Route::get('/detalheItemTemperatura/{id}', 'ItensTemperaturasController@listOneItensTemperaturas');
    // Rotas Auditorias com Temperatura
    Route::post('/novaAuditoriaTemperatura/{idprocesso}/{idsetor}', 'AuditoriasTemperaturasController@createAuditoriasTemperaturas');
    Route::get('/listagemAuditoriasTemperaturas', 'AuditoriasTemperaturasController@listAllAuditoriasTemperaturas');
    Route::get('/historicoTemperatura/{idaudito}','AuditoriasTemperaturasController@historicoTemperatura');
    Route::post('/reauditarFichasTemperatura/{processoid}','AuditoriasTemperaturasController@reauditarFichasTemperatura');
    // Rotas Empresas
    Route::post('/novaEmpresa', 'EmpresasController@createEmpresa');
    Route::delete('/deletarEmpresa/{id}', 'EmpresasController@delete');
    Route::get('/listagemEmpresas', 'EmpresasController@listAll');
    Route::get('/detalheEmpresa/{id}', 'EmpresasController@listOne');
    Route::post('/editarEmpresa/{id}', 'EmpresasController@update');
    Route::get('/listagemEstados', 'EmpresasController@listEstados');
    Route::get('/listagemCidades/{id}', 'EmpresasController@listCidades');
  });
