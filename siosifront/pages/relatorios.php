<script type="text/javascript">verificaLogin();</script>

<div class="titulo">Relatórios</div>

<? /*inicio filtro busca*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem"><span> Processo </span></div>
            <div class="listItem"><span> Período </span></div>
            <div class="listItem"><span> Tipo </span></div>
            <div class="buttonItem"> Filtrar </div>
            <div class="buttonItem"> PDF </div>
        </div>
    </div>
    <div class="item">
        <div class="lista">
            <div class="listItem">
                <div class="input-div"><div class="input"><div class="icone">
                    <select id="processo">
                        <option selected disabled> Selecione um Processo </option>
                    </select>
                </div></div></div>
            </div>
            <div class="listItem"><div class="input-div"><div class="input"><div class="icone">
                <select id="periodo">
                    <option selected disabled> Período </option>
                    <option value="hora"> Última hora </option>
                    <option value="dia"> Diário </option>
                    <option value="semana"> Semanal </option>
                    <option value="mes"> Mensal </option>
                    <option value="ano"> Anual </option>
                </select>
            </div></div></div></div>
            <div class="listItem"><div class="input-div"><div class="input"><div class="icone">
                <select id="tipo">
                    <option selected disabled> Relatório de </option>
                    <option value="conf"> Conformidade </option>
                    <option value="temp"> Temperatura </option>
                </select>
            </div></div></div></div>
            <div class="buttonItem"><a id="filtrarPDF" class="edita" title="Filtrar tabela" type="submit"><i class="filter icon"></i></a></div>
            <div class="buttonItem"><a id="imprimirPDF" class="edita" title="Impressão PDF" type="submit"><i class="print icon"></i></a></div>
        </div>
    </div>
</div>
<? /*fim filtro busca*/ ?>

<? /*inicio listagem select processos*/ ?>
<script type="text/javascript">
$.ajax({
    type: 'GET',
    url: urlApi+'listaSelectProcessos',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        var listaSelectProcessos = "";
        listaSelectProcessos += `
        <option selected disabled> Selecione um Processo </option>
        `;
        if (data.processos != undefined) {
            for (i in data.processos) {
                if(!data.processos[i].processo.produtor){
                    listaSelectProcessos += `
                    <option value="`+data.processos[i].processo.id+`">`+data.processos[i].processo.nome+`</option>
                    `;
                }
            };
        }else {
            listaSelectProcessos += `
            <option disabled>Sem processos cadastrados!</option>
            `;
        };
        $("#processo").html(listaSelectProcessos);
    },
    error: function(resp){console.log(resp.statusText);}
});
</script>
<? /*fim listagem select processos*/ ?>


<? /*inicio listagem resultado busca*/ ?>
<div id="listaResultado"></div>
<? /*fim listagem resultado busca*/ ?>

