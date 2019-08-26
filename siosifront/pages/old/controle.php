<script type="text/javascript">verificaLogin();</script>

<div class="titulo">
    Controle
</div>
<div class="seletorTipoItem">
    <a onclick="mudaItemType('itemConf')" class="mudaTipoItem itemConf ativo" type="button" name="button"> Conformidade </a>
    <a onclick="mudaItemType('itemTemp')" class="mudaTipoItem itemTemp" type="button" name="button"> Temperatura </a>
</div>
<div class="listagem-collapse">
    <span class="subtitulo">Processos</span>
    <div class="bloco-lista">
        <div class="ocultaTipoItem itemConf ativo" id="listaProcessosConf"></div>
        <div class="ocultaTipoItem itemTemp" id="listaProcessosTemp"></div>
    </div>
</div>
<script type="text/javascript">
var listConf = "";
var listTemp = "";
$.ajax({
    type: 'GET',
    url: urlApi+'listagemProcessos',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        var semPermissao = `
        <div class="item-lista">
        <div class="bloco">
        <a class="a">
        <div class="subbloco">
        <div class="nome">
        <span class="paddingSides">Sem Permissão para Controle!</span>
        </div>
        </div>
        </a>
        </div>
        </div>
        `;
        var semRegistro = `
        <div class="item-lista">
        <div class="bloco">
        <a class="a">
        <div class="subbloco">
        <div class="nome">
        <span class="paddingSides">Sem registro de Processos!</span>
        </div>
        </div>
        </a>
        </div>
        </div>
        `;
        if (data.listagem.length > 0) {
            var ProcessoPermissaoConf = 0;
            var ProcessoPermissaoTemp = 0;
            for (var i = 0; i < data.listagem.length; i++) {
                var ProcessoContemConf = 0;
                var ProcessoContemTemp = 0;
                for (var j = 0; j < data.listagem[i].setor.length; j++) {
                    if (validarPermissao(data.listagem[i].setor[j][0].id) == true) {
                        if (data.listagem[i].setor[j].item.conformidade.length > 0) {ProcessoContemConf = 1;ProcessoPermissaoConf = 1;}
                        if (data.listagem[i].setor[j].item.temperatura.length > 0) {ProcessoContemTemp = 1;ProcessoPermissaoTemp = 1;}
                    }
                }
                if (ProcessoContemConf == 1) {
                    listConf += `
                    <div class="item-lista accordion controlP`+data.listagem[i].processo.id+ `">
                    <div class="bloco">
                    <a class="a" onclick="abreAcordeon('controlP`+data.listagem[i].processo.id+ `')">
                    <div class="subbloco">
                    <div class="icone">
                    <i class="dropdown icon"></i>
                    </div>
                    <div class="nome">
                    <span class="paddingSides">`+data.listagem[i].processo.nome+ `</span>
                    </div>
                    <div class="doc">
                    <i class="paddingSides"><span>`+ data.listagem[i].processo.documento+`</span> </i>
                    </div>
                    </div>
                    </a>
                    </div>
                    `;
                    for (var j = 0; j < data.listagem[i].setor.length; j++) {
                        var SetorContemConf = 0;
                        if (validarPermissao(data.listagem[i].setor[j][0].id) == true) {
                            if (data.listagem[i].setor[j].item.conformidade.length > 0) {SetorContemConf = 1;}
                        }
                        if (SetorContemConf == 1) {
                            listConf += `
                            <div class="subItem">
                            <div>
                            <div class="listaItens">
                            <div class="block">
                            <a class="line modalControleConf" data-idprocesso="`+data.listagem[i].processo.id+`" data-idsetor="`+data.listagem[i].setor[j][0].id+`">
                            <div class="table">
                            <div class="nome">
                            <span>`+data.listagem[i].setor[j][0].nome+`</span>
                            </div>
                            <div class="icone">
                            <i class="plus icon"></i>
                            </div>
                            </div>
                            </a>
                            </div>
                            </div>
                            </div>
                            </div>
                            `;
                            SetorContemConf = 0;
                        }
                    }
                    listConf += `
                    </div>
                    `;
                    ProcessoContemConf = 0;
                }
                if (ProcessoContemTemp == 1) {
                    listTemp += `
                    <div class="item-lista accordion controlP`+data.listagem[i].processo.id+ `">
                    <div class="bloco">
                    <a class="a" onclick="abreAcordeon('controlP`+data.listagem[i].processo.id+ `')">
                    <div class="subbloco">
                    <div class="icone">
                    <i class="dropdown icon"></i>
                    </div>
                    <div class="nome">
                    <span class="paddingSides">`+data.listagem[i].processo.nome+ `</span>
                    </div>
                    <div class="doc">
                    <i class="paddingSides"><span> `+ data.listagem[i].processo.documento + `</span> </i>
                    </div>
                    </div>
                    </a>
                    </div>
                    `;
                    for (var j = 0; j < data.listagem[i].setor.length; j++) {
                        var SetorContemTemp = 0;
                        if (validarPermissao(data.listagem[i].setor[j][0].id) == true) {
                            if (data.listagem[i].setor[j].item.temperatura.length > 0) {SetorContemTemp = 1;}
                        }
                        if (SetorContemTemp == 1) {
                            listTemp += `
                            <div class="subItem">
                            <div>
                            <div class="listaItens">
                            <div class="block">
                            <a class="line modalControleTemp" data-idprocesso="`+data.listagem[i].processo.id+`" data-idsetor="`+data.listagem[i].setor[j][0].id+`">
                            <div class="table">
                            <div class="nome">
                            <span>`+data.listagem[i].setor[j][0].nome+`</span>
                            </div>
                            <div class="icone">
                            <i class="plus icon"></i>
                            </div>
                            </div>
                            </a>
                            </div>
                            </div>
                            </div>
                            </div>
                            `;
                            SetorContemTemp = 0;
                        }
                    }
                    listTemp += `
                    </div>
                    `;
                    ProcessoContemTemp = 0;
                }
            }
            if (ProcessoPermissaoConf != 1) {
                listConf = semPermissao;
            }
            if (ProcessoPermissaoTemp != 1) {
                listTemp = semPermissao;
            }
            if (listConf == "") {
                listConf = semRegistro;
            }
            if (listTemp == "") {
                listTemp = semRegistro;
            }
        }else{
            listConf = semRegistro;
            listTemp = semRegistro;
        }
        $("#listaProcessosConf").html(listConf);
        $("#listaProcessosTemp").html(listTemp);
    },
    error: function(){
        alert("Não foi possivel realizar a operação!");
    }
});
var idnc = new Array();
</script>
<div class="modal controleConf">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo" id="tituloModal"> </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <div class="form">
            <div class="listagem controle" id="listaModalConf"></div>
            <script type="text/javascript">
            var id = 0;
            var idsetor = 0;
            var itensid = 0;
            $(document).off('click', '.modalControleConf').on("click", ".modalControleConf", function () {
                id = $(this).data("idprocesso");
                idsetor = $(this).data("idsetor");
                var head = '';
                var permiteSetor = 0;
                $.ajax({
                    type: 'GET',
                    url: urlApi+'detalhe/'+idsetor,
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    success: function (data) {
                        $("#tituloModal").html(data.setor.nome);
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: urlApi+'detalheProcesso/'+id,
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    success: function (data) {
                        var validaTerConf = 0;
                        if (typeof (data.listagem[0].setor) != "undefined") {
                            for (var i = 0; i < data.listagem[0].setor.length; i++) {
                                if (data.listagem[0].setor[i].setor.id == idsetor) {
                                    if (validarPermissao(data.listagem[0].setor[i].setor.id) == true) {
                                        if (data.listagem[0].setor[i].item.conformidade.length > 0) {
                                            head += `
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
                                            <div class="listItem x4"></div>
                                            </div>
                                            </div>
                                            `;
                                            for(var j = 0; j < data.listagem[0].setor[i].item.conformidade.length; j++){
                                                head +=`
                                                <div class="item" data-id="`+data.listagem[0].setor[i].item.conformidade[j].id+`">
                                                <div class="lista">
                                                <div class="listItem">
                                                <span> `+data.listagem[0].setor[i].item.conformidade[j].nome+`</span>
                                                </div>
                                                <div class="listItem xInput">
                                                <input type="radio" class="inspecao conforme" data-id="`+data.listagem[0].setor[i].item.conformidade[j].id+`" value="1" name="` + data.listagem[0].setor[i].item.conformidade[j].id + `" >
                                                </div>
                                                <div class="listItem xInput">
                                                <input type="radio" class="inspecao naoconforme" data-id="`+ data.listagem[0].setor[i].item.conformidade[j].id + `" value="0" name="` + data.listagem[0].setor[i].item.conformidade[j].id + `" >
                                                </div>
                                                <div class="listItem x4">
                                                <div class="circular" data-tipo="conf" id="btn`+ data.listagem[0].setor[i].setor.id + data.listagem[0].setor[i].item.conformidade[j].id + `" data-idinput="`+ data.listagem[0].setor[i].item.conformidade[j].id + `">
                                                <a><i class="icon plus"></i></a>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="lista-naoConforme" data-idtr="`+ data.listagem[0].setor[i].item.conformidade[j].id + `"></div>
                                                </div>
                                                `;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $("#listaModalConf").html(head);
                        abreModal('controleConf');
                        idnc = [];
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
            });
            </script>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button id="salvarControleConf" type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal controleTemp">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <div class="form">
            <div class="listagem controle" id="listaModalTemp"></div>
            <script type="text/javascript">
            var id = 0;
            var idsetor = 0;
            var itensid = 0;
            $(document).off('click', '.modalControleTemp').on("click", ".modalControleTemp", function () {
                id = $(this).data("idprocesso");
                idsetor = $(this).data("idsetor");
                var head = '';
                var permiteSetor = 0;
                $.ajax({
                    type: 'GET',
                    url: urlApi+'detalheProcesso/'+id,
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    success: function (data) {
                        if (typeof (data.listagem[0].setor) != "undefined") {
                            for (var i = 0; i < data.listagem[0].setor.length; i++) {
                                if (data.listagem[0].setor[i].setor.id == idsetor) {
                                    if (validarPermissao(data.listagem[0].setor[i].setor.id) == true) {
                                        if(data.listagem[0].setor[i].item.temperatura.length > 0){
                                            head += `
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
                                            for(var j = 0; j < data.listagem[0].setor[i].item.temperatura.length; j++){
                                                var tmin = data.listagem[0].setor[i].item.temperatura[j].temperatura_minima;
                                                var tmax = data.listagem[0].setor[i].item.temperatura[j].temperatura_maxima;
                                                head +=`
                                                <div class="item itemnaoconformeTemp" data-id="`+data.listagem[0].setor[i].item.temperatura[j].id+`">
                                                <div class="lista">
                                                <div class="listItem">
                                                <span> `+ data.listagem[0].setor[i].item.temperatura[j].nome +` </span>
                                                </div>
                                                <div class="listItem x4">
                                                <div class="input-div">
                                                <div class="input">
                                                <div class="icone">
                                                <input class="naoconformeTemp first" data-tMin="`+tmin+`" data-tMax="`+tmax+`" data-id="`+data.listagem[0].setor[i].item.temperatura[j].id+`" placeholder="Temp. do Painel" type="number" required id="tempPainel`+ data.listagem[0].setor[i].item.temperatura[j].id + `">
                                                <div class="bord"></div><i class="asterisk icon"></i>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="listItem x4">
                                                <div class="input-div">
                                                <div class="input">
                                                <div class="icone">
                                                <input class="naoconformeTemp" data-tMin="`+tmin+`" data-tMax="`+tmax+`" data-id="`+data.listagem[0].setor[i].item.temperatura[j].id+`" placeholder="Temp. Aferida" type="number" required id="tempAferida`+ data.listagem[0].setor[i].item.temperatura[j].id + `">
                                                <div class="bord"></div><i class="asterisk icon"></i>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="listItem x4">
                                                <div class="circular" data-tipo="temp" id="btn`+ data.listagem[0].setor[i].setor.id + data.listagem[0].setor[i].item.temperatura[j].id + `" data-idinput="`+ data.listagem[0].setor[i].item.temperatura[j].id + `">
                                                <a><i class="icon plus"></i></a>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="lista-naoConforme" data-idtr="`+ data.listagem[0].setor[i].item.temperatura[j].id + `"></div>
                                                </div>
                                                `;
                                            }
                                        }else{
                                            head += `
                                            <div class="item">
                                            <div class="topo">
                                            <div class="listItem">
                                            <span> Sem itens Cadastrados! </span>
                                            </div>
                                            </div>
                                            </div>
                                            `;
                                        }
                                    }
                                }
                            }
                        }
                        $("#listaModalTemp").html(head);
                        abreModal('controleTemp');
                        idnc = [];
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
            });
            </script>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button id="salvarControleTemp" type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var idnaoconforme = 0;
$(document).off('change', '.naoconformeTemp').on('change', '.naoconformeTemp', function () {
    idnaoconforme = $(this).data("id");
    var validaTemperatura = "conforme";
    var valorPainel = parseInt($("#tempPainel"+idnaoconforme).val());
    var valorAferid = parseInt($("#tempAferida"+idnaoconforme).val());
    var valorMinima = $("#tempPainel"+idnaoconforme).data("tmin");
    var valorMaxima = $("#tempPainel"+idnaoconforme).data("tmax");
    if (typeof(valorPainel) != NaN || typeof(valorAferid) != NaN) {
        if ((valorPainel < valorMinima || valorPainel > valorMaxima) || (valorAferid < valorMinima || valorAferid > valorMaxima)) {
            $('[data-idinput = ' + idnaoconforme + ']').show();
        }else {
            $('[data-idinput = ' + idnaoconforme + ']').hide();
            $('[data-idtr ='+ idnaoconforme +']').html('');
        }
    }

});
$(document).off('click', '.naoconforme').on('click', '.naoconforme', function () {
    if ($(this).is(':checked')) {
        idnaoconforme = $(this).data("id");
        $('[data-idinput = ' + idnaoconforme + ']').show();
    }
});
$(document).off('click', '.conforme').on('click', '.conforme', function () {
    if ($(this).is(':checked')) {
        idnaoconforme = $(this).data("id");
        $('[data-idinput = ' + idnaoconforme + ']').hide();
        $('[data-idtr ='+ idnaoconforme +']').html('');
    }
});
var headNC = "";
var circularnc = 0;
var buttoncircular = 0;
var retornoconformidades = "";
$(document).off('click', '.circular').on('click', '.circular', function () {
    var trbutton ='';
    buttoncircular = $(this).data("idinput");
    circularnc ++;
    headNC ="";
    var tipoItem = "";
    var tipoItemCT = "";
    if ($(this).data("tipo") == "conf") {
        tipoItem = "ncitens";
        tipoItemCT = "conf";
    }else{
        tipoItem = "ncitenstemp";
        tipoItemCT = "temp";
    }
    $.ajax({
        type: 'GET',
        url: urlApi + tipoItem +'/'+ buttoncircular,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            headNC +=`
            <div class="bloco" id="lineNC-`+circularnc+`">
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <select id="item1-`+circularnc+`" data-tipo="`+tipoItemCT+`" class="item1" data-circularnc="`+circularnc+`" data-buttoncircular="`+buttoncircular+`">
            <option disabled selected> Não Conformidade </option>
            `;
            for (var k = 0; k < data.naoConformidadesEAcoesCorretivas.length; k++){
                for (var nc = 0; nc < data.naoConformidadesEAcoesCorretivas[k].nconfatual.length; nc++){
                    headNC +=`
                    <option value="`+data.naoConformidadesEAcoesCorretivas[k].nconfatual[nc].id+ `">`+data.naoConformidadesEAcoesCorretivas[k].nconfatual[nc].nome+ `</option>
                    `;
                }
            }
            headNC +=`
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <select id="item2-`+circularnc+`" data-tipo="`+tipoItemCT+`" class="item2" data-circularnc="`+circularnc+`" data-buttoncircular="`+buttoncircular+`">
            <option value="" disabled selected> Ação Corretiva </option>
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <select id="item4-`+circularnc+`" class="item4">
            <option value="" disabled selected> Funcionario </option>
            `;
            var listFunc = "";
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemFuncionario',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (dataFuncionario) {
                    for (var f = 0; f < dataFuncionario.funcionario.length; f++) {
                        listFunc += `
                        <option value="`+dataFuncionario.funcionario[f].id + `">` + dataFuncionario.funcionario[f].nome + ` </option>
                        `;
                    }
                    $("#item4-"+circularnc).append(listFunc);
                },
                error: function(){
                    alert("Não foi possivel realizar a operação!");
                }
            });
            headNC +=`
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <input id="item3-`+circularnc+`" placeholder="Observação" type="text">
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone time2">
            <select id="mudaTipoSelect" data-countnum="`+circularnc+`">
            <option selected value="horas"> Horas </option>
            <option value="dias"> Dias </option>
            </select>
            `;
            $(document).off("change","#mudaTipoSelect").on("change","#mudaTipoSelect",function(){
                var countnum = $(this).data("countnum");
                if ($(this).val() == "horas"){$("#item5-"+countnum).prop("type", "time");$("#tempo").prop("type", "time");}
                if ($(this).val() == "dias"){$("#item5-"+countnum).prop("type", "number");$("#tempo").prop("type", "number");}
            });
            headNC+=`
            </div>
            <div class="icone time1">
            <input id="item5-`+circularnc+`" placeholder="0" type="time" required>
            <div class="bord"></div>
            <i class="asterisk icon"></i>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="buttonItem">
            <a class="edita" id="salvarNC" data-countnum="`+circularnc+`" data-idsalva="`+buttoncircular+`"><i class="icon save"></i></a>
            </div>
            </div>
            <div class="novaNC-off" id="novaNC-off`+circularnc+`"></div>
            <div class="alertItem" id="alertItem-`+circularnc+`">Preencha todos os campos *</div>
            </div>
            `;
            $('[data-idtr = ' + buttoncircular + ']').append(headNC);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
$(document).off("change",".item1").on("change",".item1", function () {
    var listOptions = "";
    var buttoncircular = $(this).data("buttoncircular");
    var circularnc = $(this).data("circularnc");
    var idNCselecionada = $(this).val();
    if ($(this).data("tipo") == "conf") {
        tipoItem = "ncitens";
    }else{
        tipoItem = "ncitenstemp";
    }
    $.ajax({
        type: 'GET',
        url: urlApi + tipoItem +'/'+ buttoncircular,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data2) {
            listOptions += `
            <option value="" disabled selected> Ação Corretiva </option>
            `;
            for (var i = 0; i < data2.naoConformidadesEAcoesCorretivas.length; i++) {
                for (var j = 0; j < data2.naoConformidadesEAcoesCorretivas[i].nconfatual.length; j++) {
                    if (data2.naoConformidadesEAcoesCorretivas[i].nconfatual[j].id == idNCselecionada) {
                        for (var k = 0; k < data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas.length; k++) {
                            listOptions += `
                            <option value="`+data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].id+`"> `+data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].nome+` </option>
                            `;
                        }
                        $("#item2-"+circularnc).html(listOptions);
                        $("#item5-"+circularnc).val(null);
                    }
                }
            }
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
$(document).off("change",".item2").on("change",".item2", function () {
    var listTempo = "";
    var buttoncircular = $(this).data("buttoncircular");
    var circularnc = $(this).data("circularnc");
    var idACselecionada = $(this).val();
    if ($(this).data("tipo") == "conf") {
        tipoItem = "ncitens";
    }else{
        tipoItem = "ncitenstemp";
    }
    $.ajax({
        type: 'GET',
        url: urlApi + tipoItem +'/'+ buttoncircular,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data3) {
            for (var i = 0; i < data3.naoConformidadesEAcoesCorretivas.length; i++) {
                for (var j = 0; j < data3.naoConformidadesEAcoesCorretivas[i].nconfatual.length; j++) {
                    for (var k = 0; k < data3.naoConformidadesEAcoesCorretivas[i].acoescorretivas.length; k++) {
                        if (data3.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].id == idACselecionada) {
                            listTempo = data3.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].tempo;
                            if (parseInt(listTempo.split(":", 1)) >= 24) {
                                $('[data-countnum="'+circularnc+'"] option[value=horas]').attr('selected',false);
                                $('[data-countnum="'+circularnc+'"] option[value=dias]').attr('selected',true);
                                $("#item5-"+circularnc).prop("type", "number");
                                $("#item5-"+circularnc).val(parseInt(listTempo.split(":", 1))/24);
                            }else {
                                $('[data-countnum="'+circularnc+'"] option[value=dias]').attr('selected',false);
                                $('[data-countnum="'+circularnc+'"] option[value=horas]').attr('selected',true);
                                $("#item5-"+circularnc).prop("type", "time");
                                $("#item5-"+circularnc).val(listTempo);
                            }
                        }
                    }
                }
            }
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
var salvarnaoc = 0;
$(document).off('click', '#salvarNC').on("click", "#salvarNC", function () {
    var nc = "";
    var buttoniditem = '';
    salvarnaoc++;
    buttoniditem = $(this).data("idsalva");
    itemcountnum = $(this).data("countnum");
    if ($('#item1-'+itemcountnum).val() != null && $('#item2-'+itemcountnum).val() != null && $('#item4-'+itemcountnum).val() != null) {
        var dataPrazo = "";
        if($("#mudaTipoSelect").val() == "horas"){
            dataPrazo = $('#item5-'+itemcountnum).val();
            if (dataPrazo.length < 8) {
                dataPrazo += ":00";
            }
        }
        if($("#mudaTipoSelect").val() == "dias"){
            dataPrazo = (parseInt($('#item5-'+itemcountnum).val())*24)+":00:00";
        }
        nc = {
            "iditem":buttoniditem,
            "id": $('#item1-'+itemcountnum).val(),
            "id_acaocorretivaitens": $('#item2-'+itemcountnum).val(),
            "observacoes":$('#item3-'+itemcountnum).val(),
            "id_funcionarios":$('#item4-'+itemcountnum).val(),
            "prazo": dataPrazo
        }
        $("#alertItem-"+itemcountnum).fadeOut();
        $("#lineNC-"+itemcountnum).removeClass("alertBg");
        $("#novaNC-off"+itemcountnum).addClass("on");
        idnc.push(nc);
    }else{
        $("#alertItem-"+itemcountnum).fadeOut();
        $("#alertItem-"+itemcountnum).fadeIn();
        $("#lineNC-"+itemcountnum).addClass("alertBg");
        setTimeout(function () {
            $("#lineNC-"+itemcountnum).removeClass("alertBg");
        }, 1000);
    }
});
$(document).off('click', "#salvarControleConf").on('click', "#salvarControleConf", function () {
    var datasitens = '';
    var idItem = 0;
    var iditem = new Array();
    var conformidade = 0;
    var novonc = new Array();
    var conterNC = 0;
    var verificaNCvazia = 0;
    var realizaControle = 0;
    $(".inspecao").each(function () {
        if ($(this).is(':checked')) {
            if($(this).val() == 0){
                conterNC = 1;
                for(var nc = 0; nc < idnc.length; nc++){
                    if(idnc[nc].iditem == $(this).data("id")){
                        novonc.push(idnc[nc]);
                    }
                }
                conformidade = {
                    "id": $(this).data("id"),
                    "con": $(this).val(),
                    "naoconformidades": novonc
                }
                if (novonc == "") {
                    verificaNCvazia = 1;
                    if ($(this).is(':checked')) {
                        if($(this).val() == 0){
                            $('.item[data-id='+idItem+']').addClass("alertBg");
                            setTimeout(function () {
                                $(".alertBg").removeClass("alertBg");
                            }, 1000);
                        }
                    }
                }
            }else{
                conformidade = {
                    "id": $(this).data("id"),
                    "con": $(this).val()
                }
            }
            iditem.push(conformidade);
            novonc = [];
        }
    });
    datasitens = {
        "itens": iditem
    };
    if (conterNC == 1) {
        if (verificaNCvazia != 1) {
            realizaControle = 1;
        }else{
            $(".inspecao").each(function () {
                idItem = $(this).data("id");
                if (!$(this).is(':checked') && $(this).val() != 0) {
                    $('.item[data-id='+idItem+']').addClass("alertBg");
                    setTimeout(function () {
                        $(".alertBg").removeClass("alertBg");
                    }, 1000);
                }
            });
        }
    }else{
        if (conformidade != 0) {
            realizaControle = 1
        }else {
            $(".inspecao").each(function () {
                idItem = $(this).data("id");
                if (!$(this).is(':checked')) {
                    $('.item[data-id='+idItem+']').addClass("alertBg");
                    setTimeout(function () {
                        $(".alertBg").removeClass("alertBg");
                    }, 1000);
                }
            });
        }
    }
    if (realizaControle == 1) {
        $.ajax({
            type: 'POST',
            url: urlApi+'novaAuditoria/'+id+"/"+idsetor,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datasitens,
            success: function (data) {
                datasitens = "";
                idItem = 0;
                iditem = [];
                conformidade = "";
                novonc = [];
                conterNC = 0;
                verificaNCvazia = 0;
                realizaControle = 0;
                idnc = [];
                abreModal('controleSalvo');
                setTimeout(function () {
                    fechaModal();
                }, 1500);
            },
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
    }
});
$(document).off('click', "#salvarControleTemp").on('click', "#salvarControleTemp", function () {
    var datasitens = '';
    var iditem = new Array();
    var conformidade = 0;
    var realizaControle = 0;
    var tryControle = 0;
    var novonc = new Array();
    var foreachCont = 0;
    var conterNC = 0;
    $(".naoconformeTemp.first").each(function(){
        var idItem = $(this).data("id");
        var valorPainel = $("#tempPainel"+idItem).val();
        var valorAferid = $("#tempAferida"+idItem).val();
        foreachCont += 1;
        var valorMinima = parseInt($("#tempPainel"+idnaoconforme).data("tmin"));
        var valorMaxima = parseInt($("#tempPainel"+idnaoconforme).data("tmax"));
        if (valorPainel != "" || valorAferid != "") {
            if ((parseInt(valorPainel) < valorMinima || parseInt(valorPainel) > valorMaxima) || (parseInt(valorAferid) < valorMinima || parseInt(valorAferid) > valorMaxima)) {
                // nao conforme
                conterNC = 1;
                for(var nc = 0; nc < idnc.length; nc++){
                    if(idnc[nc].iditem == idItem){
                        novonc.push(idnc[nc]);
                    }
                }
                if (novonc != "") {
                    conformidade = {
                        "id": idItem,
                        "con": '0',
                        "tempPainel": valorPainel,
                        "tempAferida": valorAferid,
                        "naoconformidades": novonc
                    }
                }
            }else {
                // conforme
                conformidade = {
                    "id": idItem,
                    "con": '1',
                    "tempPainel": valorPainel,
                    "tempAferida": valorAferid,
                }
            }
            iditem.push(conformidade);
            datasitens = {
                "itens": iditem
            };
        }
        if (conterNC == 1) {
            if ((parseInt(valorPainel) < valorMinima || parseInt(valorPainel) > valorMaxima) || (parseInt(valorAferid) < valorMinima || parseInt(valorAferid) > valorMaxima)) {
                if (novonc != "") {
                    realizaControle = 1;
                }else {
                    tryControle = 1;
                    $('.item[data-id='+idItem+']').addClass("alertBg");
                    setTimeout(function () {
                        $(".alertBg").removeClass("alertBg");
                    }, 1000);
                }
            }
        }else {
            if (conformidade != 0) {
                realizaControle = 1;
            }else {
                $('.item[data-id='+idItem+']').addClass("alertBg");
                setTimeout(function () {
                    $(".alertBg").removeClass("alertBg");
                }, 1000);
            }
        }
        novonc = [];
        if (foreachCont == $(".naoconformeTemp.first").length) {
            if (realizaControle == 1 && tryControle == 0) {
                $.ajax({
                    type: 'POST',
                    url: urlApi+'novaAuditoriaTemperatura/'+id+"/"+idsetor,
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    data: datasitens,
                    success: function (data) {
                        abreModal('controleSalvo');
                        setTimeout(function () {
                            fechaModal();
                        }, 1500);
                        idnc = [];
                        conformidade = 0;
                        realizaControle = 0;
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
            }
        }
    });
});
</script>
