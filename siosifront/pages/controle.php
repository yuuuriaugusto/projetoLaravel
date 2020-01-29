<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemControleConf() {
    $("#listaControleConf").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    dadosListagem = [];
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemProcessos',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if (data.listagem.length > 0) {
                for (i in data.listagem) {
                    if(!data.listagem[i].processo.produtor){
                        if (data.listagem[i].setores.length > 0) {
                            if (validarPermissao(data.listagem[i].setores[0].setor.id) == true) {
                                for (var j = 0; j < data.listagem[i].setores.length; j++) {
                                    if (data.listagem[i].setores[j].item.conformidade.length > 0) {
                                        j = data.listagem[i].setores.length;
                                        dadosListagem.push({"processo":data.listagem[i].processo, "setores":data.listagem[i].setores});
                                    }
                                }
                            }
                        }
                    }
                }
            }
            paginarConf(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
function listagemControleTemp() {
    $("#listaControleTemp").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    dadosListagem = [];
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemProcessos',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if (data.listagem.length > 0) {
                for (i in data.listagem) {
                    if(!data.listagem[i].processo.produtor){
                        if (data.listagem[i].setores.length > 0) {
                            if (validarPermissao(data.listagem[i].setores[0].setor.id) == true) {
                                for (var j = 0; j < data.listagem[i].setores.length; j++) {
                                    if (data.listagem[i].setores[j].item.temperatura.length > 0) {
                                        j = data.listagem[i].setores.length;
                                        dadosListagem.push({"processo":data.listagem[i].processo, "setores":data.listagem[i].setores});
                                    }
                                }
                            }
                        }
                    }
                }
            }
            paginarTemp(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemControleConf();
// listagemControleTemp();
function paginar(dados,usepaginacao){
    if ($(".mudaTipoItem.itemConf").hasClass("ativo")) {
        paginarConf(dados,usepaginacao);
    };
    if ($(".mudaTipoItem.itemTemp").hasClass("ativo")) {
        paginarTemp(dados,usepaginacao);
    };
};
function paginarConf(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listControleConf = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            var contem = 0;
            if (dados[i].setores.length > 0) {
                for (var j = 0; j < dados[i].setores.length; j++) {
                    if (dados[i].setores[j].item.conformidade.length > 0) {
                        contem = 1;
                    }
                }
            }
            if (contem == 1) {
                listControleConf += `
                <div class="item-lista accordion controlP`+dados[i].processo.id+"conf"+ `">
                <div class="bloco">
                <a class="a" onclick="abreAcordeon('controlP`+dados[i].processo.id+"conf"+ `')">
                <div class="subbloco">
                <div class="icone">
                <i class="dropdown icon"></i>
                </div>
                <div class="nome">
                <span class="paddingSides">`+dados[i].processo.nome+ `</span>
                </div>
                <div class="doc">
                <i class="paddingSides"><span>`+ dados[i].processo.documento+`</span> </i>
                </div>
                </div>
                </a>
                </div>
                `;
                for (var j = 0; j < dados[i].setores.length; j++) {
                    if (dados[i].setores[j].item.conformidade.length > 0) {
                        listControleConf += `
                        <div class="subItem">
                        <div>
                        <div class="listaItens">
                        <div class="block">
                        <a class="line modalControle" data-tipos="Conf" data-idprocesso="`+dados[i].processo.id+`" data-idsetor="`+dados[i].setores[j].setor.id+`">
                        <div class="table">
                        <div class="nome">
                        <span>`+dados[i].setores[j].setor.nome+`</span>
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
                    }
                }
                listControleConf += `
                </div>
                `;
            }
        }
    }else {
        listControleConf = `
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
    $("#listaControleConf").html(listControleConf);
}
function paginarTemp(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listControleTemp = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            var contem = 0;
            if (dados[i].setores.length > 0) {
                for (var j = 0; j < dados[i].setores.length; j++) {
                    if (dados[i].setores[j].item.temperatura.length > 0) {
                        contem = 1;
                    }
                }
            }
            if (contem == 1) {
                listControleTemp += `
                <div class="item-lista accordion controlP`+dados[i].processo.id+"temp"+ `">
                <div class="bloco">
                <a class="a" onclick="abreAcordeon('controlP`+dados[i].processo.id+"temp"+ `')">
                <div class="subbloco">
                <div class="icone">
                <i class="dropdown icon"></i>
                </div>
                <div class="nome">
                <span class="paddingSides">`+dados[i].processo.nome+ `</span>
                </div>
                <div class="doc">
                <i class="paddingSides"><span>`+ dados[i].processo.documento+`</span> </i>
                </div>
                </div>
                </a>
                </div>
                `;
                for (var j = 0; j < dados[i].setores.length; j++) {
                    if (dados[i].setores[j].item.temperatura.length > 0) {
                        listControleTemp += `
                        <div class="subItem">
                        <div>
                        <div class="listaItens">
                        <div class="block">
                        <a class="line modalControle" data-tipos="Temp" data-idprocesso="`+dados[i].processo.id+`" data-idsetor="`+dados[i].setores[j].setor.id+`">
                        <div class="table">
                        <div class="nome">
                        <span>`+dados[i].setores[j].setor.nome+`</span>
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
                    }
                }
                listControleTemp += `
                </div>
                `;
            }
        }
    }else {
        listControleTemp = `
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
    $("#listaControleTemp").html(listControleTemp);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Controle</div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:paginar(dadosListagem,paginacao);"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<div class="seletorTipoItem">
    <a onclick="mudaItemType('itemConf');listagemControleConf();" class="mudaTipoItem itemConf ativo" type="button" name="button"> Conformidade </a>
    <a onclick="mudaItemType('itemTemp');listagemControleTemp();" class="mudaTipoItem itemTemp" type="button" name="button"> Temperatura </a>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem processos*/ ?>
<div class="listagem-collapse">
    <span class="subtitulo">Processos</span>
    <div class="bloco-lista">
        <div class="ocultaTipoItem itemConf ativo" id="listaControleConf"></div>
        <div class="ocultaTipoItem itemTemp" id="listaControleTemp"></div>
    </div>
</div>
<? /*fim listagem processos*/ ?>

<? /*inicio modal Controle*/ ?>
<div class="modal controle">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo" id="tituloModal"> </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <div class="form">
            <div id="listaModalControle"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
var idnc = new Array();
var id = 0;
var idsetor = 0;
var itensid = 0;
$(document).off('click', '.modalControle').on("click", ".modalControle", function () {
    $("#listaModalControle").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    id = $(this).data("idprocesso");
    idsetor = $(this).data("idsetor");
    idtipoSetorItens = $(this).data("tipos");
    var head = '';
    var permiteSetor = 0;
    $.ajax({
        type: 'GET',
        url: urlApi+'detalhe/'+idsetor,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {$("#tituloModal").html(data.setor.nome);},
        error: function(resp){console.log(resp.statusText);}
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
                            if (idtipoSetorItens == "Conf") {
                                head += `
                                <div class="listagem controle">
                                <div class="item">
                                <div class="topo">
                                <div class="listItem"><span> Item </span></div>
                                <div class="listItem xInput"><span> C </span></div>
                                <div class="listItem xInput"><span> N/C </span></div>
                                <div class="listItem xInput"><span> N/A </span></div>
                                <div class="listItem x4"></div>
                                </div>
                                </div>
                                `;
                                for(var j = 0; j < data.listagem[0].setor[i].item.conformidade.length; j++){
                                    head +=`
                                    <div class="item" data-id="`+data.listagem[0].setor[i].item.conformidade[j].id+`">
                                    <div class="lista">
                                    <div class="listItem">
                                    <span> 
                                    `+data.listagem[0].setor[i].item.conformidade[j].nome+`
                                    `;
                                    if(data.listagem[0].setor[i].item.conformidade[j].ajuda != null){
                                        head +=`
                                        <a class="help-box">
                                        <i class="icon question"></i>
                                        <span class="help-box-text">
                                        `+data.listagem[0].setor[i].item.conformidade[j].ajuda+`
                                        </span>
                                        </a>    
                                        </span>
                                        `;
                                    }
                                    head +=`
                                    </div>
                                    <div class="listItem xInput"><input type="radio" class="inspecao conforme" data-id="`+data.listagem[0].setor[i].item.conformidade[j].id+`" value="1" name="` + data.listagem[0].setor[i].item.conformidade[j].id + `" ></div>
                                    <div class="listItem xInput"><input type="radio" class="inspecao naoconforme" data-id="`+ data.listagem[0].setor[i].item.conformidade[j].id + `" value="0" name="` + data.listagem[0].setor[i].item.conformidade[j].id + `" ></div>
                                    <div class="listItem xInput"><input type="radio" class="inspecao naoaplicavel" data-id="`+ data.listagem[0].setor[i].item.conformidade[j].id + `" value="2" name="` + data.listagem[0].setor[i].item.conformidade[j].id + `" ></div>
                                    <div class="listItem x4">
                                        <div class="circular" data-tipo="conf" id="btn`+ data.listagem[0].setor[i].setor.id + data.listagem[0].setor[i].item.conformidade[j].id + `" data-idinput="`+ data.listagem[0].setor[i].item.conformidade[j].id + `"><a><i class="icon plus"></i></a></div>
                                    </div>
                                    
                                    </div>
                                    <div class="lista-naoConforme" data-idtr="`+ data.listagem[0].setor[i].item.conformidade[j].id + `"></div>
                                    </div>
                                    `;
                                };
                                head +=`
                                </div>
                                <div class="botoes-rodape">
                                <div class="cancelar">
                                <a onclick="fechaModal()"> Cancelar </a>
                                </div>
                                <div class="salvar">
                                <button id="salvarControleConf" type="submit"><i class="icon save"></i> Salvar </button>
                                </div>
                                </div>
                                `;
                            }
                            if(idtipoSetorItens == "Temp"){
                                head += `
                                <div class="listagem controle">
                                <div class="item">
                                <div class="topo">
                                <div class="listItem x3"><span> Item </span></div>
                                <div class="listItem x4"><span> Temperatura do Painel (°C) </span></div>
                                <div class="listItem x4"><span> Temperatura Aferida (°C) </span></div>
                                <div class="listItem xInput"><span> N/A </span></div>
                                <div class="buttonItem"></div>
                                </div>
                                </div>
                                `;
                                for(var j = 0; j < data.listagem[0].setor[i].item.temperatura.length; j++){
                                    var tmin = data.listagem[0].setor[i].item.temperatura[j].temperatura_minima;
                                    var tmax = data.listagem[0].setor[i].item.temperatura[j].temperatura_maxima;
                                    head +=`
                                    <div class="item itemnaoconformeTemp" data-id="`+data.listagem[0].setor[i].item.temperatura[j].id+`">
                                    <div class="lista">
                                    <div class="listItem x3"><span> 
                                    `+ data.listagem[0].setor[i].item.temperatura[j].nome +`
                                    `;
                                    if(data.listagem[0].setor[i].item.temperatura[j].ajuda != null){
                                        head +=`
                                        <a class="help-box">
                                        <i class="icon question"></i>
                                        <span class="help-box-text">
                                        `+data.listagem[0].setor[i].item.temperatura[j].ajuda+`
                                        </span>
                                        </a>    
                                        </span>
                                        `;
                                    }
                                    head +=`
                                    </span></div>
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
                                    <div class="listItem xInput"><input type="radio" class="inspecao naoaplicavel" data-id="`+ data.listagem[0].setor[i].item.temperatura[j].id + `" value="2" name="` + data.listagem[0].setor[i].item.temperatura[j].id + `" ></div>
                                    <div class="buttonItem">
                                    <div class="circular" data-tipo="temp" id="btn`+ data.listagem[0].setor[i].setor.id + data.listagem[0].setor[i].item.temperatura[j].id + `" data-idinput="`+ data.listagem[0].setor[i].item.temperatura[j].id + `">
                                    <a><i class="icon plus"></i></a>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="lista-naoConforme" data-idtr="`+ data.listagem[0].setor[i].item.temperatura[j].id + `"></div>
                                    </div>
                                    `;
                                }
                                head +=`
                                </div>
                                <div class="botoes-rodape">
                                <div class="cancelar">
                                <a onclick="fechaModal()"> Cancelar </a>
                                </div>
                                <div class="salvar">
                                <button id="salvarControleTemp" type="submit"><i class="icon save"></i> Salvar </button>
                                </div>
                                </div>
                                `;
                            }
                        }
                    }
                }
            }
            $("#listaModalControle").html(head);
            idnc = [];
        },
        error: function(resp){console.log(resp.statusText);}
    });
    abreModal('controle');
});
</script>
<? /*fim modal Controle*/ ?>

<? /*Inicio ações quando conforme com ação preventiva*/?>

<? /*Fim ações conforme com ação preventiva*/?>

<? /*inicio ações quando não conforme ou não aplicavel*/ ?>
<script type="text/javascript">
$(document).off('click', '.circular').on('click', '.circular', function () {
    var trbutton ='';
    buttoncircular = $(this).data("idinput");
    circularnc ++;
    headNC ="";
    var tipoItem = "";
    var tipoItemCT = "";
    // $('[data-idtr = ' + buttoncircular + ']').html("<div class='loading-gif'><img src='img/loading.gif'></div>");
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
            `;
            if (data.naoConformidadesEAcoesCorretivas.length > 0) {
                headNC +=`
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
            }else{
                headNC +=`
                <select disabled id="item1-`+circularnc+`" data-tipo="`+tipoItemCT+`" class="item1" data-circularnc="`+circularnc+`" data-buttoncircular="`+buttoncircular+`">
                <option disabled selected value=""> Nenhum Cadastro! </option>
                `;
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
            <select disabled id="item2-`+circularnc+`" data-tipo="`+tipoItemCT+`" class="item2" data-circularnc="`+circularnc+`" data-buttoncircular="`+buttoncircular+`">
            <option disabled selected value=""> Ação Corretiva </option>
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <select disabled id="item4-`+circularnc+`" class="item4">
            <option disabled selected> Funcionario </option>
            `;
            var listFunc = "";
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemFuncionario',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (dataFuncionario) {
                    if (dataFuncionario.funcionarios != undefined){
                        listFunc += `
                        <option disabled selected> Funcionario </option>
                        `;
                        for (var f = 0; f < dataFuncionario.funcionarios.length; f++) {
                            listFunc += `
                            <option value="`+dataFuncionario.funcionarios[f].funcionario.id + `">` + dataFuncionario.funcionarios[f].funcionario.nome + ` </option>
                            `;
                        };
                        $("#item4-"+circularnc).prop("disabled", false);
                    }else {
                        listFunc += `
                        <option value=""> Nenhum Cadastro! </option>
                        `;
                    };
                    $("#item4-"+circularnc).html(listFunc);
                },
                error: function(resp){console.log(resp.statusText);}
            });
            headNC += `
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <textarea id="item3-`+circularnc+`" placeholder="Observação" rows="1" required onkeyup="auto_grow(this)"></textarea>
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
            <div class="input-table" style="width:30px">
            <div class="input-div">
            <div class="input">
            <div class="icone">
            <select disabled id="item6-`+circularnc+`" class="item6 interditar">
            <option disabled selected> Interdições </option>
            `;
            var listInterd = "";
            $.ajax({
                type: 'GET',
                url: urlApi+'listInterdicoes',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (dataInterdicoes) {
                    if (dataInterdicoes.interdicoes != undefined){
                        listInterd += `
                        <option disabled selected> Interdições </option>
                        `;
                        for (var g = 0; g < dataInterdicoes.interdicoes.length; g++) {
                            listInterd += `
                            <option value="`+dataInterdicoes.interdicoes[g].id + `">` + dataInterdicoes.interdicoes[g].nome + ` </option>
                            `;
                        };
                        $("#item6-"+circularnc).prop("disabled", false);
                    }else {
                        listInterd += `
                        <option value=""> Nenhum Cadastro! </option>
                        `;
                    };
                    $("#item6-"+circularnc).html(listInterd);
                },
                error: function(resp){console.log(resp.statusText);}
            });
            headNC += `
            </select>
            <i class="interditar tasks icon"></i>
            </div>
            </div>
            </div>
            </div>
            <div class="input-table btn">
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
        error: function(resp){console.log(resp.statusText);}
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
    $("#item2-"+circularnc).prop("disabled", true);
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
                        if (data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas.length > 0) {
                            for (var k = 0; k < data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas.length; k++) {
                                listOptions += `
                                <option value="`+data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].id+`"> `+data2.naoConformidadesEAcoesCorretivas[i].acoescorretivas[k][0].nome+` </option>
                                `;
                            };
                            $("#item2-"+circularnc).prop("disabled", false);
                        }else {
                            listOptions = `
                            <option value=""> Nenhum Cadastro! </option>
                            `;
                        };
                        $("#item5-"+circularnc).val(null);
                    };
                };
            };
            $("#item2-"+circularnc).html(listOptions);
        },
        error: function(resp){console.log(resp.statusText);}
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
    };
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
                            };
                        };
                    };
                };
            };
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
function circularNA(id) {
    var trbutton ='';
    buttoncircular = id;
    circularnc ++;
    headNC ="";
    $('[data-idtr = ' + buttoncircular + ']').html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    headNC =`
    <div class="bloco" id="lineNC-`+circularnc+`">
    
    <div class="input-table">
    <div class="input-div">
    <div class="input">
    <div class="icone">
    <textarea id="observacaoNA-`+buttoncircular+`" placeholder="Observação" rows="1" onkeyup="auto_grow(this)"></textarea>
    </div>
    </div>
    </div>
    </div>
    
    <div class="input-table btn">
    <div class="buttonItem">
    <a class="edita" id="salvarNA" data-countnum="`+circularnc+`" data-idsalva="`+buttoncircular+`"><i class="icon save"></i></a>
    </div>
    </div>
    
    <div class="novaNC-off" id="novaNC-off`+circularnc+`"></div>
    <div class="alertItem" id="alertItem-`+circularnc+`">Preencha todos os campos *</div>
    </div>
    `;
    $('[data-idtr = ' + buttoncircular + ']').html(headNC);
};
</script>
<? /*fim ações quando não conforme ou não aplicavel*/ ?>

