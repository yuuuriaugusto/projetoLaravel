<script type="text/javascript">verificaLogin();</script>

<div class="titulo">
    Reauditoria
</div>
<div class="seletorTipoItem">
    <a onclick="mudaItemType('itemConf')" class="mudaTipoItem itemConf ativo" type="button" name="button"> Conformidade </a>
    <a onclick="mudaItemType('itemTemp')" class="mudaTipoItem itemTemp" type="button" name="button"> Temperatura </a>
</div>
<div class="filtro">
    <a class="ordenar" title="Atualizar Listagem" id="reloadReauditoria"><i class="redo alternate icon"></i></a>
    <a class="ordenar" title="Listar todos" id="listAll"><i class="list icon"></i></a>
    <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<script type="text/javascript">
$(document).off("click", "#reloadReauditoria").on("click", "#reloadReauditoria", function () {
    reloadReauditoria();
    reloadReauditoriaTemp();
});
$(document).off("click", "#listAll").on("click", "#listAll", function () {
    $(".busca1").removeClass("off");
});
$(document).off("keypress", "#buscarFiltro").on("keypress", "#buscarFiltro", function (e) {
    if(e.keyCode === 13) {
        event.preventDefault();
    }
    if ($("#buscarFiltro").val() == "") {
        $(".busca1").removeClass("off");
    }else{
        $(".busca1").each(function() {
            if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro").val().toLowerCase())) != -1) {
                $(this).removeClass("off");
            }else{
                $(this).addClass("off");
            }
        });
    }
});
</script>
<div class="listagem hist controle ocultaTipoItem itemConf ativo" id="listFichas"></div>
<div class="listagem hist controle ocultaTipoItem itemTemp" id="listFichasTemperatura"></div>
<script type="text/javascript">
var semItensNC =`
<div class="item">
<div class="lista">
<div class="listItem">
<span> Sem itens para Reauditar! </span>
</div>
</div>
</div>
`;
function reloadReauditoria() {
    $.ajax({
        type: 'GET',
        url: urlApi+'listaItensParaReauditoria',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var temItenNC = 0;
            var listaDeItensNC = "";
            if (data.itensParaReauditar.length > 0) {
                listaDeItensNC =`
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
                `;
                $("#listFichas").html(listaDeItensNC);
                for (var i = 0; i < data.itensParaReauditar.length; i++) {
                    if (data.itensParaReauditar[i][0].itemNC.id_fichas == data.itensParaReauditar[i][0].fichaItem.ficha[0].id) {
                        for (var j = 0; j < data.itensParaReauditar[i][0].fichaItem.itens.length; j++) {
                            if (validarPermissao(data.itensParaReauditar[i][0].fichaItem.auditoria[0].id_setors) == true) {
                                if (data.itensParaReauditar[i][0].fichaItem.ficha[0].id_itens == data.itensParaReauditar[i][0].fichaItem.itens[j].id) {
                                    listaDeItensNC =`
                                    <a class="itemBusca busca1 reauditaritem"  data-nome="`+data.itensParaReauditar[i][0].fichaItem.itens[j].nome+`" data-idncitem="`+data.itensParaReauditar[i][0].itemNC.id+`" data-iditem="`+data.itensParaReauditar[i][0].fichaItem.itens[j].id+`" data-idauditoria="`+data.itensParaReauditar[i][0].fichaItem.ficha[0].id_auditorias+`">
                                    <div class="item naoconforme" data-nome="item`+data.itensParaReauditar[i][0].itemNC.id+`">
                                    <div class="lista">
                                    <div class="listItem alertIcon">
                                    <i class="exclamation triangle icon"></i>
                                    </div>
                                    <div class="listItem">
                                    <span> `+data.itensParaReauditar[i][0].fichaItem.itens[j].nome+` </span>
                                    </div>
                                    <div class="listItem">
                                    <span> `+data.itensParaReauditar[i][0].itemNC.prazo+` </span>
                                    </div>
                                    </div>
                                    </div>
                                    </a>
                                    `;
                                    $("#listFichas").append(listaDeItensNC);
                                }
                            }
                        }
                    }
                }
            }else {
                $("#listFichas").html(semItensNC);
            }
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
}
reloadReauditoria();
</script>
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
    var itens = "";
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
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
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
            $(".item").each(function() {
                if ($(this).data('nome') == "item"+NCItemId) {
                    $(this).hide();
                }
            });
            $(".reauditoriaRealizada").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>


<script type="text/javascript">
function reloadReauditoriaTemp() {
    $.ajax({
        type: 'GET',
        url: urlApi+'listaItensParaReauditoriaTemperatura',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var temItenNC = 0;
            var listaDeItensNCTemp = "";
            if (data.itensParaReauditar.length > 0) {
                listaDeItensNCTemp =`
                <div class="item">
                <div class="topo">
                <div class="listItem">
                <span> Item </span>
                </div>
                <div class="listItem center">
                <span> Temperatura do Painel (°C) </span>
                </div>
                <div class="listItem center">
                <span> Temperatura Aferida (°C) </span>
                </div>
                <div class="listItem center">
                <span> Tempo para Reauditoria </span>
                </div>
                </div>
                </div>
                `;
                $("#listFichasTemperatura").html(listaDeItensNCTemp);
                for (var i = 0; i < data.itensParaReauditar.length; i++) {
                    if (data.itensParaReauditar[i][0].itemNC.id_fichastemperaturas == data.itensParaReauditar[i][0].fichaItem.ficha[0].id) {
                        for (var j = 0; j < data.itensParaReauditar[i][0].fichaItem.itens.length; j++) {
                            if (data.itensParaReauditar[i][0].fichaItem.ficha[0].id_itens == data.itensParaReauditar[i][0].fichaItem.itens[j].id) {
                                listaDeItensNCTemp =`
                                <a class="itemBusca busca1 reauditaritemtemp"  data-nome="`+data.itensParaReauditar[i][0].fichaItem.itens[j].nome+`" data-idncitem="`+data.itensParaReauditar[i][0].itemNC.id+`" data-iditem="`+data.itensParaReauditar[i][0].fichaItem.itens[j].id+`" data-idauditoria="`+data.itensParaReauditar[i][0].fichaItem.ficha[0].id_auditorias+`">
                                <div class="item naoconforme" data-nome="item`+data.itensParaReauditar[i][0].itemNC.id+`">
                                <div class="lista">
                                <div class="listItem alertIcon">
                                <i class="exclamation triangle icon"></i>
                                </div>
                                <div class="listItem">
                                <span> `+data.itensParaReauditar[i][0].fichaItem.itens[j].nome+` </span>
                                </div>
                                <div class="listItem center">
                                <span> `+data.itensParaReauditar[i][0].fichaItem.ficha[0].temperatura_painel+` °C </span>
                                </div>
                                <div class="listItem center">
                                <span> `+data.itensParaReauditar[i][0].fichaItem.ficha[0].temperatura_aferida+` °C </span>
                                </div>
                                <div class="listItem center">
                                <span> `+data.itensParaReauditar[i][0].itemNC.prazo+` </span>
                                </div>
                                </div>
                                </div>
                                </a>
                                `;
                            }
                        }
                    }
                    $("#listFichasTemperatura").append(listaDeItensNCTemp);
                }
            }else {
                $("#listFichasTemperatura").html(semItensNC);
            }
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
}
reloadReauditoriaTemp();
</script>

<div class="modal reauditarItemTemp">
    <div class="content-modal">
        <div id="modalreauditarTemperatura"></div>
    </div>
</div>
<script type="text/javascript">
var fichas = new Array();
$(document).off("click",".reauditaritemtemp").on("click",".reauditaritemtemp", function () {
    var idAuditoria = $(this).data("idauditoria");
    var idItem = $(this).data("iditem");
    var idNCItem = $(this).data("idncitem");
    var itens = "";
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
            $("#modalreauditarTemperatura").html(itens);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
    abreModal('reauditarItemTemp');
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
            $(".item").each(function() {
                if ($(this).data('nome') == "item"+NCItemId) {
                    $(this).hide();
                }
            });
            $(".reauditoriaRealizada").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>
