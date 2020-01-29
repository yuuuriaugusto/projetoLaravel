<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemProcessos() {
    $("#listaProcessos").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    dadosListagem = [];
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemProcessos',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.listagem != undefined){
                // dadosListagem = data.listagem;
                for(i in data.listagem){
                    data.listagem[i].processo.produtor ? '' : dadosListagem.push(data.listagem[i]) ;
                };
            }else{
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemProcessos();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listProcessos = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listProcessos += `
            <div class="item-lista accordion p`+ dados[i].processo.id + `">
            <div class="bloco">
            <a class="a" onclick="abreAcordeon('p`+ dados[i].processo.id + `')">
            <div class="subbloco">
            <div class="icone"><i class="dropdown icon"></i></div>
            <div class="nome"><span data-nomeProcesso="`+dados[i].processo.nome+dados[i].processo.id+`" class="paddingSides">`+ dados[i].processo.nome + `</span></div>
            <div class="doc"><i class="paddingSides"><span data-documentoProcesso="`+dados[i].processo.documento+dados[i].processo.id+`"> `+ dados[i].processo.documento + `</span> </i></div>
            </div>
            </a>
            <div class="buttonItem">
            <a id="editaProcesso" class="edita" data-id="`+dados[i].processo.id+`"><i class="icon edit"></i></a>
            <a id="deletaProcesso" class="del" data-id="`+dados[i].processo.id+`"><i class="icon trash alternate"></i></a>
            </div>
            </div>
            <div class="subItem">
            <div class="botaoNovo"><a id="novoSetor" data-idprocesso="`+ dados[i].processo.id + `">
            <i class="plus square outline icon"></i>Novo Setor
            </a></div>
            <div class="listasetores`+ dados[i].processo.id + `">
            `;
            if (dados[i].setores.length > 0) {
                for (var j = 0; j < dados[i].setores.length; j++) {
                    listProcessos += `
                    <div class="listaItens accordion s`+ dados[i].setores[j].setor.id + `">
                    <div class="block">
                    <a class="line" onclick="abreAcordeon('s`+ dados[i].setores[j].setor.id + `')">
                    <div class="table">
                    <div class="icone"><i class="dropdown icon"></i></div>
                    <div class="nome"><span data-nomesetor="`+dados[i].setores[j].setor.nome+dados[i].setores[j].setor.id+`">`+dados[i].setores[j].setor.nome+`</span></div>
                    </div>
                    </a>
                    <div class="buttonItem">
                    <a id="editaSetor" class="edita" data-id="`+ dados[i].setores[j].setor.id + `"><i class="icon edit"></i></a>
                    <a id="deletaSetor" class="del" data-id="`+ dados[i].setores[j].setor.id + `"><i class="icon trash alternate"></i></a>
                    </div>
                    </div>
                    <div class="threeItem">
                    <div class="botaoNovo"><a id="novoItem" data-idprocesso="`+ dados[i].processo.id + `" data-idsetor="` + dados[i].setores[j].setor.id + `">
                    <i class="plus square outline icon"></i>Novo Item
                    </a></div>
                    <div class="listagem">
                    <div class="item">
                    <div class="topo">
                    <div class="listItem"><span>Nome</span></div>
                    <div class="buttonItem"><span>Editar</span></div>
                    <div class="buttonItem"><span>Excluir</span></div>
                    </div>
                    </div>
                    <div class="listaitens`+dados[i].setores[j].setor.id+`">
                    `;
                    if ((dados[i].setores[j].item.conformidade.length > 0) || (dados[i].setores[j].item.temperatura.length > 0)) {
                        for (var k = 0; k < dados[i].setores[j].item.conformidade.length; k++) {
                            listProcessos +=`
                            <div class="item" data-id="`+dados[i].setores[j].item.conformidade[k].id+`">
                            <div class="lista">
                            <div class="listItem">
                            <span data-nomeitem="`+dados[i].setores[j].item.conformidade[k].nome+dados[i].setores[j].item.conformidade[k].id+`">`+dados[i].setores[j].item.conformidade[k].nome+`</span>
                            </div>
                            <div class="buttonItem">
                            <a id="editaItemConf" class="edita" data-idprocesso="`+ dados[i].processo.id + `" data-idsetor="` + dados[i].setores[j].setor.id + `" data-iditem="`+ dados[i].setores[j].item.conformidade[k].id + `"><i class="icon edit"></i></a>
                            </div>
                            <div class="buttonItem">
                            <a class="del delConf" data-id="`+ dados[i].setores[j].item.conformidade[k].id + `"><i class="icon trash alternate"></i></a>
                            </div>
                            </div>
                            </div>
                            `;
                        }
                        for (var k = 0; k < dados[i].setores[j].item.temperatura.length; k++) {
                            listProcessos +=`
                            <div class="item" data-id="`+dados[i].setores[j].item.temperatura[k].id+`">
                            <div class="lista">
                            <div class="listItem">
                            <span data-nomeitem="`+dados[i].setores[j].item.temperatura[k].nome+dados[i].setores[j].item.temperatura[k].id+`">`+ dados[i].setores[j].item.temperatura[k].nome + `</span>
                            </div>
                            <div class="buttonItem">
                            <a id="editaItemTemp" class="edita" data-idprocesso="`+ dados[i].processo.id + `" data-idsetor="` + dados[i].setores[j].setor.id + `" data-iditem="`+ dados[i].setores[j].item.temperatura[k].id + `"><i class="icon edit"></i></a>
                            </div>
                            <div class="buttonItem">
                            <a class="del delTemp" data-id="`+ dados[i].setores[j].item.temperatura[k].id + `"><i class="icon trash alternate"></i></a>
                            </div>
                            </div>
                            </div>
                            `;
                        }
                    }else{
                        listProcessos +=`
                        <div class="item">
                        <div class="lista">
                        <div class="listItem">
                        <span>Sem Itens Cadastrados</span>
                        </div>
                        </div>
                        </div>
                        `;
                    }
                    listProcessos += `
                    </div>
                    </div>
                    </div>
                    </div>
                    `;
                }
            }else{
                listProcessos += `
                <div class="listaItens">
                <div class="block">
                <a class="line">
                <div class="table">
                <div class="nome">
                <span>Sem Setores Cadastrados</span>
                </div>
                </div>
                </a>
                </div>
                </div>
                `;
            }
            listProcessos += `
            </div>
            </div>
            </div>
            `;
        }
    }else {
        listProcessos = `
        <div class="item-lista">
        <div class="bloco">
        <a class="a">
        <div class="subbloco">
        <div class="nome">
        <span class="paddingSides">Sem Processos Cadastrados</span>
        </div>
        </div>
        </a>
        </div>
        </div>
        `;
    }
    $("#listaProcessos").html(listProcessos);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Todos os Controles</div>