<script type="text/javascript">
$(document).off("click","#imprimirPDF").on("click","#imprimirPDF", function () {
    var processo = $("#processo").val();
    var periodo = $("#periodo").val();
    var tipo = $("#tipo").val();
    if (processo != null && periodo != null && tipo != null) {
        $("#listaResultado").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
        var dataBusca = {
            "data": periodo,
            "processo": processo,
            "tipo": tipo
        };
        $.ajax({
            type: 'GET',
            url: urlApi+'filtraDadosPDF',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: dataBusca,
            success: function (dataResultado) {
                if (dataResultado.auditorias != undefined) {
                    var bodyHtml = "";
                    for (var i = 0; i < dataResultado.auditorias.length; i++) {
                        var dataCriacao = new Date(dataResultado.auditorias[i].auditoria.created_at);
                        var dataDia = dataCriacao.getDate();
                        var dataMes = dataCriacao.getMonth()+1;
                        var dataAno = dataCriacao.getFullYear();
                        var dataHora = dataCriacao.getHours();
                        var dataMinutos = dataCriacao.getMinutes();
                        var dataSegundos = dataCriacao.getSeconds();
                        if (dataDia < 10) {dataDia = "0"+dataDia;};
                        if (dataMes < 10) {dataMes = "0"+dataMes;};
                        if (dataAno < 10) {dataAno = "0"+dataAno;};
                        if (dataHora < 10) {dataHora = "0"+dataHora;};
                        if (dataMinutos < 10) {dataMinutos = "0"+dataMinutos;};
                        if (dataSegundos < 10) {dataSegundos = "0"+dataSegundos;};
                        bodyHtml += `
                        <div style="border-top:3px solid #4dc168;">
                            <div style="padding:5px;width:100%;display:table;background-color: #ededed;">
                                <div style="float:left;width:50%;">
                                    <span style="font-weight:bold;">
                                        Setor:
                                    </span>
                                    `+dataResultado.auditorias[i].setor.nome+`
                                </div>
                                <div style="float:left;width:30%;text-align:right;">
                                    <span style="font-weight:bold;">
                                        Data Audição:
                                    </span>
                                    `+dataDia+`/`+dataMes+`/`+dataAno+`
                                </div>
                                <div style="float:left;width:20%;text-align:right;">
                                    <span style="font-weight:bold;">
                                        Hora:
                                    </span>
                                    `+dataHora+`:`+dataMinutos+`
                                </div>
                            </div>
                            <div style="padding:5px;width:100%;display:table;">
                                <div style="float:left;width:33%;">
                                    <span style="font-weight:bold;padding:5px;">
                                        Auditor:
                                    </span>
                                    `+dataResultado.auditorias[i].usuario.nome+`
                                </div>
                                <div style="float:left;width:33%;">
                                    <span style="font-weight:bold;padding:5px;">
                                        Fone:
                                    </span>
                                    `+dataResultado.auditorias[i].usuario.telefone+`
                                </div>
                                <div style="float:left;width:33%;">
                                    <span style="font-weight:bold;padding:5px;">
                                        E-mail:
                                    </span>
                                    `+dataResultado.auditorias[i].usuario.email+`
                                </div>
                            </div>
                            <div style="padding:5px;width:100%;display:table;background-color: #ededed;">
                                <div style="float:left;width:10%;text-align:center;">
                                    <span style="font-weight:bold;">
                                        Status
                                    </span>
                                </div>
                                <div style="float:left;width:50%;border-left:1px solid #7f7f7f;padding-left:10px;">
                                    <span style="font-weight:bold;">
                                        Item
                                    </span>
                                </div>
                                `;
                                if(tipo == "temp"){
                                    bodyHtml +=`
                                    <div style="float:left;width:20%;text-align:center;padding-left:10px;">
                                        <span style="font-weight:bold;">
                                            Painel
                                        </span>
                                    </div>
                                    <div style="float:left;width:calc(20% - 21);text-align:center;padding-left:10px;">
                                        <span style="font-weight:bold;">
                                            Aferida
                                        </span>
                                    </div>
                                    `;
                                };
                                bodyHtml +=`
                            </div>
                            <div style="padding:5px;width:100%;display:table;border-top:1px solid #7f7f7f;">
                            `;
                            var auxIdPrev = 0;
                            for (var j = 0; j < dataResultado.auditorias[i].fichas.length; j++) {
                                for (var k = 0; k < dataResultado.auditorias[i].fichas[j].item.length; k++) {
                                    if (auxIdPrev != dataResultado.auditorias[i].fichas[j].ficha.id && auxIdPrev != 0) {
                                        bodyHtml +=`
                                        </div>
                                        <div style="padding:5px;width:100%;display:table;border-top:1px solid #7f7f7f;">
                                        `;
                                    };
                                    auxIdPrev = dataResultado.auditorias[i].fichas[j].ficha.reaudita;
                                    var statusCont = "";
                                    if (dataResultado.auditorias[i].fichas[j].ficha.reaudita == null || dataResultado.auditorias[i].fichas[j].ficha.reaudita != 0) {
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 1) {statusCont = "C";};
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 0) {statusCont = "NC";};
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 2) {statusCont = "NA";};
                                    }else {
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 1) {statusCont = "C R";};
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 0) {statusCont = "NC R";};
                                        if (dataResultado.auditorias[i].fichas[j].ficha.conforme == 2) {statusCont = "NA R";};
                                    };
                                    bodyHtml += `
                                        <div style="float:left;width:10%;text-align:center;">
                                            `+statusCont+`
                                        </div>
                                        <div style="float:left;width:50%;border-left:1px solid #7f7f7f;padding-left:10px;">
                                            `+dataResultado.auditorias[i].fichas[j].item[k].nome +`
                                        </div>
                                    `;
                                    if (tipo == "temp"){
                                        if (dataResultado.auditorias[i].fichas[j].ficha.temperatura_painel != undefined) {
                                            bodyHtml +=`
                                            <div style="float:left;width:20%;text-align:center;padding-left:10px;">
                                                <span>
                                                    `+dataResultado.auditorias[i].fichas[j].ficha.temperatura_painel +` °C
                                                </span>
                                            </div>
                                            `;
                                        }else{
                                            bodyHtml +=`
                                            <div style="float:left;width:20%;text-align:center;padding-left:10px;">
                                                <span>
                                                    NA
                                                </span>
                                            </div>
                                            `;
                                        };
                                        if (dataResultado.auditorias[i].fichas[j].ficha.temperatura_aferida != undefined) {
                                            bodyHtml +=`
                                            <div style="float:left;width:calc(20% - 21);text-align:center;padding-left:10px;">
                                                <span>
                                                    `+dataResultado.auditorias[i].fichas[j].ficha.temperatura_aferida +` °C
                                                </span>
                                            </div>
                                            `;
                                        }else{
                                            bodyHtml +=`
                                            <div style="float:left;width:calc(20% - 21);text-align:center;padding-left:10px;">
                                                <span>
                                                    NA
                                                </span>
                                            </div>
                                            `;
                                        };

                                    };
                                    for (var k = 0; k < dataResultado.auditorias[i].fichas[j].ncitem.length; k++) {
                                        bodyHtml += `
                                        </div>
                                        <div style="width:100%;display:table;padding:5px;">
                                            `;
                                            bodyHtml += `
                                            <div style="float:left;width:50%;">
                                                <span style="font-weight:bold;">Responsável: </span>
                                                `+dataResultado.auditorias[i].fichas[j].ncitem[k].funcionario.nome+`
                                            </div>
                                            `;
                                            if (dataResultado.auditorias[i].fichas[j].ncitem[k].naoConformidade.length != 0) {
                                                bodyHtml += `
                                                <div style="float:left;width:50%;">
                                                    <span style="font-weight:bold;">Não Conformidade: </span>
                                                    `+dataResultado.auditorias[i].fichas[j].ncitem[k].naoConformidade.descricao+`
                                                </div>
                                                `;
                                            };
                                            if (dataResultado.auditorias[i].fichas[j].ncitem[k].acaoCorretiva.length != 0) {
                                                bodyHtml += `
                                                <div style="float:right;width:50%;">
                                                    <span style="font-weight:bold;">Ação Corretiva: </span>
                                                    `+dataResultado.auditorias[i].fichas[j].ncitem[k].acaoCorretiva.nome+`
                                                </div>
                                                `;
                                            };
                                            if (dataResultado.auditorias[i].fichas[j].ncitem[k].ncitem.observacoes != null) {
                                                bodyHtml += `
                                                <div style="float:left;width:50%;">
                                                    <span style="font-weight:bold;">Observação: </span>
                                                    `+dataResultado.auditorias[i].fichas[j].ncitem[k].ncitem.observacoes+`
                                                </div>
                                                `;
                                            };
                                            bodyHtml += `
                                        </div>
                                        `;
                                    };
                                    bodyHtml +=`
                                    </div>
                                    `;
                                };
                            };
                            bodyHtml += `
                        </div>
                        `;
                    };
                    var dataHtml = {
                        "header":`
                        <div style="border-top:3px solid #4dc168;">
                            <div style="display:table;width:100%;text-align:center;background-color: #ededed;">
                                <div style="float:left;width:20%;">
                                    <img src="../img/logo-black.png" style="padding:15px;height:50px;width:auto;margin:0px auto;">
                                </div>
                                <div style="float:left;width:60%;padding-top:20px">
                                    `+dataResultado.processo.nome+`
                                </div>
                                <div style="float:left;width:20%;padding-top:20px">
                                    `+dataResultado.processo.documento+`
                                </div>
                            </div>
                            <div style="width:100%;display:table;text-align:center;padding:5px;border-top:1px solid #7f7f7f;">
                                <div style="width:15%;float:left;border-right:1px solid #7f7f7f;">
                                    Legenda
                                </div>
                                <div style="width:20%;float:left;">
                                    C - Conforme
                                </div>
                                <div style="width:22%;float:left;">
                                    NC - Não conforme
                                </div>
                                <div style="width:22%;float:left;">
                                    NA - Não aplicavel
                                </div>
                                <div style="width:20%;float:left;">
                                    R - Reauditado
                                </div>
                            </div>
                        </div>
                        `,
                        "footer":`
                        <div style="width:100%;display:table;">
                            <div style="width:50%;float:left;">
                                <div style="width:75%;border-top:1px solid #000;margin:0px auto;text-align:center;">
                                    Resp. Monitoramento
                                </div>
                            </div>
                            <div style="width:50%;float:left;">
                                <div style="width:75%;border-top:1px solid #000;margin:0px auto;text-align:center;">
                                    Sup. Qualidade
                                </div>
                            </div>
                        </div>
                        `,
                        "body":bodyHtml,
                    };
                    $.ajax({
                        type: 'POST',
                        url: './pdf/mpdfGERAR.php',
                        data: dataHtml,
                        success: function(data2){
                            window.open("pdf/relatorio.pdf", "_blank");
                            $("#listaResultado").html("");
                        },
                        error: function(resp){console.log(resp.statusText);}
                    });                  
                }else{
                    var data2 = `
                    <span class="subtitulo">Dados do relatório</span>
                    <div class="listagem">
                    <div class="item">
                    <div class="lista">
                    <div class="listItem">
                    <span> Nenhum registro encontrado! </span>
                    </div>
                    </div>
                    </div>
                    </div>
                    `;
                    $("#listaResultado").html(data2);
                };
            }
        });
    }else {
        if (processo == null) {$("#processo").addClass("alertBg");}
        if (periodo == null) {$("#periodo").addClass("alertBg");}
        if (tipo == null) {$("#tipo").addClass("alertBg");}
        setTimeout(function () {$(".alertBg").removeClass("alertBg");}, 1000);
    };
});

