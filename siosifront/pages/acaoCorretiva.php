<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
 var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemAcaoCorretiva() {
    $("#listaAcaoCorretiva").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    dadosListagem = [];
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemAcaoCorretiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.acoescorretivas != undefined){
                dadosListagem = data.acoescorretivas;
            }else {
                dadosListagem = data;
            };
            paginarAcaoCorretiva(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
function listagemAcaoPreventiva() {
    $("#listaAcaoPreventiva").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    dadosListagem = [];
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemAcaoPreventiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.acoespreventivas != undefined){
                dadosListagem = data.acoespreventivas;
            }else {
                dadosListagem = data;
            };
            paginarAcaoPreventiva(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
    console.log(dadosListagem);
}
listagemAcaoCorretiva();
function paginar(dados,usepaginacao){
    if ($(".mudaTipoItem.acaoCorretiva").hasClass("ativo")){
        paginarAcaoCorretiva(dados,usepaginacao);
    };
    if ($(".mudaTipoItem.acaoPreventiva").hasClass("ativo")){
        paginarAcaoPreventiva(dados,usepaginacao);
    };
};
function paginarAcaoCorretiva(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listAcaoCorretiva = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listAcaoCorretiva += `
            <div class="item">
            <div class="lista">
            <div class="listItem x3"><span>`+ dados[i].acaocorretiva.nome + `</span></div>
            <div class="listItem x3 xsinvisible"><span>`+ dados[i].acaocorretiva.descricao + `</span></div>
            <div class="listItem x3 xsinvisible"><span>`+ dados[i].acaocorretiva.tempo + `</span></div>
            <div class="buttonItem">
            <a data-id="`+ dados[i].acaocorretiva.id + `" class="edita editACeditar" type="submit"><i class="icon edit"></i></a>
            </div>
            <div class="buttonItem">
            <a class="del" data-id="`+ dados[i].acaocorretiva.id + `" type="submit"><i class="icon trash alternate"></i></a>
            </div>
            </div>
            </div>
            `;
        }
    }else {
        listAcaoCorretiva = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem ações corretivas cadastradas! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaAcaoCorretiva").html(listAcaoCorretiva);
}
function paginarAcaoPreventiva(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listAcaoPreventiva = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listAcaoPreventiva += `
            <div class="item">
            <div class="lista">
            <div class="listItem x3"><span>`+ dados[i].acaopreventiva.nome + `</span></div>
            <div class="listItem x3 xsinvisible"><span>`+ dados[i].acaopreventiva.descricao + `</span></div>
            <div class="listItem x3 xsinvisible"><span>`+ dados[i].acaopreventiva.tempo + `</span></div>
            <div class="buttonItem">
            <a data-id="`+ dados[i].acaopreventiva.id + `" class="edita editACeditar" type="submit"><i class="icon edit"></i></a>
            </div>
            <div class="buttonItem">
            <a class="del" data-id="`+ dados[i].acaopreventiva.id + `" type="submit"><i class="icon trash alternate"></i></a>
            </div>
            </div>
            </div>
            `;
        }
    }else {
        listAcaoPreventiva = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem ações preventivas cadastradas! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaAcaoPreventiva").html(listAcaoPreventiva);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Ações Corretivas</div>
<div class="botaoNovo"><a id="novaAcaoCorretiva">
    <i class="plus square outline icon"></i>Nova ação corretiva
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemAcaoCorretiva();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<div class="seletorTipoItem">
    <a onclick="mudaItemType('acaoCorretiva');listagemAcaoCorretiva();" class="mudaTipoItem acaoCorretiva ativo" type="button" name="button"> Ação corretiva </a>
    <a onclick="mudaItemType('acaoPreventiva');listagemAcaoPreventiva();" class="mudaTipoItem acaoPreventiva" type="button" name="button"> Ação preventiva </a>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem ações corretivas*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x3"></div>
            <div class="listItem x3 xsinvisible"><span>Descrição</span></div>
            <div class="listItem x3 xsinvisible"><span>Tempo</span></div>
            <div class="buttonItem xsinvisible"><span>Editar</span></div>
            <div class="buttonItem xsinvisible"><span>Excluir</span></div>
        </div>
    </div>
    <div class="ocultaTipoItem acaoCorretiva ativo"id="listaAcaoCorretiva"></div>
    <div class="ocultaTipoItem acaoPreventiva" id="listaAcaoPreventiva"></div>
</div>
<? /*fim listagem ações corretivas*/ ?>

<? /*incio nova ação corretiva*/ ?>
<div class="modal novaAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de ações corretivas </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroAcaoCorretiva">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nome" placeholder="Informe o nome" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-checkbox">Ação Preventiva</span>
                        <div class="checkbox">
                            <input type="checkbox" id="preventiva">
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricao" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Tempo para Correção1</span>
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
    var preventiva
    if($("#mudaTipoSelect").val() == "horas"){tempoConvertido = $("#tempo").val();}
    if($("#mudaTipoSelect").val() == "dias"){tempoConvertido = ((parseInt($("#tempo").val()))*24)+":00";}
    if($("#preventiva").is(':checked')){preventiva = 1;}
    var data = {
        "nome": $("#nome").val(),
        "descricao": $("#descricao").val(),
        "tempo": tempoConvertido+":00",
        "preventiva": preventiva
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novaAcaoCorretiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemAcaoCorretiva();
            abreModal('sucessoCadastroAC');
            setTimeout(function () {
                $("#cadastroAcaoCorretiva").trigger("reset");
                fechaModal('sucessoCadastroAC');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim nova ação corretiva*/ ?>

<? /*inicio editar ação corretiva*/ ?>
<div class="modal editaAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Edição de ação corretiva </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editaAcaoCorretiva">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="nomeEditar" placeholder="Informe o nome" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-checkbox">Ação Preventiva</span>
                        <div class="checkbox">
                            <input type="checkbox" id="preventivaEditar">
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricaoEditar" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
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
                                <select id="mudaTipoSelectedit">
                                    <option selected value="horas"> Horas </option>
                                    <option value="dias"> Dias </option>
                                </select>
                                <script>
                                $(document).off("change","#mudaTipoSelectedit").on("change","#mudaTipoSelectedit",function(){
                                    if ($(this).val() == "horas"){$("#descricaotempoedit").prop("type", "time");}
                                    if ($(this).val() == "dias"){$("#descricaotempoedit").prop("type", "number");}
                                });
                                </script>
                            </div>
                            <div class="icone time1">
                                <input id="descricaotempoedit" placeholder="0" type="time" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
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
var tempo = '';
var preventiva;
$(document).off('click', ".editACeditar").on('click', ".editACeditar", function () {
    id = $(this).data('id');
    $("#editaAcaoCorretiva").trigger("reset");
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    }else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAcaoCorretiva/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {                nome = data.acaocorretiva.nome;
                descricao = data.acaocorretiva.descricao;
                tempo = data.acaocorretiva.tempo;
                preventiva = data.acaocorretiva.preventiva;
                $("#nomeEditar").val(nome);
                $("#descricaoEditar").val(descricao);
                if (parseInt(tempo.split(":", 1)) >= 24) {
                    $('#mudaTipoSelectedit option[value=dias]').attr('selected','selected');
                    $("#descricaotempoedit").prop("type", "number");
                    $("#descricaotempoedit").val(parseInt(tempo.split(":", 1))/24);
                }else {
                    $('#mudaTipoSelectedit option[value=horas]').attr('selected','selected');
                    $("#descricaotempoedit").prop("type", "time");
                    $("#descricaotempoedit").val(tempo);

                }
                if(preventiva == 1){$("#preventivaEditar").prop('checked', 'true');}
            },
            error: function(resp){console.log(resp.statusText);}
        });
        abreModal('editaAcaoCorretiva');
    }
});
$(document).off('submit', "#editaAcaoCorretiva").on('submit', "#editaAcaoCorretiva", function (e) {
    e.preventDefault();
    var tempoConvertido = "";
    if($("#mudaTipoSelectedit").val() == "horas"){
        tempoConvertido = $("#descricaotempoedit").val();
        if (tempoConvertido.length == 5) {
            tempoConvertido += ":00";
        }
    }
    if($("#mudaTipoSelectedit").val() == "dias"){
        tempoConvertido = ($("#descricaotempoedit").val()*24)+":00:00";
    }
    if($("#preventivaEditar").is(':checked')){preventiva = 1;}
    else{preventiva = null;}
    var data = {
        "nome": $("#nomeEditar").val(),
        "descricao": $("#descricaoEditar").val(),
        "tempo": tempoConvertido,
        "preventiva": preventiva
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'editarAcaoCorretiva/' + id,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemAcaoCorretiva();
            listagemAcaoPreventiva();
            $(".sucessoEditaAC").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar ação corretiva*/ ?>

<? /*inicio deletar ações corretivas*/ ?>
<div class="modal deletarAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você realmente deseja deletar essa ação corretiva? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="deletarAcaoCorretiva">
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
var id = 0;
var nome = '';
var descricao = '';
$(document).off('click', ".del").on('click', ".del", function () {
    idDelete = $(this).data('id');
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {abreModal('deletarAcaoCorretiva');}
});
$(document).off('submit',"#deletarAcaoCorretiva").on('submit',"#deletarAcaoCorretiva", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarAcaoCorretiva/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            listagemAcaoCorretiva();
            $(".sucessoInativaAC").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar ações corretivas*/ ?>