<div class="botaoNovo"><a id="novoProcesso">
    <i class="plus square outline icon"></i>Novo Processo
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemProcessos();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem processos*/ ?>
<div class="listagem-collapse">
    <span class="subtitulo">Processos</span>
    <div class="bloco-lista" id="listaProcessos"></div>
</div>
<? /*fim listagem processos*/ ?>

<? /*incio novo processo*/ ?>
<div class="modal novoProcesso">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo processo </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroNovoProcesso">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Processo</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeProcesso" placeholder="Informe o nome do processo" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Documento</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeDocumento" placeholder="Informe o documento referente ao processo" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3"></div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click","#novoProcesso").on("click","#novoProcesso", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $("#nomeProcesso").val("");
        $("#nomeDocumento").val("");
        abreModal('novoProcesso');
    }
});
$(document).off("submit","#cadastroNovoProcesso").on("submit","#cadastroNovoProcesso", function (e) {
    e.preventDefault();
    var data = {
        "nome": $("#nomeProcesso").val(),
        "documento": $("#nomeDocumento").val(),
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novoProcesso',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemProcessos();
            abreModal('processoCadastradoCC');
            setTimeout(function () {
                $("#nomeProcesso").val("");
                $("#nomeDocumento").val("");
                fechaModal('processoCadastradoCC');
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim novo processo*/ ?>

<? /*inicio editar processo*/ ?>
<div class="modal editaProcesso">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Editar processo </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editarProcesso">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Processo</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeProcessoEdit" placeholder="Informe o nome do processo" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Documento</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeDocumentoEdit" placeholder="Informe o documento referente ao processo" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3"></div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idProcesso;
var nome;
var doc;
$(document).off('click', "#editaProcesso").on('click', "#editaProcesso", function () {
    idProcesso = $(this).data("id");
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheProcesso/' + idProcesso,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.listagem[0][0].nome;
                doc = data.listagem[0][0].documento;
                $("#nomeProcessoEdit").val(nome);
                $("#nomeDocumentoEdit").val(doc);
                abreModal('editaProcesso');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#editarProcesso").on('submit',"#editarProcesso", function (e) {
    e.preventDefault();
    var data = {
        "nome": $("#nomeProcessoEdit").val(),
        "documento": $("#nomeDocumentoEdit").val(),
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'atualizarProcesso/' + idProcesso,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $('span[data-nomeprocesso]').each(function(){
                if ($(this).data("nomeprocesso") == nome+idProcesso) {
                    $(this).html($("#nomeProcessoEdit").val());
                    $(this).data("nomeprocesso",$("#nomeProcessoEdit").val()+idProcesso);
                }
            });
            $('span[data-documentoprocesso]').each(function(){
                if ($(this).data("documentoprocesso") == doc+idProcesso) {
                    $(this).html($("#nomeDocumentoEdit").val());
                    $(this).data("documentoprocesso",$("#nomeDocumentoEdit").val()+idProcesso);
                }
            });
            $(".processoEditadoCC").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar processo*/ ?>

<? /*inicio deleta processo*/ ?>
<div class="modal deletaProcesso">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse Processo? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirProcesso">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Excluir </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click", "#deletaProcesso").on("click", "#deletaProcesso", function () {
    idDel = $(this).data("id");
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {abreModal('deletaProcesso');}
});
$(document).off('submit',"#excluirProcesso").on('submit',"#excluirProcesso", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deleteProcesso/' + idDel,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            listagemProcessos();
            $(".processoDeletadoCC").fadeIn(function(){
                setTimeout(function () {$(".modal").fadeOut();}, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deleta processo*/ ?>

<? /*incio novo setor*/ ?>
<div class="modal novoSetor">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo setor </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroNovoSetor">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Setor</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeSetor" placeholder="Informe o nome do setor" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3"></div>
                <div class="col x3"></div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idProcesso = 0;
var idSetor = 0;
$(document).off("click", "#novoSetor").on("click", "#novoSetor", function () {
    idProcesso = $(this).data("idprocesso");
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {abreModal('novoSetor');}
});
$(document).off("submit","#cadastroNovoSetor").on("submit","#cadastroNovoSetor", function (e) {
    e.preventDefault();
    var data = {
        "nome": $("#nomeSetor").val(),
        "processos_id": idProcesso
    }
    $.ajax({
        type: 'POST',
        url: urlApi+'novoSetor',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data2) {
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemProcessos',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data) {
                    var setores = "";
                    for (var i = 0; i < data.listagem.length; i++) {
                        if (data.listagem[i].processo.id == idProcesso) {
                            for (var j = 0; j < data.listagem[i].setores.length; j++) {
                                if (data.listagem[i].setores[j].setor.nome == $("#nomeSetor").val() && setores == "") {
                                    setores = `
                                    <div class="listaItens accordion s`+ data.listagem[i].setores[j].setor.id + `">
                                    <div class="block">
                                    <a class="line" onclick="abreAcordeon('s`+ data.listagem[i].setores[j].setor.id + `')">
                                    <div class="table">
                                    <div class="icone"><i class="dropdown icon"></i></div>
                                    <div class="nome"><span data-nomesetor="`+data.listagem[i].setores[j].setor.nome+data.listagem[i].setores[j].setor.id+`">`+data.listagem[i].setores[j].setor.nome+`</span></div>
                                    </div>
                                    </a>
                                    <div class="buttonItem">
                                    <a id="editaSetor" class="edita" data-id="`+ data.listagem[i].setores[j].setor.id + `"><i class="icon edit"></i></a>
                                    <a id="deletaSetor" class="del" data-id="`+ data.listagem[i].setores[j].setor.id + `"><i class="icon trash alternate"></i></a>
                                    </div>
                                    </div>
                                    <div class="threeItem">
                                    <div class="botaoNovo"><a id="novoItem" data-idprocesso="`+ data.listagem[i].processo.id + `" data-idsetor="` + data.listagem[i].setores[j].setor.id + `">
                                    <i class="plus square outline icon"></i>Novo Item
                                    </a></div>
                                    <div class="listagem">
                                    <div class="listaitens`+data.listagem[i].setores[j].setor.id+`">
                                    <div class="item">
                                    <div class="lista">
                                    <div class="listItem"><span>Sem Itens Cadastrados</span></div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    `;
                                    if (data.listagem[i].setores.length == 1) {
                                        $(".listasetores"+idProcesso).html(setores);
                                    }else{
                                        $(".listasetores"+idProcesso).prepend(setores);
                                    }
                                }
                            }
                        }
                    }
                },
                error: function(resp){console.log(resp.statusText);}
            });
            abreModal('setorCadastradoCC');
            setTimeout(function () {
                $("#nomeSetor").val("");
                fechaModal('setorCadastradoCC');
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim novo setor*/ ?>

<? /*inicio editar setor*/ ?>
<div class="modal editaSetor">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo setor </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editarSetor">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span>Nome do Setor</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeSetorEdit" placeholder="Informe o nome do setor" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3"></div>
                <div class="col x3"></div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idSetor;
var nome;
$(document).off('click', "#editaSetor").on('click', "#editaSetor", function () {
    idSetor = $(this).data("id");
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalhe/' + idSetor,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.setor.nome;
                $("#nomeSetorEdit").val(nome);
                abreModal('editaSetor');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#editarSetor").on('submit',"#editarSetor", function (e) {
    e.preventDefault();
    var data = {"nome": $("#nomeSetorEdit").val(),};
    $.ajax({
        type: 'POST',
        url: urlApi+'atualizarSetor/' + idSetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $('span[data-nomesetor]').each(function(){
                if ($(this).data("nomesetor") == nome+idSetor) {
                    $(this).html($("#nomeSetorEdit").val());
                    $(this).data("nomesetor",$("#nomeSetorEdit").val()+idSetor);
                }
            });
            $(".setorEditadoCC").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar setor*/ ?>

<? /*inicio deleta setor*/ ?>
<div class="modal deletaSetor">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse Setor? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirSetor">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Excluir </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click", "#deletaSetor").on("click", "#deletaSetor", function () {
    idDel = $(this).data("id");
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {abreModal('deletaSetor');}
});
$(document).off('submit',"#excluirSetor").on('submit',"#excluirSetor", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deleteSetor/' + idDel,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $('.s'+idDel).html("");
            $(".setorDeletadoCC").fadeIn(function(){
                setTimeout(function () {$(".modal").fadeOut();}, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deleta setor*/ ?>

<? /*incio novo item*/ ?>
<div class="modal novoItem">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo item </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <div class="seletorTipoItem">
            <a onclick="mudaItemType('itemConf')" class="mudaTipoItem itemConf ativo" type="button" name="button"> Conformidade </a>
            <a onclick="mudaItemType('itemTemp')" class="mudaTipoItem itemTemp" type="button" name="button"> Temperatura </a>
        </div>
        <form class="form ocultaTipoItem itemConf ativo" id="cadastroNovoItemConf">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome do Item</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeItemConf" placeholder="Informe o nome do item" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Passos para controle (Ajuda)</span>
                        <div class="input">
                            <div class="icone">
                                <textarea class="ajuda" id="ajudaConf" placeholder="Informe uma descrição para ajuda no controle!" rows="2" onkeyup="auto_grow(this)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox"> Não Conformidades </span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Não Conformidade" id="novaNConformidade"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll1"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll1"><i class="check icon"></i></a><input id="checkAllVerify1" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro1" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarNaoConf1"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll1").on("click", "#checkAll1", function () {
                        if ($("#checkAllVerify1").is(':checked')) {
                            $("#checkAllVerify1").prop('checked', false);
                            $(".checkBox1").prop('checked', false);
                        }else {
                            $("#checkAllVerify1").prop('checked', 'true');
                            $(".checkBox1").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll1").on("click", "#listAll1", function () {
                        $(".busca5").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro1").on("keypress", "#buscarFiltro1", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro1").val() == "") {
                            $(".busca5").removeClass("off");
                        }else{
                            $(".busca5").each(function() {
                                if (((removeAcentos(($(this).data('nome').toString())).toLowerCase()).indexOf((removeAcentos($("#buscarFiltro1").val())).toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
        <form class="form ocultaTipoItem itemTemp" id="cadastroNovoItemTemp">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome do Item</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeItemTemp" placeholder="Informe o nome do item" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Temperatura mínima </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Mínima" type="number" required id="tempMin">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Temperatura máxima </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Máxima" type="number" required id="tempMax">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Passos para controle (Ajuda)</span>
                        <div class="input">
                            <div class="icone">
                                <textarea class="ajuda" id="ajudaTemp" placeholder="Informe uma descrição para ajuda no controle!" rows="2" onkeyup="auto_grow(this)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox"> Não Conformidades </span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Não Conformidade" id="novaNConformidade"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll3"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll3"><i class="check icon"></i></a><input id="checkAllVerify3" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro3" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarNaoConf3"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll3").on("click", "#checkAll3", function () {
                        if ($("#checkAllVerify3").is(':checked')) {
                            $("#checkAllVerify3").prop('checked', false);
                            $(".checkBox3").prop('checked', false);
                        }else {
                            $("#checkAllVerify3").prop('checked', 'true');
                            $(".checkBox3").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll3").on("click", "#listAll3", function () {
                        $(".busca3").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro3").on("keypress", "#buscarFiltro3", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro3").val() == "") {
                            $(".busca3").removeClass("off");
                        }else{
                            $(".busca3").each(function() {
                                if (((removeAcentos(($(this).data('nome').toString())).toLowerCase()).indexOf((removeAcentos($("#buscarFiltro3").val())).toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click", "#novoItem").on("click", "#novoItem", function () {
    idProcesso = $(this).data("idprocesso");
    idSetor = $(this).data("idsetor");
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        $(":checkbox").prop('checked', false);
        abreModal('novoItem');
    }
});
</script>
<? /*item conformidade*/ ?>
<script type="text/javascript">
$(document).off("submit","#cadastroNovoItemConf").on("submit","#cadastroNovoItemConf", function (e) {
    e.preventDefault();
    var valorNaoConf = new Array();
    naoConfs = 0;
    e.preventDefault();
    $(".naoConf").each(function () {
        if ($(this).is(':checked')) {
            naoConfs = {
                "id": $(this).val()
            }
            valorNaoConf.push(naoConfs);
        }
    });
    var data = {
        "nome": $("#nomeItemConf").val(),
        "processoid": idProcesso,
        "setorid": idSetor,
        "naoconformidades": valorNaoConf,
        "ajuda": $("#ajudaConf").val()
    }
    $.ajax({
        type: 'POST',
        url: urlApi+'novoItem/' + idProcesso + '/' + idSetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data2) {
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemProcessos',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data) {
                    var itens = "";
                    for (var i = 0; i < data.listagem.length; i++) {
                        if (data.listagem[i].processo.id == idProcesso) {
                            for (var j = 0; j < data.listagem[i].setores.length; j++) {
                                if (data.listagem[i].setores[j].setor.id == idSetor) {
                                    for (var k = 0; k < data.listagem[i].setores[j].item.conformidade.length; k++) {
                                        if (data.listagem[i].setores[j].item.conformidade[k].nome == $("#nomeItemConf").val() && itens == "") {
                                            itens =`
                                            <div class="item" data-id="`+ data.listagem[i].setores[j].item.conformidade[k].id + `">
                                            <div class="lista">
                                            <div class="listItem"><span data-nomeitem="`+data.listagem[i].setores[j].item.conformidade[k].nome+data.listagem[i].setores[j].item.conformidade[k].id+`">`+data.listagem[i].setores[j].item.conformidade[k].nome+`</span></div>
                                            <div class="buttonItem"><a id="editaItemConf" class="edita" data-idprocesso="`+ data.listagem[i].processo.id + `" data-idsetor="` + data.listagem[i].setores[j].setor.id + `" data-iditem="`+ data.listagem[i].setores[j].item.conformidade[k].id + `"><i class="icon edit"></i></a></div>
                                            <div class="buttonItem"><a class="del delConf" data-id="`+ data.listagem[i].setores[j].item.conformidade[k].id + `"><i class="icon trash alternate"></i></a></div>
                                            </div>
                                            </div>
                                            `;
                                            if (data.listagem[i].setores[j].item.conformidade.length == 1 && data.listagem[i].setores[j].item.temperatura.length == 0) {
                                                $(".listaitens"+idSetor).html(itens);
                                            }else{
                                                $(".listaitens"+idSetor).prepend(itens);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                error: function(resp){console.log(resp.statusText);}
            });
            abreModal('itemCadastradoCC');
            setTimeout(function () {
                $("#nomeItemConf").val("");
                $("#ajudaConf").val("");
                $(":checkbox").prop('checked', false);
                valorNaoConf.splice(0, valorNaoConf.length);
                fechaModal('itemCadastradoCC');
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*item temperatura*/ ?>
<script type="text/javascript">
$(document).off("submit","#cadastroNovoItemTemp").on("submit","#cadastroNovoItemTemp", function (e) {
    var valorNaoConfTemp = new Array();
    naoConfsTemp = 0;
    e.preventDefault();
    $(".naoConf").each(function () {
        if ($(this).is(':checked')) {
            naoConfsTemp = {"id": $(this).val()}
            valorNaoConfTemp.push(naoConfsTemp);
        }
    });
    var data = {
        "nome": $("#nomeItemTemp").val(),
        "processoid": idProcesso,
        "setorid": idSetor,
        "temperatura_minima": $("#tempMin").val(),
        "temperatura_maxima": $("#tempMax").val(),
        "naoconformidades": valorNaoConfTemp,
        "ajuda": $("#ajudaTemp").val()
    }
    $.ajax({
        type: 'POST',
        url: urlApi+'novoItemTemperatura/' + idProcesso + '/' + idSetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data2) {
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemProcessos',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data) {
                    var itens = "";
                    for (var i = 0; i < data.listagem.length; i++) {
                        if (data.listagem[i].processo.id == idProcesso) {
                            for (var j = 0; j < data.listagem[i].setores.length; j++) {
                                if (data.listagem[i].setores[j].setor.id == idSetor) {
                                    for (var k = 0; k < data.listagem[i].setores[j].item.temperatura.length; k++) {
                                        if (data.listagem[i].setores[j].item.temperatura[k].nome == $("#nomeItemTemp").val() && data.listagem[i].setores[j].item.temperatura[k].temperatura_maxima == $("#tempMax").val() && data.listagem[i].setores[j].item.temperatura[k].temperatura_minima == $("#tempMin").val() && itens == "") {
                                            itens =`
                                            <div class="item" data-id="`+ data.listagem[i].setores[j].item.temperatura[k].id + `">
                                            <div class="lista">
                                            <div class="listItem"><span data-nomeitem="`+data.listagem[i].setores[j].item.temperatura[k].nome+data.listagem[i].setores[j].item.temperatura[k].id+`">`+ data.listagem[i].setores[j].item.temperatura[k].nome + `</span></div>
                                            <div class="buttonItem"><a id="editaItemTemp" class="edita" data-idprocesso="`+ data.listagem[i].processo.id + `" data-idsetor="` + data.listagem[i].setores[j].setor.id + `" data-iditem="`+ data.listagem[i].setores[j].item.temperatura[k].id + `"><i class="icon edit"></i></a></div>
                                            <div class="buttonItem"><a class="del delTemp" data-id="`+ data.listagem[i].setores[j].item.temperatura[k].id + `"><i class="icon trash alternate"></i></a></div>
                                            </div>
                                            </div>
                                            `;
                                            if (data.listagem[i].setores[j].item.temperatura.length == 1 && data.listagem[i].setores[j].item.conformidade.length == 0) {
                                                $(".listaitens"+idSetor).html(itens);
                                            }else{
                                                $(".listaitens"+idSetor).prepend(itens);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                },
                error: function(resp){console.log(resp.statusText);}
            });
            abreModal('itemCadastradoCC');
            setTimeout(function () {
                $(":checkbox").prop('checked', false);
                valorNaoConfTemp.splice(0, valorNaoConfTemp.length);
                $("#tempMin").val("");
                $("#tempMax").val("");
                $("#nomeItemTemp").val("");
                $("#ajudaTemp").val("");
                fechaModal('itemCadastradoCC');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim novo item*/ ?>

<? /*inicio editar item*/ ?>
<? /*item conformidade*/ ?>
<div class="modal editaItemConf">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Editar item </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editarItemConf">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome do Item</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeItemEditarConf" placeholder="Informe o nome do item" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Passos para controle (Ajuda)</span>
                        <div class="input">
                            <div class="icone">
                                <textarea class="ajuda" id="ajudaConfEdit" placeholder="Informe uma descrição para ajuda no controle!" rows="2" onkeyup="auto_grow(this)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox"> Não Conformidades </span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Não Conformidade" id="novaNConformidade"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll2"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll2"><i class="check icon"></i></a><input id="checkAllVerify2" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro2" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarNaoConf2"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll2").on("click", "#checkAll2", function () {
                        if ($("#checkAllVerify2").is(':checked')) {
                            $("#checkAllVerify2").prop('checked', false);
                            $(".checkBox2").prop('checked', false);
                        }else {
                            $("#checkAllVerify2").prop('checked', 'true');
                            $(".checkBox2").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll2").on("click", "#listAll2", function () {
                        $(".busca2").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro2").on("keypress", "#buscarFiltro2", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro2").val() == "") {
                            $(".busca2").removeClass("off");
                        }else{
                            $(".busca2").each(function() {
                                if (((removeAcentos(($(this).data('nome').toString())).toLowerCase()).indexOf((removeAcentos($("#buscarFiltro2").val())).toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idEditarItem = 0;
var idProcesso = 0;
var idSetor = 0;
$(document).off('click', "#editaItemConf").on('click', "#editaItemConf", function () {
    idEditarItem = $(this).data("iditem");
    idProcesso = $(this).data("idprocesso");
    idSetor = $(this).data("idsetor");
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheItem/' + idEditarItem,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.item[0].nome;
                $(":checkbox").prop('checked', false);
                if(typeof data.naocitens !== 'undefined' && data.naocitens.length > 0){
                    for (var i = 0; i < data.naocitens.length; i++) {
                        $("[data-acao2=" + data.naocitens[i][0].id + "]").prop('checked', 'true');
                    }
                }
                $("#nomeItemEditarConf").val(nome);
                $("#ajudaConfEdit").val(data.item[0].ajuda);
                abreModal('editaItemConf');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#editarItemConf").on('submit',"#editarItemConf", function (e) {
    e.preventDefault();
    var valorNaoConfs = new Array();
    valorNaoConfs.splice(0, valorNaoConfs.length);
    $(".naoConf").each(function () {
        if ($(this).is(':checked')) {
            valorNaoConf = {"id": $(this).val()}
            valorNaoConfs.push(valorNaoConf);
        }
    });
    var data = {
        "nome": $("#nomeItemEditarConf").val(),
        "naoconformidades": valorNaoConfs,
        "ajuda": $("#ajudaConfEdit").val()
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'atualizarItem/' + idEditarItem+ '/' + idProcesso + '/' + idSetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $('span[data-nomeitem]').each(function(){
                if ($(this).data("nomeitem") == nome+idEditarItem) {
                    $(this).html($("#nomeItemEditarConf").val());
                    $(this).data("nomeitem",$("#nomeItemEditarConf").val()+idEditarItem);
                }
            });
            abreModal('itemEditadoCC');
            setTimeout(function () {fechaModal();}, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*item temperatura*/ ?>
<div class="modal editaItemTemp">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Editar item </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editarItemTemp">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome do Item</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeItemEditarTemp" placeholder="Informe o nome do item" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Temperatura mínima </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Mínima" type="number" required id="tempMinEdit">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Temperatura máxima </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Máxima" type="number" required id="tempMaxEdit">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Passos para controle (Ajuda)</span>
                        <div class="input">
                            <div class="icone">
                                <textarea class="ajuda" id="ajudaTempEdit" placeholder="Informe uma descrição para ajuda no controle!" rows="2" onkeyup="auto_grow(this)"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox"> Não Conformidades </span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Não Conformidade" id="novaNConformidade"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll4"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll4"><i class="check icon"></i></a><input id="checkAllVerify4" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro4" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarNaoConf4"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll4").on("click", "#checkAll4", function () {
                        if ($("#checkAllVerify4").is(':checked')) {
                            $("#checkAllVerify4").prop('checked', false);
                            $(".checkBox4").prop('checked', false);
                        }else {
                            $("#checkAllVerify4").prop('checked', 'true');
                            $(".checkBox4").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll4").on("click", "#listAll4", function () {
                        $(".busca4").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro4").on("keypress", "#buscarFiltro4", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro4").val() == "") {
                            $(".busca4").removeClass("off");
                        }else{
                            $(".busca4").each(function() {
                                if (((removeAcentos(($(this).data('nome').toString())).toLowerCase()).indexOf((removeAcentos($("#buscarFiltro4").val())).toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idEditarItem = 0;
var idProcesso = 0;
var idSetor = 0;
$(document).off('click', "#editaItemTemp").on('click', "#editaItemTemp", function () {
    idEditarItem = $(this).data("iditem");
    idProcesso = $(this).data("idprocesso");
    idSetor = $(this).data("idsetor");
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheItemTemperatura/' + idEditarItem,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.itemTemperatura.nome;
                tempmax = data.itemTemperatura.temperatura_maxima;
                tempmin = data.itemTemperatura.temperatura_minima;
                $(":checkbox").prop('checked', false);
                if(typeof data.naocitens !== 'undefined' && data.naocitens.length > 0){
                    for (var i = 0; i < data.naocitens.length; i++) {
                        $("[data-acao4=" + data.naocitens[i][0].id + "]").prop('checked', 'true');
                    }
                }
                $("#nomeItemEditarTemp").val(nome);
                $("#tempMinEdit").val(tempmin);
                $("#tempMaxEdit").val(tempmax);
                $("#ajudaTempEdit").val(data.itemTemperatura.ajuda);
                abreModal('editaItemTemp');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#editarItemTemp").on('submit',"#editarItemTemp", function (e) {
    e.preventDefault();
    var valorNaoConfs = new Array();
    valorNaoConfs.splice(0, valorNaoConfs.length);
    $(".naoConf").each(function () {
        if ($(this).is(':checked')) {
            valorNaoConfTemp = {"id": $(this).val()}
            valorNaoConfs.push(valorNaoConfTemp);
        }
    });
    var data = {
        "nome": $("#nomeItemEditarTemp").val(),
        "temperatura_minima": $("#tempMinEdit").val(),
        "temperatura_maxima": $("#tempMaxEdit").val(),
        "naoconformidades": valorNaoConfs,
        "ajuda": $("#ajudaTempEdit").val()
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'atualizarItemTemperatura/' + idEditarItem+ '/' + idProcesso + '/' + idSetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $('span[data-nomeitem]').each(function(){
                if ($(this).data("nomeitem") == nome+idEditarItem) {
                    $(this).html($("#nomeItemEditarTemp").val());
                    $(this).data("nomeitem",$("#nomeItemEditarTemp").val()+idEditarItem);
                }
            });
            abreModal('itemEditadoCC');
            setTimeout(function () {fechaModal();}, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar item*/ ?>

<? /*inicio deletar item*/ ?>
<div class="modal deletaItemConf">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse item? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirItem">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Excluir </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click", ".delConf").on("click", ".delConf", function () {
    idDel = $(this).data("id");
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {abreModal('deletaItemConf');}
});
$(document).off('submit',"#excluirItem").on('submit',"#excluirItem", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deleteItem/' + idDel,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $('.item[data-id]').each(function(){
                if ($(this).data("id") == idDel) {
                    $(this).html("");
                }
            });
            $(".itemDeletadoCC").fadeIn(function(){
                setTimeout(function () {$(".modal").fadeOut();}, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<div class="modal deletaItemTemp">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse item? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirItemTemp">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Excluir </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click", ".delTemp").on("click", ".delTemp", function () {
    idDel = $(this).data("id");
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {abreModal('deletaItemTemp');}
});
$(document).off('submit',"#excluirItemTemp").on('submit',"#excluirItemTemp", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deleteItemTemperatura/' + idDel,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $('.item[data-id]').each(function(){
                if ($(this).data("id") == idDel) {
                    $(this).html("");
                }
            });
            $(".itemDeletadoCC").fadeIn(function(){setTimeout(function () {$(".modal").fadeOut();}, 1500);});
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar item*/ ?>

<? /*inicio listagem não conformidades*/ ?>
<script type="text/javascript">
var listarNaoConf1 = '';
var listarNaoConf2 = '';
var listarNaoConf3 = '';
var listarNaoConf4 = '';
var NC = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagemNaoconformidade',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        if(data.naoconformidades != undefined){
            for (var i = 0; i < data.naoconformidades.length; i++) {
                NC = data.naoconformidade;
                listarNaoConf1 +=`
                <div class="item itemBusca busca5" data-nome="`+ data.naoconformidades[i].naoconformidade.nome + `">
                <input type="checkbox" class="naoConf checkBox1" name="naoConfs" value="`+ data.naoconformidades[i].naoconformidade.id + `" data-acao1="` + data.naoconformidades[i].naoconformidade.id + `">
                <span>`+ data.naoconformidades[i].naoconformidade.nome + `</span>
                </div>
                `;
                listarNaoConf2 +=`
                <div class="item itemBusca busca2" data-nome="`+ data.naoconformidades[i].naoconformidade.nome + `">
                <input type="checkbox" class="naoConf checkBox2" name="naoConfs" value="`+ data.naoconformidades[i].naoconformidade.id + `" data-acao2="` + data.naoconformidades[i].naoconformidade.id + `">
                <span>`+ data.naoconformidades[i].naoconformidade.nome + `</span>
                </div>
                `;
                listarNaoConf3 +=`
                <div class="item itemBusca busca3" data-nome="`+ data.naoconformidades[i].naoconformidade.nome + `">
                <input type="checkbox" class="naoConf checkBox3" name="naoConfs" value="`+ data.naoconformidades[i].naoconformidade.id + `" data-acao3="` + data.naoconformidades[i].naoconformidade.id + `">
                <span>`+ data.naoconformidades[i].naoconformidade.nome + `</span>
                </div>
                `;
                listarNaoConf4 +=`
                <div class="item itemBusca busca4" data-nome="`+ data.naoconformidades[i].naoconformidade.nome + `">
                <input type="checkbox" class="naoConf checkBox4" name="naoConfs" value="`+ data.naoconformidades[i].naoconformidade.id + `" data-acao4="` + data.naoconformidades[i].naoconformidade.id + `">
                <span>`+ data.naoconformidades[i].naoconformidade.nome + `</span>
                </div>
                `;
            };
        }else {
            listarNaoConf1 =`
            <div class="item">
            <input type="checkbox" class="naoConf checkBox1" name="naoConfs" disabled>
            <span>Sem não conformidades cadastradas!</span>
            </div>
            `;
            listarNaoConf2 = listarNaoConf1;
            listarNaoConf3 = listarNaoConf1;
            listarNaoConf4 = listarNaoConf1;
        };
        $(".listarNaoConf1").html(listarNaoConf1);
        $(".listarNaoConf2").html(listarNaoConf2);
        $(".listarNaoConf3").html(listarNaoConf3);
        $(".listarNaoConf4").html(listarNaoConf4);
    },
    error: function(resp){console.log(resp.statusText);}
});
</script>
<? /*fim listagem não conformidades*/ ?>

<? /*inicio nova não conformidade*/ ?>
<div class="modal novaNaoConformidade">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de não conformidades </span>
            <a class="close" onclick="fechaModal('novaNaoConformidade')"><i class="close icon"></i></a>
        </div>
        <form class="form" id="formCadastro">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o nome" type="text" required id="nome">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricao" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox">Ações Corretivas</span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Ação Corretiva" id="novaAcaoCorretiva"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll5"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll5"><i class="check icon"></i></a><input id="checkAllVerify5" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro5" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarAcoes1"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll5").on("click", "#checkAll5", function () {
                        if ($("#checkAllVerify5").is(':checked')) {
                            $("#checkAllVerify5").prop('checked', false);
                            $(".checkBox5").prop('checked', false);
                        }else {
                            $("#checkAllVerify5").prop('checked', 'true');
                            $(".checkBox5").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll5").on("click", "#listAll5", function () {
                        $(".busca6").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro5").on("keypress", "#buscarFiltro5", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro5").val() == "") {
                            $(".busca6").removeClass("off");
                        }else{
                            $(".busca6").each(function() {
                                if (((removeAcentos(($(this).data('nome').toString())).toLowerCase()).indexOf((removeAcentos($("#buscarFiltro5").val())).toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal('novaNaoConformidade')"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click","#novaNConformidade").on("click","#novaNConformidade", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        $("#nome").val(""),
        $("#descricao").val(""),
        $(":checkbox").prop('checked', false);
        abreModal('novaNaoConformidade');
    }
});
$(document).off('submit',"#formCadastro").on('submit',"#formCadastro", function (e) {
    var valoracao = new Array();
    acoes = 0;
    e.preventDefault();
    $(".acao").each(function () {
        if ($(this).is(':checked')) {
            acoes = {"id": $(this).val()}
            valoracao.push(acoes);
        }
    })
    var data = {
        "nome": $("#nome").val(),
        "descricao": $("#descricao").val(),
        "acaocorretivas": valoracao
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novaNaoConformidade',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            var listarNaoConf1 = '';
            var listarNaoConf2 = '';
            var listarNaoConf3 = '';
            var listarNaoConf4 = '';
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemNaoconformidade',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data2) {
                    for (var i = 0; i < data2.naoconformidades.length; i++) {
                        if (data2.naoconformidades[i].naoconformidade.nome == $("#nome").val() && data2.naoconformidades[i].naoconformidade.descricao == $("#descricao").val() && listarNaoConf1 == "") {
                            listarNaoConf1 +=`
                            <div class="item itemBusca busca5" data-nome="`+ data2.naoconformidades[i].naoconformidade.nome + `">
                            <input type="checkbox" class="naoConf checkBox1" name="naoConfs" value="`+ data2.naoconformidades[i].naoconformidade.id + `" data-acao1="` + data2.naoconformidades[i].naoconformidade.id + `">
                            <span>`+ data2.naoconformidades[i].naoconformidade.nome + `</span>
                            </div>
                            `;
                            listarNaoConf2 +=`
                            <div class="item itemBusca busca2" data-nome="`+ data2.naoconformidades[i].naoconformidade.nome + `">
                            <input type="checkbox" class="naoConf checkBox2" name="naoConfs" value="`+ data2.naoconformidades[i].naoconformidade.id + `" data-acao2="` + data2.naoconformidades[i].naoconformidade.id + `">
                            <span>`+ data2.naoconformidades[i].naoconformidade.nome + `</span>
                            </div>
                            `;
                            listarNaoConf3 +=`
                            <div class="item itemBusca busca3" data-nome="`+ data2.naoconformidades[i].naoconformidade.nome + `">
                            <input type="checkbox" class="naoConf checkBox3" name="naoConfs" value="`+ data2.naoconformidades[i].naoconformidade.id + `" data-acao3="` + data2.naoconformidades[i].naoconformidade.id + `">
                            <span>`+ data2.naoconformidades[i].naoconformidade.nome + `</span>
                            </div>
                            `;
                            listarNaoConf4 +=`
                            <div class="item itemBusca busca4" data-nome="`+ data2.naoconformidades[i].naoconformidade.nome + `">
                            <input type="checkbox" class="naoConf checkBox4" name="naoConfs" value="`+ data2.naoconformidades[i].naoconformidade.id + `" data-acao4="` + data2.naoconformidades[i].naoconformidade.id + `">
                            <span>`+ data2.naoconformidades[i].naoconformidade.nome + `</span>
                            </div>
                            `;
                            $(".listarNaoConf1").prepend(listarNaoConf1);
                            $(".listarNaoConf2").prepend(listarNaoConf2);
                            $(".listarNaoConf3").prepend(listarNaoConf3);
                            $(".listarNaoConf4").prepend(listarNaoConf4);
                        }
                    }
                },
                error: function(resp){console.log(resp.statusText);}
            });
            abreModal('ncCadastrada');
            setTimeout(function () {
                $(":checkbox").prop('checked', false);
                $("#nome").val("");
                $("#descricao").val("");
                fechaModal('ncCadastrada');
                fechaModal('novaNaoConformidade');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim nova não conformidade*/ ?>

<? /*inicio listagem ações corretivas*/ ?>
<script type="text/javascript">
var listarAcoes1 = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagemAcaoCorretiva',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        if (data.acoescorretivas != undefined) {
            for (var i = 0; i < data.acoescorretivas.length; i++) {
                listarAcoes1 += `
                <div class="item itemBusca busca6" data-nome="`+ data.acoescorretivas[i].acaocorretiva.nome + `">
                <input type="checkbox" class="acao checkBox5" name="acao1" value="`+ data.acoescorretivas[i].acaocorretiva.id +`" data-acao2="` + data.acoescorretivas[i].acaocorretiva.id + `">
                <span>`+ data.acoescorretivas[i].acaocorretiva.nome + `</span>
                </div>
                `;
            };
        }else{
            listarAcoes1 = `
                <div class="item">
                <input type="checkbox" class="acao">
                <span>Sem ações corretivas cadastradas!</span>
                </div>
            `;
        };
        $(".listarAcoes1").html(listarAcoes1);
    },
    error: function(resp){console.log(resp.statusText);}
});
</script>
<? /*fim listagem ações corretivas*/ ?>

<? /*inicio nova ação corretiva*/ ?>
<div class="modal novaAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de ações corretivas </span>
            <a class="close" onclick="fechaModal('novaAcaoCorretiva')"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroAcaoCorretiva">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input id="nomeAcaoCorretiva" placeholder="Informe o nome" type="text" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricaoAcaoCorretiva" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Tempo para Correção</span>
                        <div class="input">
                            <div class="icone time2">
                                <select id="mudaTipoSelect">
                                    <option selected value="horas"> Horas </option>
                                    <option value="dias"> Dias </option>
                                </select>
                                <script>
                                $(document).off("change","#mudaTipoSelect").on("change","#mudaTipoSelect",function(){
                                    if ($(this).val() == "horas"){$("#tempo").prop("type", "time");}
                                    if ($(this).val() == "dias"){$("#tempo").prop("type", "number");}
                                });
                                </script>
                            </div>
                            <div class="icone time1">
                                <input id="tempo" placeholder="0" type="time" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal('novaAcaoCorretiva')"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).off("click","#novaAcaoCorretiva").on("click","#novaAcaoCorretiva", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {abreModal('novaAcaoCorretiva');}
});
$(document).off('submit',"#cadastroAcaoCorretiva").on('submit',"#cadastroAcaoCorretiva", function (e) {
    e.preventDefault();
    var tempoConvertido = "";
    if($("#mudaTipoSelect").val() == "horas"){tempoConvertido = $("#tempo").val();}
    if($("#mudaTipoSelect").val() == "dias"){tempoConvertido = ($("#tempo").val()*24)+":00";}
    var data = {
        "nome": $("#nomeAcaoCorretiva").val(),
        "descricao": $("#descricaoAcaoCorretiva").val(),
        "tempo": tempoConvertido+":00"
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novaAcaoCorretiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemAcaoCorretiva',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data2) {
                    var acrescimo = "";
                    var listarAcoes1 = "";
                    var listarAcoes2 = "";
                    for (var i = 0; i < data2.acoescorretivas.length; i++) {
                        if (data2.acoescorretivas[i].acaocorretiva.nome == $("#nomeAcaoCorretiva").val() && data2.acoescorretivas[i].acaocorretiva.descricao == $("#descricaoAcaoCorretiva").val() && listarAcoes1 == "") {
                            listarAcoes1 += `
                            <div class="item itemBusca busca3" data-nome="`+ data2.acoescorretivas[i].acaocorretiva.nome + `">
                            <input type="checkbox" class="acao checkBox1" name="acao1" value="`+ data2.acoescorretivas[i].acaocorretiva.id +`" data-acao2="` + data2.acoescorretivas[i].acaocorretiva.id + `">
                            <span>`+ data2.acoescorretivas[i].acaocorretiva.nome + `</span>
                            </div>
                            `;
                            listarAcoes2 += `
                            <div class="item itemBusca busca2" data-nome="`+ data2.acoescorretivas[i].acaocorretiva.nome + `">
                            <input type="checkbox" class="acao checkBox2" name="acao2" value="`+ data2.acoescorretivas[i].acaocorretiva.id + `" data-acao="` + data2.acoescorretivas[i].acaocorretiva.id + `">
                            <span>`+ data2.acoescorretivas[i].acaocorretiva.nome + `</span>
                            </div>
                            `;
                            if (data2.acoescorretivas.length == 1) {
                                $(".listarAcoes1").html(listarAcoes1);
                                $(".listarAcoes2").html(listarAcoes2);
                            }else {
                                $(".listarAcoes1").prepend(listarAcoes1);
                                $(".listarAcoes2").prepend(listarAcoes2);
                            }
                        }
                    }
                },
                error: function(resp){console.log(resp.statusText);}
            });
            abreModal('sucessoCadastroAC');
            setTimeout(function () {
                $("#nomeAcaoCorretiva").val("");
                $("#descricaoAcaoCorretiva").val("");
                $("#tempo").val("");
                fechaModal('sucessoCadastroAC');
                fechaModal('novaAcaoCorretiva');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim nova ação corretiva*/ ?>
