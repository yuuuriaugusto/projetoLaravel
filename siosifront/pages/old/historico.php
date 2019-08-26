<script type="text/javascript">verificaLogin();</script>

<div class="titulo">
    Histórico
</div>
<div class="filtro">
    <a class="ordenar paginacao"><input title="Itens por Página" id="PaginacaoItens" type="number" min="1" max="99" value="10"></a>
    <a class="ordenar paginacao" id="PaginacaoAnterior" disabled title="Página Anterior"> <i class="icon caret left"></i> </a>
    <span class="ordenar paginacao" id="PaginacaoNumeracao"></span>
    <a class="ordenar paginacao" id="PaginacaoProximo" disabled title="Próxima Página"> <i class="icon caret right"></i> </a>
</div>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem alertIcon">
                <i title="Ordenar por Data" value="Desc" data-ordem="Desc" id="PaginacaoOrdemData" class="paginacaoOrdem icon sort numeric down"></i>
            </div>
            <div class="listItem x3">
                <span>Data</span>
            </div>
            <div class="listItem x3">
                <span>Setor</span>
            </div>
            <div class="listItem x3">
                <span>Processo</span>
            </div>
            <div class="buttonItem">
                <span></span>
            </div>
        </div>
    </div>
    <div id="listAuditoriasUser">
        <div class="item">
            <div class="lista">
                <div class="listItem">
                    <span> Sem registros! </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$.ajax({
    type: 'GET',
    url: urlApi+'listagemAuditorias',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        var tamanhoPagina = 10;
        var pagina = 0;
        var dados = data.auditorias;

        function paginar() {
            if (dados.length > 0) {
                var listAuditorias = "";
                $('#listAuditoriasUser').html("");
                for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
                    var tipoItem = "";
                    var confOuNao = "";
                    var Processo = "";
                    var Setor = "";
                    // var confOuNao = "conforme";
                    var confOuNaoIcon = "check";
                    if (data.auditorias[i].fichas.FichaItensConf.length > 0) {
                        tipoItem = "conf";
                        for (var j = 0; j < data.auditorias[i].fichas.FichaItensConf.length; j++) {
                            if (data.auditorias[i].fichas.FichaItensConf[j].ficha.reaudita != null && data.auditorias[i].fichas.FichaItensConf[j].ficha.conforme == 1 && confOuNao != "naoconforme") {
                                confOuNao = "reauditado";
                                confOuNaoIcon = "exclamation";
                            }
                            if (data.auditorias[i].fichas.FichaItensConf[j].ficha.reaudita == null && data.auditorias[i].fichas.FichaItensConf[j].ficha.conforme == 0) {
                                confOuNao = "naoconforme";
                                confOuNaoIcon = "exclamation triangle";
                            }
                            Processo = data.auditorias[i].fichas.FichaItensConf[j].itens.processosetores.processo[0].nome;
                            Setor = data.auditorias[i].fichas.FichaItensConf[j].itens.processosetores.setor[0].nome;
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
                            Processo = data.auditorias[i].fichas.FichaItensTemp[j].itens.processosetores.processo[0].nome;
                            Setor = data.auditorias[i].fichas.FichaItensTemp[j].itens.processosetores.setor[0].nome;
                        }
                    }
                    listAuditorias = `
                    <div class="item `+confOuNao+`">
                    <div class="lista">
                    <div class="listItem alertIcon">
                    <i class="`+confOuNaoIcon+` icon"></i>
                    </div>
                    <div class="listItem x3">
                    <span>`+dados[i].auditoria.created_at+`</span>
                    </div>
                    <div class="listItem x3">
                    <span>`+Setor+`</span>
                    </div>
                    <div class="listItem x3">
                    <span>`+Processo+`</span>
                    </div>
                    <div class="buttonItem">
                    <a class="edita verDetalhes" data-tipo="`+tipoItem+`" data-id="`+dados[i].auditoria.id+`"><i class="icon eye"></i></a>
                    </div>
                    </div>
                    </div>
                    `;
                    $('#listAuditoriasUser').append(listAuditorias);
                }
                $('#PaginacaoNumeracao').text((pagina+1)+' - '+Math.ceil(dados.length/tamanhoPagina));
            }
        }
        $(function() {
            $('#PaginacaoProximo').click(function() {
                if (pagina < dados.length / tamanhoPagina - 1) {
                    pagina++;
                    paginar();
                }
            });
            $('#PaginacaoAnterior').click(function() {
                if (pagina > 0) {
                    pagina--;
                    paginar();
                }
            });
            $('#PaginacaoItens').change(function() {
                tamanhoPagina = parseInt($(this).val());
                paginar();
            });
            $('#PaginacaoOrdemData').click(function() {
                if ($(this).val() == "Desc") {
                    dados.sort(ordenarPorDataAsc);
                    $(this).val('Asc');
                    $(this).removeClass('up');
                    $(this).addClass('down');
                }else{
                    dados.sort(ordenarPorDataDesc);
                    $(this).val('Desc');
                    $(this).removeClass('down');
                    $(this).addClass('up');
                }
                paginar();
            });
            paginar();
        });
    }
});
</script>
<div class="modal historicoConf">
    <div class="content-modal">
        <div id="listItensAuditoria"></div>
    </div>
</div>
<script type="text/javascript">
$(document).off("click",".verDetalhes").on("click",".verDetalhes", function () {
    $("#listItensAuditoria").html("");
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
                        itens +=`
                        <div class="item `+reauditado+`">
                        <div class="lista">
                        <div class="listItem x3">
                        <span class="itemTitulo"> `+confOuNaoIcon+data.fichasItens[i].itens[0].nome+` </span>
                        </div>
                        <div class="listItem center x3 bgCinza">
                        <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_painel+`°C </span>
                        </div>
                        <div class="listItem center x3">
                        <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_aferida+`°C </span>
                        </div>
                        <div class="buttonItem">
                        <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_minima+`°C </span>
                        </div>
                        <div class="buttonItem">
                        <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_maxima+`°C </span>
                        </div>
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
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
        abreModal('historicoConf');
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
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
        abreModal('historicoConf');
    }
});
</script>
