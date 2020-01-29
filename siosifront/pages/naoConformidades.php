<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemNaoconformidade() {
    $("#listagemNaoConformidade").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemNaoconformidade',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.naoconformidades != undefined){
                dadosListagem = data.naoconformidades;
            }else {
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemNaoconformidade();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listNaoConformidade = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listNaoConformidade += `
            <div class="item">
            <div class="lista">
            <div class="listItem x2"><span>`+ dados[i].naoconformidade.nome + `</span></div>
            <div class="listItem x2 xsinvisible"><span>`+ dados[i].naoconformidade.descricao + `</span></div>
            <div class="buttonItem"><a data-id="`+dados[i].naoconformidade.id+`" class="edita editarncedit" type="submit"><i class="icon edit"></i></a></div>
            <div class="buttonItem"><a class="del" data-id="`+dados[i].naoconformidade.id+`" type="submit"><i class="icon trash alternate"></i></a></div>
            </div>
            </div>
            `;
        }
    }else {
        listNaoConformidade = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem não conformidades cadastradas! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listagemNaoConformidade").html(listNaoConformidade);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Não Conformidades</div>
<div class="botaoNovo"><a id="novaNConformidade">
    <i class="plus square outline icon"></i>Nova não conformidade
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemNaoconformidade();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem não Conformidades*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x2"><span>Não Conformidade</span></div>
            <div class="listItem x2 xsinvisible"><span>Descrição</span></div>
            <div class="buttonItem xsinvisible"><span>Editar</span></div>
            <div class="buttonItem xsinvisible"><span>Excluir</span></div>
        </div>
    </div>
    <div id="listagemNaoConformidade"></div>
</div>
<? /*fim listagem não Conformidades*/ ?>

<? /*incio nova não Conformidades*/ ?>
<div class="modal novaNaoConformidade">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de não conformidades </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="formCadastro">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nome" placeholder="Informe o nome" rows="1" required onkeyup="auto_grow(this)"></textarea>
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
                        <a class="ordenar" title="Listar todos" id="listAll1"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll1"><i class="check icon"></i></a><input id="checkAllVerify1" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro1" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarAcoes1"></div>
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
                        $(".busca3").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro1").on("keypress", "#buscarFiltro1", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro1").val() == "") {
                            $(".busca3").removeClass("off");
                        }else{
                            $(".busca3").each(function() {
                                if (removeAcentos(($(this).data('nome').toString()).toLowerCase()).indexOf(removeAcentos($("#buscarFiltro1").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        };
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
$(document).off("click","#novaNConformidade").on("click","#novaNConformidade", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
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
            listagemNaoconformidade();
            abreModal('ncCadastrada');
            setTimeout(function () {
                $(":checkbox").prop('checked', false);
                $("#nome").val("");
                $("#descricao").val("");
                fechaModal('ncCadastrada');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim nova não Conformidades*/ ?>

<? /*inicio editar não Conformidades*/ ?>
<div class="modal editaNaoConformidade">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de não conformidades </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="formEdit">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeedit" placeholder="Informe o nome" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricaoedit" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox">Ações Corretivas</span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Nova Ação Corretiva" id="novaAcaoCorretiva"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll2"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll2"><i class="check icon"></i></a><input id="checkAllVerify2" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro2" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarAcoes2"></div>
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
                                if (removeAcentos(($(this).data('nome').toString()).toLowerCase()).indexOf(removeAcentos($("#buscarFiltro2").val().toLowerCase())) != -1) {
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
var id = 0;
var nome = '';
var descricao = '';
$(document).off('click', ".editarncedit").on('click', ".editarncedit", function () {
    id = $(this).data('id');
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheNaoconformidade/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.naoconformidade[0].nome;
                descricao = data.naoconformidade[0].descricao;
                $("#nomeedit").val(nome);
                $("#descricaoedit").val(descricao);
                var teste = '';
                $(":checkbox").prop('checked', false);
                if(typeof data.acoescorretivas != 'undefined' && data.acoescorretivas.length > 0){
                    for (var i = 0; i < data.acoescorretivas.length; i++) {
                        $("[data-acao=" + data.acoescorretivas[i][0].id + "]").prop('checked', 'true');
                    }
                }
                abreModal('editaNaoConformidade');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#formEdit").on('submit',"#formEdit", function (e) {
    e.preventDefault();
    var valoracaos = new Array();
    $(".acao").each(function () {
        if ($(this).is(':checked')) {
            acoes = {"id": $(this).val()}
            valoracaos.push(acoes);
        }
    });
    var data = {
        "nome": $("#nomeedit").val(),
        "descricao": $("#descricaoedit").val(),
        "acaocorretivas": valoracaos,
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'editarNaoconformidade/' + id,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemNaoconformidade();
            abreModal('ncEditada');
            setTimeout(function () {
                $(".modal").fadeOut();
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar não Conformidades*/ ?>

<? /*inicio deletar não Conformidades*/ ?>
<div class="modal deletarNaoConformidade">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você realmente deseja deletar essa não conformidade? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="deletarNaoConformidade">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Deletar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idDelete = 0;
$(document).off('click', ".del").on('click', ".del", function () {
    idDelete = $(this).data('id');
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {abreModal('deletarNaoConformidade');}
});
$(document).off('submit',"#deletarNaoConformidade").on('submit',"#deletarNaoConformidade", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarNaoConformidade/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            listagemNaoconformidade();
            abreModal('ncDeletada');
            setTimeout(function () {
                $(".modal").fadeOut();
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar não Conformidades*/ ?>

<? /*inicio listagem Ações Corretivas*/ ?>
<script type="text/javascript">
var listarAcoes1 = '';
var listarAcoes2 = '';
var acoesAt = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagemAcaoCorretiva',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        if (data.acoescorretivas != undefined) {
            for (var i = 0; i < data.acoescorretivas.length; i++) {
                acoesAt = data.acoescorretivas;
                listarAcoes1 += `
                <div class="item itemBusca busca3" data-nome="`+ data.acoescorretivas[i].acaocorretiva.nome + `">
                <input type="checkbox" class="acao checkBox1" name="acao1" value="`+ data.acoescorretivas[i].acaocorretiva.id +`" data-acao2="` + data.acoescorretivas[i].acaocorretiva.id + `">
                <span>`+ data.acoescorretivas[i].acaocorretiva.nome + `</span>
                </div>
                `;
                listarAcoes2 += `
                <div class="item itemBusca busca2" data-nome="`+ data.acoescorretivas[i].acaocorretiva.nome + `">
                <input type="checkbox" class="acao checkBox2" name="acao2" value="`+ data.acoescorretivas[i].acaocorretiva.id + `" data-acao="` + data.acoescorretivas[i].acaocorretiva.id + `">
                <span>`+ data.acoescorretivas[i].acaocorretiva.nome + `</span>
                </div>
                `;
            }
        }else{
            listarAcoes1 = `
            <div class="item">
            <input type="checkbox" disabled>
            <span>Sem ações corretivas cadastradas</span>
            </div>
            `;
            listarAcoes2 = listarAcoes1;
        }
        $(".listarAcoes1").html(listarAcoes1);
        $(".listarAcoes2").html(listarAcoes2);
    },
    error: function(resp){console.log(resp.statusText);}
});
</script>
<? /*fim listagem Ações Corretivas*/ ?>

<? /*inicio novaAcaoCorretiva*/ ?>
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
                                <textarea id="nomeAcaoCorretiva" placeholder="Informe o nome" rows="1" required onkeyup="auto_grow(this)"></textarea>
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
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
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
                        if (data2.acoescorretivas[i].acaocorretiva.nome == $("#nomeAcaoCorretiva").val() && data2.acoescorretivas[i].acaocorretiva.descricao == $("#descricaoAcaoCorretiva").val()) {
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
                        }
                    }
                    if (data2.acoescorretivas.length == 1) {
                        $(".listarAcoes1").html(listarAcoes1);
                        $(".listarAcoes2").html(listarAcoes2);
                    }else {
                        $(".listarAcoes1").prepend(listarAcoes1);
                        $(".listarAcoes2").prepend(listarAcoes2);
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
<? /*fim novaAcaoCorretiva*/ ?>