<? /*inicio controle Temp*/ ?>
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
        $('[data-id='+idnaoconforme+'].naoaplicavel').prop('checked', false);
        if ((valorPainel < valorMinima || valorPainel > valorMaxima) || (valorAferid < valorMinima || valorAferid > valorMaxima)) {
            if($('[data-idtr = ' + idnaoconforme + ']').html() == ''){
                $('[data-idinput = ' + idnaoconforme + ']').show();
                $('[data-idinput = ' + idnaoconforme + ']').click();
            };
        }else {
            $('[data-idinput = ' + idnaoconforme + ']').hide();
            $('[data-idtr ='+ idnaoconforme +']').html('');
        }
    }

});
$(document).off('click', '.naoaplicavel').on('click', '.naoaplicavel', function () {
    if ($(this).is(':checked')) {
        idnaoconforme = $(this).data("id");
        $("#tempPainel"+idnaoconforme).val('');
        $("#tempAferida"+idnaoconforme).val('');
        $('[data-idinput = ' + idnaoconforme + ']').hide();
        circularNA(idnaoconforme);
    }
});
$(document).off('click', '.naoconforme').on('click', '.naoconforme', function () {
    if ($(this).is(':checked')) {
        idnaoconforme = $(this).data("id");
        $('[data-idinput = ' + idnaoconforme + ']').show();
        $('[data-idinput = ' + idnaoconforme + ']').click();
    }
});
$(document).off('click', '.conforme').on('click', '.conforme', function () {
    if ($(this).is(':checked')) {
        idnaoconforme = $(this).data("id");
        $('[data-idinput = ' + idnaoconforme + ']').show();
        $('[data-idtr ='+ idnaoconforme +']').html('');
    }
});
var headNC = "";
var circularnc = 0;
var buttoncircular = 0;
var retornoconformidades = "";
<? /*fim controle Temp*/ ?>