$(document).off("click","#filtrarPDF").on("click","#filtrarPDF", function () {
    var processo = $("#processo").val();
    var periodo = $("#periodo").val();
    var tipo = $("#tipo").val();
    if (processo != null && periodo != null && tipo != null) {
        $("#listaResultado").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
        var dataBusca = {
            "data": periodo,
            "processo": processo,
            "tipo": tipo
        }
        var listRelatorio = "";
        $("#listaResultado").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
        $.ajax({
            type: 'GET',
            url: urlApi+'filtraDadosPDF',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: dataBusca,
            success: async function (data) {
                listRelatorio =`
                <span class="subtitulo">Dados do relatório</span>
                <div class="listagem">
                `;
                if (data.auditorias != undefined) {
                    listRelatorio +=`
                    <div class="item">
                    <div class="topo">
                    <div class="listItem x4 center"><span><img src="img/logo-black.png"></span></div>
                    <div class="listItem center"><span> `+data.processo.nome+` </span></div>
                    <div class="listItem x4 center"><span> `+data.processo.documento+` </span></div>
                    </div>
                    <div class="item">
                    </div>
                    <div class="lista">
                    <div class="listItem"><span> Legenda</span></div>
                    <div class="listItem"><span> C - Conforme</span></div>
                    <div class="listItem"><span> NC - Não conforme</span></div>
                    <div class="listItem"><span> R - Reauditado</span></div>
                    <div class="listItem"><span> NA - Não Aplicavel</span></div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.auditorias.length; i++) {
                        var dataCriacao = new Date(data.auditorias[i].auditoria.created_at);
                        var dataDia = dataCriacao.getDate();
                        var dataMes = dataCriacao.getMonth()+1;
                        var dataAno = dataCriacao.getFullYear();
                        var dataHora = dataCriacao.getHours();
                        var dataMinutos = dataCriacao.getMinutes();
                        var dataSegundos = dataCriacao.getSeconds();
                        if (dataDia < 10) {dataDia = "0"+dataDia;};
                        if (dataMes < 10) {dataMes = "0"+dataMes;};
                        if (dataAno < 10) {dataAno = "0"+dataAno;};
                        if (dataHora < 10) {dataHora = "0"+dataHora;};
                        if (dataMinutos < 10) {dataMinutos = "0"+dataMinutos;};
                        if (dataSegundos < 10) {dataSegundos = "0"+dataSegundos;};
                        listRelatorio +=`
                        <div class="item bordertop">
                        <div class="topo">
                        <div class="listItem"><span> <a>Setor:</a> `+data.auditorias[i].setor.nome+` </span></div>
                        <div class="listItem x4"><span> <a>Data de audição:</a> `+dataDia+`/`+dataMes+`/`+dataAno+`</span></div>
                        <div class="listItem x4"><span> <a>Hora:</a> `+dataHora+`:`+dataMinutos+`:`+dataSegundos+`</span></div>
                        </div>
                        <div class="lista">
                        <div class="listItem"><span> <a>Auditor:</a> `+data.auditorias[i].usuario.nome+` </span></div>
                        <div class="listItem"><span> <a>Fone:</a> `+data.auditorias[i].usuario.telefone+` </span></div>
                        <div class="listItem"><span> <a>E-mail:</a> `+data.auditorias[i].usuario.email+` </span></div>
                        </div>
                        </div>
                        <div class="item">
                        <div class="topo">
                        <div class="buttonItem"><span> Status </span></div>
                        <div class="listItem x4"><span> Item </span></div>
                        `;
                        if(tipo == "temp"){
                            listRelatorio +=`
                                <div class="buttonItem"><span> Painel </span></div>
                                <div class="buttonItem"><span> Aferida </span></div>
                            `;
                        };
                        listRelatorio +=`
                        <div class="listItem"><span></span></div>
                        </div>
                        </div>
                        <div class="item">
                        `;
                        var auxIdPrev = 0;
                        for (var j = 0; j < data.auditorias[i].fichas.length; j++) {
                            for (var k = 0; k < data.auditorias[i].fichas[j].item.length; k++) {
                                if (auxIdPrev != data.auditorias[i].fichas[j].item[k].id && auxIdPrev != 0) {
                                    listRelatorio +=`
                                    </div>
                                    <div class="item">
                                    `;
                                };
                                auxIdPrev = data.auditorias[i].fichas[j].item[k].id;
                                var statusCont = "";
                                if (data.auditorias[i].fichas[j].ficha.reaudita == null || data.auditorias[i].fichas[j].ficha.reaudita != 0) {
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 1) {statusCont = "C";};
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 0) {statusCont = "NC";};
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 2) {statusCont = "NA";};
                                }else {
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 1) {statusCont = "C R";};
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 0) {statusCont = "NC R";};
                                    if (data.auditorias[i].fichas[j].ficha.conforme == 2) {statusCont = "NA R";};
                                };
                                listRelatorio +=`
                                <div class="lista">
                                <div class="buttonItem"><span> `+statusCont+` </span></div>
                                <div class="listItem x4"><span> `+data.auditorias[i].fichas[j].item[k].nome +` </span></div>
                                `;
                                if (data.auditorias[i].fichas[j].ficha.temperatura_painel != undefined) {
                                    listRelatorio +=`
                                    <div class="buttonItem">
                                    <span>`+data.auditorias[i].fichas[j].ficha.temperatura_painel +` °C</span>
                                    </div>
                                    `;
                                };
                                if (data.auditorias[i].fichas[j].ficha.temperatura_aferida != undefined) {
                                    listRelatorio +=`
                                    <div class="buttonItem">
                                    <span>`+data.auditorias[i].fichas[j].ficha.temperatura_aferida +` °C</span>
                                    </div>
                                    `;
                                };
                                if(data.auditorias[i].fichas[j].ncitem.length > 0){
                                    for (var k = 0; k < data.auditorias[i].fichas[j].ncitem.length; k++) {
                                        listRelatorio +=`
                                        <div class="listItem auto">
                                        <span><a> Responsável: </a>`+data.auditorias[i].fichas[j].ncitem[k].funcionario.nome +`</span>
                                        </div>
                                        `;
                                        if (data.auditorias[i].fichas[j].ncitem[k].naoConformidade.length != 0) {
                                            listRelatorio +=`
                                            <div class="listItem auto">
                                            <span><a> Não conformidade: </a>`+data.auditorias[i].fichas[j].ncitem[k].naoConformidade.nome +`</span>
                                            </div>
                                            `;
                                        };
                                        if (data.auditorias[i].fichas[j].ncitem[k].acaoCorretiva.length != 0) {
                                            listRelatorio +=`
                                            <div class="listItem auto">
                                            <span><a> Ação corretiva: </a>`+data.auditorias[i].fichas[j].ncitem[k].acaoCorretiva.nome +`</span>
                                            </div>
                                            `;
                                        };
                                        if (data.auditorias[i].fichas[j].ncitem[k].ncitem.observacoes != undefined) {
                                            listRelatorio +=`
                                            <div class="listItem auto">
                                            <span><a> Observação: </a>`+data.auditorias[i].fichas[j].ncitem[k].ncitem.observacoes +`</span>
                                            </div>
                                            `;
                                        };
                                        if (data.auditorias[i].fichas[j].ncitem[k].ncitem.id_interdicao != undefined) {
                                            await $.ajax({
                                                type: 'GET',
                                                url: urlApi+'listInterdicao/'+data.auditorias[i].fichas[j].ncitem[k].ncitem.id_interdicao ,
                                                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                                                dataType: 'json',
                                                success: function (dataInterdicao) {
                                                    listRelatorio +=`
                                                    <div class="listItem auto">
                                                    <span><a> Interdição: </a>`+dataInterdicao.interdicao[0].nome +`</span>
                                                    </div>
                                                    `;
                                                },
                                                error: function(resp){console.log(resp.statusText);}
                                            });
                                        };
                                    };
                                }else{
                                    listRelatorio +=`
                                    <div class="listItem"><span></span></div>
                                    `;
                                };
                                listRelatorio +=`
                                </div>
                                `;
                            };
                        };
                        listRelatorio +=`
                        </div>
                        `;
                    };
                }else{
                    listRelatorio += `
                    <div class="item">
                    <div class="lista">
                    <div class="listItem">
                    <span> Nenhum registro encontrado! </span>
                    </div>
                    </div>
                    </div>
                    `;
                };
                listRelatorio +=`
                </div>
                `;
                $("#listaResultado").html(listRelatorio);
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }else {
        if (processo == null) {$("#processo").addClass("alertBg");}
        if (periodo == null) {$("#periodo").addClass("alertBg");}
        if (tipo == null) {$("#tipo").addClass("alertBg");}
        setTimeout(function () {$(".alertBg").removeClass("alertBg");}, 1000);
    };
});

</script>
