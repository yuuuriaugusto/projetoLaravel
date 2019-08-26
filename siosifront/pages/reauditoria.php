<script type="text/javascript">verificaLogin();</script>
<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemItensParaReauditoria() {
    $.ajax({
        type: 'GET',
        url: urlApi+'listaItensParaReauditoria',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            dadosListagem = data;
            paginar(dadosListagem,paginacao);
        },
        error: function(){alert("Não foi possivel realizar a operação!");}
    });
}
listagemItensParaReauditoria();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listItensReauditoria = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            if (validarPermissao(dados[i].ncItem.auditoria.id_setors) == true) {
                var tipoItem = "";
                if (dados[i].ncItem.itemNC.id_fichas != null) {tipoItem = "conf";}
                if (dados[i].ncItem.itemNC.id_fichastemperaturas != null) {tipoItem = "temp";}
                listItensReauditoria +=`
                <a class="reauditaritem" data-tipo="`+tipoItem+`" data-idncitem="`+dados[i].ncItem.itemNC.id+`" data-iditem="`+dados[i].ncItem.item.id+`" data-idauditoria="`+dados[i].ncItem.auditoria.id+`">
                <div class="item naoconforme">
                <div class="lista">
                <div class="listItem alertIcon">
                <i class="exclamation triangle icon"></i>
                </div>
                <div class="listItem">
                <span> `+dados[i].ncItem.item.nome+` </span>
                </div>
                <div class="listItem">
                <span> `+dados[i].ncItem.itemNC.prazo+` </span>
                </div>
                </div>
                </div>
                </a>
                `;
            }
        }
    }else {
        listItensReauditoria += `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem registros! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listFichas").html(listItensReauditoria);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Reauditoria</div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Atualizar Listagem" onclick="javascript:listagemItensParaReauditoria();"><i class="redo alternate icon"></i></a>
    <a class="ordenar" title="Listar todos" onclick="javascript:paginar(dadosListagem,paginacao);"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem itens para reauditoria*/ ?>
<div class="listagem hist controle">
    <div class="item">
        <div class="topo">
            <div class="listItem">
                <span> Item </span>
            </div>
            <div class="listItem">
                <span> Tempo para Reauditoria </span>
            </div>
        </div>
    </div>
    <div id="listFichas"></div>
</div>
<? /*fim listagem itens para reauditoria*/ ?>

<? /*inicio modal fazer reauditoria*/ ?>
<div class="modal reauditarItem">
    <div class="content-modal">
        <div id="modalreauditar"></div>
    </div>
</div>
<script type="text/javascript">
var fichas = new Array();
$(document).off("click",".reauditaritem").on("click",".reauditaritem", function () {
    var idAuditoria = $(this).data("idauditoria");
    var idItem = $(this).data("iditem");
    var idNCItem = $(this).data("idncitem");
    var idTipo = $(this).data("tipo");
    var itens = "";
    $("#modalreauditar").html("");
    if (idTipo == "conf") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoria/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens =`
                <div class="titulo-modal">
                <span> `+data.fichasItens[0].ficha.created_at+` </span>
                <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
                </div>
                <div class="form">
                `;
                if (data.fichasItens.length > 0) {
                    itens +=`
                    <div class="conteudo">
                    <div class="listagem hist">
                    <div class="item">
                    <div class="topo">
                    <div class="listItem">
                    <span> Item </span>
                    </div>
                    <div class="listItem xInput">
                    <span> C </span>
                    </div>
                    <div class="listItem xInput">
                    <span> N/C </span>
                    </div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {
                        if (data.fichasItens[i].itens[0].id == idItem) {
                            itens +=`
                            <div class="item" data-id="`+idItem+`">
                            <div class="lista">
                            <div class="listItem">
                            <span> `+data.fichasItens[i].itens[0].nome+` </span>
                            </div>
                            <div class="listItem xInput">
                            <input type="radio" class="inspecao" data-idauditoria="`+idAuditoria+`" data-idficha="`+data.fichasItens[0].ficha.id+`" data-id="`+data.fichasItens[i].itens[0].id+`" name="`+data.fichasItens[i].ficha.id+`" value="1">
                            </div>
                            <div class="listItem xInput">
                            <input type="radio" class="inspecao" data-idauditoria="`+idAuditoria+`" data-idficha="`+data.fichasItens[0].ficha.id+`" data-id="`+data.fichasItens[i].itens[0].id+`" name="`+data.fichasItens[i].ficha.id+`" value="0">
                            </div>
                            </div>
                            </div>
                            `;
                        }
                    }
                    itens +=`
                    </div>
                    </div>
                    `;
                }
                itens +=`
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                <button id="salvarReauditoria" data-ncitemid="`+idNCItem+`" type="submit"><i class="icon save"></i> Salvar </button>
                </div>
                </div>
                </div>
                `;
                $("#modalreauditar").html(itens);
            },
            error: function(){alert("Não foi possivel realizar a operação!");}
        });
    }
    if (idTipo == "temp") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoriaTemperatura/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens =`
                <div class="titulo-modal">
                <span> `+data.fichasItens[0].ficha.created_at+` </span>
                <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
                </div>
                <div class="form">
                `;
                if (data.fichasItens.length > 0) {
                    itens +=`
                    <div class="conteudo">
                    <div class="listagem hist">
                    <div class="item">
                    <div class="topo">
                    <div class="listItem">
                    <span> Item </span>
                    </div>
                    <div class="listItem x4">
                    <span> Temperatura do Painel (°C) </span>
                    </div>
                    <div class="listItem x4">
                    <span> Temperatura Aferida (°C) </span>
                    </div>
                    <div class="listItem x4"></div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {
                        if (data.fichasItens[i].itens[0].id == idItem) {
                            var tmin = data.fichasItens[i].itens[0].temperatura_minima;
                            var tmax = data.fichasItens[i].itens[0].temperatura_maxima;
                            itens +=`
                            <div class="item" data-id="`+idItem+`">
                            <div class="lista">
                            <div class="listItem">
                            <span> `+data.fichasItens[i].itens[0].nome+` </span>
                            </div>
                            <div class="listItem x4">
                            <div class="input-div">
                            <div class="input">
                            <div class="icone">
                            <input class="naoconformeTemp first" data-tMin="`+tmin+`" data-tMax="`+tmax+`" data-id="`+data.fichasItens[i].itens[0].id+`" id="tempPainel`+ data.fichasItens[i].itens[0].id + `" placeholder="Temp. do Painel" type="number" required>
                            <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="listItem x4">
                            <div class="input-div">
                            <div class="input">
                            <div class="icone">
                            <input class="naoconformeTemp" data-tMin="`+tmin+`" data-tMax="`+tmax+`" data-id="`+data.fichasItens[i].itens[0].id+`" id="tempAferida`+ data.fichasItens[i].itens[0].id + `" placeholder="Temp. Aferida" type="number" required>
                            <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="listItem x4"></div>
                            </div>
                            </div>
                            `;
                        }
                    }
                    itens +=`
                    </div>
                    </div>
                    `;
                }
                itens +=`
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                <button id="salvarReauditoriaTemp" data-ncitemid="`+idNCItem+`" type="submit"><i class="icon save"></i> Salvar </button>
                </div>
                </div>
                </div>
                `;
                $("#modalreauditar").html(itens);
            },
            error: function(){alert("Não foi possivel realizar a operação!");}
        });
    }
    abreModal('reauditarItem');
});
$(document).off("click", "#salvarReauditoria").on("click", "#salvarReauditoria", function(){
    var NCItemId = $(this).data("ncitemid");
    var conformidade = 0;
    var validaConformidade = -1;
    var iditem = new Array();
    var datasitens = "";
    $(".inspecao").each(function () {
        if ($(this).is(':checked')) {
            validaConformidade = $(this).val();
            conformidade = {
                "iditem": $(this).data("id"),
                "idficha": $(this).data("idficha"),
                "idauditoria": $(this).data("idauditoria"),
                "conforme": $(this).val(),
                "idncitem": NCItemId,
            }
            iditem.push(conformidade);
        }
    });
    datasitens = {
        "itens": iditem
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'reauditarFicha/'+NCItemId,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: datasitens,
        success: function (data) {
            listagemItensParaReauditoria();
            $(".reauditoriaRealizada").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){alert("Não foi possivel realizar a operação!");}
    });
});
$(document).off("click", "#salvarReauditoriaTemp").on("click", "#salvarReauditoriaTemp", function(){
    var NCItemId = $(this).data("ncitemid");
    var validaConformidade = -1;
    var valorAferid = 0;
    var valorPainel = 0;
    $(".naoconformeTemp.first").each(function(){
        valorPainel = $("#tempPainel"+$(this).data("id")).val();
        valorAferid = $("#tempAferida"+$(this).data("id")).val();
        var valorMinima = $("#tempPainel"+$(this).data("id")).data("tmin");
        var valorMaxima = $("#tempPainel"+$(this).data("id")).data("tmax");
        if (typeof(valorPainel) != NaN || typeof(valorAferid) != NaN) {
            if ((valorPainel < valorMinima || valorPainel > valorMaxima) || (valorAferid < valorMinima || valorAferid > valorMaxima)) {
                validaConformidade = 0;
            }else {
                validaConformidade = 1;
            }
        }
    });
    $.ajax({
        type: 'POST',
        url: urlApi+'reauditarFichasTemperatura/'+NCItemId,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: {"validaConf": validaConformidade,"valorAferid":valorAferid,"valorPainel":valorPainel},
        success: function (data) {
            listagemItensParaReauditoria();
            $(".reauditoriaRealizada").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){alert("Não foi possivel realizar a operação!");}
    });
});
</script>
<? /*fim modal fazer reauditoria*/ ?>