var salvarnaoc = 0;
$(document).off('click', '#salvarNC').on("click", "#salvarNC", function () {
    var nc = "";
    var buttoniditem = '';
    salvarnaoc++;
    buttoniditem = $(this).data("idsalva");
    itemcountnum = $(this).data("countnum");
    if ((($('#item1-'+itemcountnum).val() != null && $('#item2-'+itemcountnum).val() != null) || $("#item3-"+circularnc).val() != "" ) && $('#item4-'+itemcountnum).val() != null && $('#item5-'+itemcountnum).val() != "") {
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
            "prazo": dataPrazo,
            "id_interdicao":$('#item6-'+itemcountnum).val(),
            "produtor":false
        }
        $("#alertItem-"+itemcountnum).fadeOut();
        $("#lineNC-"+itemcountnum).removeClass("alertBg");
        $("#novaNC-off"+itemcountnum).addClass("on");
        idnc.push(nc);
    }else{
        $("#alertItem-"+itemcountnum).fadeOut();
        $("#alertItem-"+itemcountnum).fadeIn();
        if($('#item1-'+itemcountnum).val() == null){$('#item1-'+itemcountnum).addClass("alertBg");setTimeout(function () {$('#item1-'+itemcountnum).removeClass("alertBg");}, 1000);};
        if($('#item2-'+itemcountnum).val() == null){$('#item2-'+itemcountnum).addClass("alertBg");setTimeout(function () {$('#item2-'+itemcountnum).removeClass("alertBg");}, 1000);};
        if($('#item3-'+itemcountnum).val() == ""){$('#item3-'+itemcountnum).addClass("alertBg");setTimeout(function () {$('#item3-'+itemcountnum).removeClass("alertBg");}, 1000);};
        if($('#item4-'+itemcountnum).val() == null){$('#item4-'+itemcountnum).addClass("alertBg");setTimeout(function () {$('#item4-'+itemcountnum).removeClass("alertBg");}, 1000);};
        if($('#item5-'+itemcountnum).val() == ""){$('#item5-'+itemcountnum).addClass("alertBg");setTimeout(function () {$('#item5-'+itemcountnum).removeClass("alertBg");}, 1000);};
    }
});
$(document).off('click', '#salvarNA').on("click", "#salvarNA", function () {
    var nc = "";
    var buttoniditem = '';
    salvarnaoc++;
    buttoniditem = $(this).data("idsalva");
    itemcountnum = $(this).data("countnum");
    // if ($("#observacaoNA-"+buttoniditem).val() != "" && $("#observacaoNA-"+buttoniditem).val() != undefined) {
        nc = {
            "iditem":buttoniditem,
            "observacoes":$('#observacaoNA-'+itemcountnum).val(),
            "produtor":false
        }
        idnc.push(nc);
        $("#alertItem-"+itemcountnum).fadeOut();
        $("#lineNC-"+itemcountnum).removeClass("alertBg");
        $("#novaNC-off"+itemcountnum).addClass("on");
    // }else{
    //     $("#alertItem-"+itemcountnum).fadeOut();
    //     $("#alertItem-"+itemcountnum).fadeIn();
    //     if($('#observacaoNA-'+buttoniditem).val() == ""){$('#observacaoNA-'+buttoniditem).addClass("alertBg");setTimeout(function () {$('#observacaoNA-'+buttoniditem).removeClass("alertBg");}, 1000);};
    // }
});

