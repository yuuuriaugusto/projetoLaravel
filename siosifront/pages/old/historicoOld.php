<div class="titulo">
    Histórico
</div>

<div class="seletorTipoItem">
    <a onclick="mudaItemType('itemConf')" class="mudaTipoItem itemConf ativo" type="button" name="button"> Conformidade </a>
    <a onclick="mudaItemType('itemTemp')" class="mudaTipoItem itemTemp" type="button" name="button"> Temperatura </a>
</div>
<div class="listagem-collapse">
    <span class="subtitulo">Processos</span>
    <div class="bloco-lista">
        <div class="ocultaTipoItem itemConf ativo" id="listaHistoricoConf"></div>
        <div class="ocultaTipoItem itemTemp" id="listaHistoricoTemp"></div>
    </div>
</div>
<script type="text/javascript">
$.ajax({
    type: 'GET',
    url: urlApi+'listagemAuditorias',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        var semRegistro =`
        <div class="item-lista">
        <div class="bloco">
        <a class="a">
        <div class="subbloco">
        <div class="nome">
        <span class="paddingSides"> Sem registros! </span>
        </div>
        </div>
        </a>
        </div>
        </div>
        `;
        var temConf = 0;
        var temTemp = 0;
        var mostraConf = 0;
        var mostraTemp = 0;
        var headConf = "";
        var headTemp = "";
        if (data.listagemhistorico.length > 0) {
            for (var i = 0; i < data.listagemhistorico.length; i++) {
                if (data.listagemhistorico[i].setor.length > 0) {
                    for (var j = 0; j < data.listagemhistorico[i].setor.length; j++) {
                        if (data.listagemhistorico[i].setor[j].auditorias.length > 0) {
                            for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++) {
                                if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade.length > 0) {
                                    temConf = 1;
                                    mostraConf = 1;
                                }
                            }
                        }
                    }
                }
                if (mostraConf == 1) {
                    headConf +=`
                    <div class="item-lista accordion hp`+data.listagemhistorico[i].processo.id+`">
                    <div class="bloco">
                    <a class="a" onclick="abreAcordeon('hp`+data.listagemhistorico[i].processo.id+`')">
                    <div class="subbloco">
                    <div class="icone">
                    <i class="dropdown icon"></i>
                    </div>
                    <div class="nome">
                    <span class="paddingSides"> `+data.listagemhistorico[i].processo.nome+` </span>
                    </div>
                    <div class="doc">
                    <i class="paddingSides"><span> `+data.listagemhistorico[i].processo.documento+` </span> </i>
                    </div>
                    </div>
                    </a>
                    </div>
                    <div class="subItem">
                    `;
                    for (var j = 0; j < data.listagemhistorico[i].setor.length; j++) {
                        mostraConf = 0;
                        for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++) {
                            if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade.length > 0) {
                                mostraConf = 1;
                            }
                        }
                        if (mostraConf == 1) {
                            headConf += `
                            <div class="listaItens accordion hs`+data.listagemhistorico[i].setor[j][0].id+`">
                            <div class="block">
                            <a class="line" onclick="abreAcordeon('hs`+data.listagemhistorico[i].setor[j][0].id+`')">
                            <div class="table">
                            <div class="icone">
                            <i class="dropdown icon"></i>
                            </div>
                            <div class="nome">
                            <span> `+data.listagemhistorico[i].setor[j][0].nome+` </span>
                            </div>
                            </div>
                            </a>
                            </div>
                            <div class="threeItem">
                            <div class="listagem hist">
                            `;

                            for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++){
                                var confOuNao = "conforme";
                                var confOuNaoIcon = "check";
                                for (var l = 0; l < data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade.length; l++) {
                                    if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade[l].reaudita != null && data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade[l].conforme == 1 && confOuNao != "naoconforme") {
                                        confOuNao = "reauditado";
                                        confOuNaoIcon = "exclamation";
                                    }
                                    if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade[l].reaudita == null && data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.conformidade[l].conforme == 0) {
                                        confOuNao = "naoconforme";
                                        confOuNaoIcon = "exclamation triangle";
                                    }
                                }
                                headConf += `
                                <a class="historicoFichas" data-tipo="conf" data-id="`+data.listagemhistorico[i].setor[j].auditorias[k][0][0].id+`">
                                <div class="item `+confOuNao+`">
                                <div class="lista">
                                <div class="listItem alertIcon">
                                <i class="`+confOuNaoIcon+` icon"></i>
                                </div>
                                <div class="listItem">
                                <span> `+data.listagemhistorico[i].setor[j].auditorias[k][0][0].created_at+` </span>
                                </div>
                                </div>
                                </div>
                                </a>
                                `;
                            }

                            headConf += `
                            </div>
                            </div>
                            </div>
                            `;
                            mostraConf = 0;
                        }
                    }
                    headConf += `
                    </div>
                    </div>
                    `;
                    mostraConf = 0;
                }
                if (data.listagemhistorico[i].setor.length > 0) {
                    for (var j = 0; j < data.listagemhistorico[i].setor.length; j++) {
                        if (data.listagemhistorico[i].setor[j].auditorias.length > 0) {
                            for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++) {
                                if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura.length > 0) {
                                    temTemp = 1;
                                    mostraTemp = 1;
                                }
                            }
                        }
                    }
                }
                if (mostraTemp == 1) {
                    headTemp +=`
                    <div class="item-lista accordion hp`+data.listagemhistorico[i].processo.id+`">
                    <div class="bloco">
                    <a class="a" onclick="abreAcordeon('hp`+data.listagemhistorico[i].processo.id+`')">
                    <div class="subbloco">
                    <div class="icone">
                    <i class="dropdown icon"></i>
                    </div>
                    <div class="nome">
                    <span class="paddingSides"> `+data.listagemhistorico[i].processo.nome+` </span>
                    </div>
                    <div class="doc">
                    <i class="paddingSides"><span> `+data.listagemhistorico[i].processo.documento+` </span> </i>
                    </div>
                    </div>
                    </a>
                    </div>
                    <div class="subItem">
                    `;
                    for (var j = 0; j < data.listagemhistorico[i].setor.length; j++) {
                        mostraTemp = 0;
                        for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++) {
                            if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura.length > 0) {
                                mostraTemp = 1;
                            }
                        }
                        if (mostraTemp == 1) {
                            headTemp += `
                            <div class="listaItens accordion hs`+data.listagemhistorico[i].setor[j][0].id+`">
                            <div class="block">
                            <a class="line" onclick="abreAcordeon('hs`+data.listagemhistorico[i].setor[j][0].id+`')">
                            <div class="table">
                            <div class="icone">
                            <i class="dropdown icon"></i>
                            </div>
                            <div class="nome">
                            <span> `+data.listagemhistorico[i].setor[j][0].nome+` </span>
                            </div>
                            </div>
                            </a>
                            </div>
                            <div class="threeItem">
                            <div class="listagem hist">
                            `;

                            for (var k = 0; k < data.listagemhistorico[i].setor[j].auditorias.length; k++){
                                var confOuNao = "conforme";
                                var confOuNaoIcon = "check";
                                for (var l = 0; l < data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura.length; l++) {
                                    if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura[l].reaudita != null && data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura[l].conforme == 1 && confOuNao != "naoconforme") {
                                        confOuNao = "reauditado";
                                        confOuNaoIcon = "exclamation";
                                    }
                                    if (data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura[l].reaudita == null && data.listagemhistorico[i].setor[j].auditorias[k][0].fichas.temperatura[l].conforme == 0) {
                                        confOuNao = "naoconforme";
                                        confOuNaoIcon = "exclamation triangle";
                                    }
                                }
                                headTemp += `
                                <a class="historicoFichas" data-tipo="temp" data-id="`+data.listagemhistorico[i].setor[j].auditorias[k][0][0].id+`">
                                <div class="item `+confOuNao+`">
                                <div class="lista">
                                <div class="listItem alertIcon">
                                <i class="`+confOuNaoIcon+` icon"></i>
                                </div>
                                <div class="listItem">
                                <span> `+data.listagemhistorico[i].setor[j].auditorias[k][0][0].created_at+` </span>
                                </div>
                                </div>
                                </div>
                                </a>
                                `;
                            }

                            headTemp += `
                            </div>
                            </div>
                            </div>
                            `;
                            mostraTemp = 0;
                        }
                    }
                    headTemp += `
                    </div>
                    </div>
                    `;
                    mostraTemp = 0;
                }
            }
        }
        if (validarPermissao('ver') == true) {
            $("#listaHistoricoConf").append(headConf);
            $("#listaHistoricoTemp").append(headTemp);
        }else {
            var semPermissao = `
            <div class="item-lista">
            <div class="bloco">
            <a class="a">
            <div class="subbloco">
            <div class="nome">
            <span class="paddingSides"> Sem permissão! </span>
            </div>
            </div>
            </a>
            </div>
            </div>
            `;
            $("#listaHistoricoConf").append(semPermissao);
            $("#listaHistoricoTemp").append(semPermissao);
        }
        if(temConf == 0){
            $("#listaHistoricoConf").append(semRegistro);
        }
        if(temTemp == 0){
            $("#listaHistoricoTemp").append(semRegistro);
        }
    },
    error: function(){
        alert("Não foi possivel realizar a operação!");
    }
});
</script>
<div class="modal historicoConf">
    <div class="content-modal">
        <div id="listItensAuditoria"></div>
    </div>
</div>
<div class="modal historicoTemp">
    <div class="content-modal">
        <div id="listItensAuditoria"></div>
    </div>
</div>
<script type="text/javascript">
$(document).off("click",".historicoFichas").on("click",".historicoFichas", function () {
    var idAuditoria = $(this).data("id");
    var tipoItem = $(this).data("tipo");
    var itens = '';
    if (validarPermissao('ver') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 5000);
    } else {
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
    }
});
</script>
