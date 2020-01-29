<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemHistorico() {
    $("#listaHistorico").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemAuditorias',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.auditorias != undefined){
                dadosListagem = data.auditorias;
            }else{
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemHistorico();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listHistorico = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            var tipoItem = "";
            var confOuNao = "";
            var Processo = "";
            var Setor = "";
            // var confOuNao = "conforme";
            var confOuNaoIcon = "check";
            if (dados[i].fichas.FichaItensConf.length > 0) {
                tipoItem = "conf";
                for (var j = 0; j < dados[i].fichas.FichaItensConf.length; j++) {
                    if (dados[i].fichas.FichaItensConf[j].ficha.reaudita != null && dados[i].fichas.FichaItensConf[j].ficha.conforme == 1 && confOuNao != "naoconforme") {
                        confOuNao = "reauditado";
                        confOuNaoIcon = "exclamation";
                    }
                    if (dados[i].fichas.FichaItensConf[j].ficha.reaudita == null && dados[i].fichas.FichaItensConf[j].ficha.conforme == 0) {
                        confOuNao = "naoconforme";
                        confOuNaoIcon = "exclamation triangle";
                    }
                    Processo = dados[i].fichas.FichaItensConf[j].itens.processosetores.processo[0].nome;
                    Setor = dados[i].fichas.FichaItensConf[j].itens.processosetores.setor[0].nome;
                }
            }
            if (dados[i].fichas.FichaItensTemp.length > 0) {
                tipoItem = "temp";
                for (var j = 0; j < dados[i].fichas.FichaItensTemp.length; j++) {
                    if (dados[i].fichas.FichaItensTemp[j].ficha.reaudita != null && dados[i].fichas.FichaItensTemp[j].ficha.conforme == 1 && confOuNao != "naoconforme") {
                        confOuNao = "reauditado";
                        confOuNaoIcon = "exclamation";
                    }
                    if (dados[i].fichas.FichaItensTemp[j].ficha.reaudita == null && dados[i].fichas.FichaItensTemp[j].ficha.conforme == 0) {
                        confOuNao = "naoconforme";
                        confOuNaoIcon = "exclamation triangle";
                    }
                    Processo = dados[i].fichas.FichaItensTemp[j].itens.processosetores.processo[0].nome;
                    Setor = dados[i].fichas.FichaItensTemp[j].itens.processosetores.setor[0].nome;
                }
            }
            listHistorico += `
            <div class="item `+confOuNao+`">
            <div class="lista">
            <div class="listItem x3"><span><i class="`+confOuNaoIcon+` icon"></i>`+dados[i].auditoria.created_at+`</span></div>
            <div class="listItem x3 xsinvisible"><span>`+Setor+`</span></div>
            <div class="listItem x3 xsinvisible"><span>`+Processo+`</span></div>
            <div class="buttonItem"><a class="edita verDetalhes" data-tipo="`+tipoItem+`" data-id="`+dados[i].auditoria.id+`"><i class="icon eye"></i></a></div>
            </div>
            </div>
            `;
        }
    }else {
        listHistorico = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem registros cadastrados! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaHistorico").html(listHistorico);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Histórico</div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemHistorico();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onchange="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="date"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem historico*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x3"><span>Data</span></div>
            <div class="listItem x3 xsinvisible"><span>Setor</span></div>
            <div class="listItem x3 xsinvisible"><span>Processo</span></div>
            <div class="buttonItem xsinvisible"><span></span></div>
        </div>
    </div>
    <div id="listaHistorico"></div>
</div>
<? /*fim listagem historico*/ ?>

<? /*inicio ver historico*/ ?>
<div class="modal historico">
    <div class="content-modal">
        <div id="listItensAuditoria"></div>
    </div>
</div>
<script type="text/javascript">
$(document).off("click",".verDetalhes").on("click",".verDetalhes", function () {
    $("#listItensAuditoria").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    var idAuditoria = $(this).data("id");
    var tipoItem = $(this).data("tipo");
    var itens = '';
    if (tipoItem == "temp") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoriaHistoricoTemperatura/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens = `
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
                    <div class="listItem x3">
                    <span class="itemTitulo"> Item </span>
                    </div>
                    <div class="listItem center x3 bgCinza">
                    <span class="itemTitulo"> Temperatura do Painel </span>
                    </div>
                    <div class="listItem center x3">
                    <span class="itemTitulo"> Temperatura Aferida </span>
                    </div>
                    <div class="buttonItem">
                    <span class="itemTitulo"> Mínima </span>
                    </div>
                    <div class="buttonItem">
                    <span class="itemTitulo"> Máxima </span>
                    </div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {
                        var reauditado = "";
                        var confOuNaoIcon = "";
                        if (data.fichasItens[i].ficha.reaudita != null) {
                            reauditado = "reauditado";
                            confOuNaoIcon = "<i class='exclamation icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 0) {
                            reauditado = "naoconforme";
                            confOuNaoIcon = "<i class='exclamation triangle icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 2) {
                            reauditado = "naoaplicavel";
                            confOuNaoIcon = "<i class='close icon'></i>";
                        }
                        itens +=`
                        <div class="item `+reauditado+`">
                        <div class="lista">
                        <div class="listItem x3">
                        <span class="itemTitulo"> `+confOuNaoIcon+data.fichasItens[i].itens[0].nome+` </span>
                        </div>
                        `;
                        if(reauditado == "naoaplicavel"){
                            itens +=`
                            <div class="buttonItem">
                            <span class="itemTitulo"> N/A </span>
                            </div>
                            `;
                        }else{
                            if(data.fichasItens[i].ficha.temperatura_painel == null){
                                itens +=`
                                <div class="listItem x3 center bgCinza">
                                <span class="itemTitulo"> N/A </span>
                                </div>
                                `;
                            }else{
                                itens +=`
                                <div class="listItem center x3">
                                <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_painel+`°C </span>
                                </div>
                                `;
                            }
                            if(data.fichasItens[i].ficha.temperatura_aferida == null){
                                itens +=`
                                <div class="listItem x3 center bgCinza">
                                <span class="itemTitulo"> N/A </span>
                                </div>
                                `;
                            }else{
                                itens +=`
                                <div class="listItem center x3">
                                <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_aferida+`°C </span>
                                </div>
                                `;
                            }
                            itens +=`
                            <div class="buttonItem">
                            <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_minima+`°C </span>
                            </div>
                            <div class="buttonItem">
                            <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_maxima+`°C </span>
                            </div>
                            `;
                        }
                        itens +=`
                        </div>
                        </div>
                        `;
                    }
                }
                itens +=`
                </div>
                </div>
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                </div>
                </div>
                `;
                $("#listItensAuditoria").html(itens);
            },
            error: function(resp){console.log(resp.statusText);}
        });
        abreModal('historico');
    }
    if (tipoItem == "conf") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoriaHistorico/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens +=`
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
                    <div class="listItem xInput">
                    <span> N/A </span>
                    </div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {
                        var reauditado = "";
                        var confOuNaoIcon = "";
                        if (data.fichasItens[i].ficha.reaudita != null) {
                            reauditado = "reauditado";
                            confOuNaoIcon = "<i class='exclamation icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 0) {
                            reauditado = "naoconforme";
                            confOuNaoIcon = "<i class='exclamation triangle icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 2) {
                            reauditado = "naoaplicavel";
                            confOuNaoIcon = "<i class='close icon'></i>";
                        }
                        itens +=`
                        <div class="item `+reauditado+`">
                        <div class="lista">
                        <div class="listItem">
                        <span>`+confOuNaoIcon+data.fichasItens[i].itens[0].nome+` </span>
                        </div>
                        <div class="listItem xInput">
                        <input disabled type="radio" name="`+data.fichasItens[i].ficha.id+`" `; if(data.fichasItens[i].ficha.conforme == 1){itens +=`checked`;} itens +=`>
                        </div>
                        <div class="listItem xInput">
                        <input disabled type="radio" name="`+data.fichasItens[i].ficha.id+`" `; if(data.fichasItens[i].ficha.conforme == 0){itens +=`checked`;} itens +=`>
                        </div>
                        <div class="listItem xInput">
                        <input disabled type="radio" name="`+data.fichasItens[i].ficha.id+`" `; if(data.fichasItens[i].ficha.conforme == 2){itens +=`checked`;} itens +=`>
                        </div>
                        </div>
                        </div>
                        `;
                    }
                    itens +=`
                    </div>
                    </div>
                    `;
                }else {
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
                    <div class="listItem xInput">
                    <span> N/A </span>
                    </div>
                    </div>
                    </div>
                    <div class="item">
                    <div class="lista">
                    <div class="listItem">
                    <span>Sem registro de Itens Auditados</span>
                    </div>
                    <div class="listItem xInput">
                    <input disabled type="radio" class="conforme" name="">
                    </div>
                    <div class="listItem xInput">
                    <input disabled type="radio" class="naoconforme" name="">
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    `;
                }
                itens +=`
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                </div>
                </div>
                `;
                $("#listItensAuditoria").html(itens);
            },
            error: function(resp){console.log(resp.statusText);}
        });
        abreModal('historico');
    }
});
</script>
<? /*fim ver historico*/ ?>