<? /*inicio controle Conf*/ ?>
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
            if(($(this).val() == 0) || ($(this).val() == 2)){
                conterNC = 1;
                for(var nc = 0; nc < idnc.length; nc++){
                    if(idnc[nc].iditem == $(this).data("id")){
                        novonc.push(idnc[nc]);
                    }
                }
                if(($(this).val() == 0)){
                    conformidade = {
                        "id": $(this).data("id"),
                        "con": $(this).val(),
                        "naoconformidades": novonc
                    }
                }
                if(($(this).val() == 2)){
                    conformidade = {
                        "id": $(this).data("id"),
                        "con": $(this).val()
                    }
                }
                if (novonc == "") {
                    verificaNCvazia = 1;
                    if ($(this).is(':checked')) {
                        if($(this).val() == 0 || $(this).val() == 2){
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
            error: function(resp){console.log(resp.statusText);}
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

        
        for(var nc = 0; nc < idnc.length; nc++){
            if(idnc[nc].iditem == idItem){
                novonc.push(idnc[nc]);
            }
        }
        if ((valorPainel != "" || valorAferid != "")) {
            if ((parseInt(valorPainel) < valorMinima || parseInt(valorPainel) > valorMaxima) || (parseInt(valorAferid) < valorMinima || parseInt(valorAferid) > valorMaxima)) {
                // nao conforme
                conterNC = 1;
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
        }else{
            if($('[data-id='+idItem+'].naoaplicavel').is(':checked')){
                if(novonc != ''){
                    conformidade = {
                        "id": idItem,
                        "con": '2'
                    }
                };
            }
        }
        iditem.push(conformidade);
        datasitens = {
            "itens": iditem
        };
        if (conterNC == 1) {
            if ((parseInt(valorPainel) < valorMinima || parseInt(valorPainel) > valorMaxima) || (parseInt(valorAferid) < valorMinima || parseInt(valorAferid) > valorMaxima)) {
                if (novonc != "") {
                    realizaControle = 1;
                }else {
                    console.log('aqui');
                    tryControle = 1;
                    $('.item[data-id='+idItem+']').addClass("alertBg");
                    setTimeout(function () {
                        $(".alertBg").removeClass("alertBg");
                    }, 1000);
                }
            }
        }else {
            if (conformidade != 0 && conformidade != '') {
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
                    error: function(resp){console.log(resp.statusText);}
                });
            }
        }
    });
});
</script>
<? /*fim controle Conf*/ ?>
