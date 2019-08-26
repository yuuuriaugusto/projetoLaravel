<script type="text/javascript">verificaLogin();</script>
<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemEmpresas() {
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemEmpresas',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            dadosListagem = data.empresas;
            paginar(dadosListagem,paginacao);
        },
        error: function(){alert("Não foi possivel realizar a operação!");}
    });
}
listagemEmpresas();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listEmpresas = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listEmpresas += `
            <div class="item itemBusca">
            <div class="lista">
            <div class="listItem x4">
            <span> `+dados[i].empresaAtual.fantasia+` </span>
            </div>
            <div class="listItem x4">
            <span>`+dados[i].empresaAtual.segmento+`</span>
            </div>
            <div class="listItem x4">
            <span>`+dados[i].cidadeEstado.cidade[0].nome+` - `+dados[i].cidadeEstado.uf[0].uf+`</span>
            </div>
            <div class="listItem x4">
            <span><a target="_blank" href="https://`+dados[i].empresaAtual.dominio+`">`+dados[i].empresaAtual.dominio+`<a></span>
            </div>
            <div class="buttonItem">
            <a class="edita editEmpresa" data-id="`+dados[i].empresaAtual.id+`" type="submit"><i class="icon edit"></i></a>
            </div>
            <div class="buttonItem">
            <a class="del" id="delEmpresa" data-id="`+dados[i].empresaAtual.id+`" type="submit"><i class="icon trash alternate"></i></a>
            </div>
            </div>
            </div>
            `;
        }
    }else {
        listEmpresas = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem registros! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaEmpresas").html(listEmpresas);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Empresas</div>
<div class="botaoNovo"><a id="novaEmpresa">
    <i class="plus square outline icon"></i>Nova Empresa
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:paginar(dadosListagem,paginacao);"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem empresa*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x4">
                <span>Nome Fantasia</span>
            </div>
            <div class="listItem x4">
                <span>Segmento</span>
            </div>
            <div class="listItem x4">
                <span>Município - UF</span>
            </div>
            <div class="listItem x4">
                <span>Acessar Empresa</span>
            </div>
            <div class="buttonItem"></div>
            <div class="buttonItem"></div>
        </div>
    </div>
    <div id="listaEmpresas"></div>
</div>
<? /*fim listagem empresa*/ ?>

<? /*incio nova empresa*/ ?>
<div class="modal novaEmpresa">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro Empresa </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastronovaEmpresa">
            <div class="titulo-modal"><span> Dados da empresa </span></div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Razão Social </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Razão Social" type="text" required id="razaosocial">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> IE </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Inscrição Estadual" type="text" required id="ie">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Nome Fantasia </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o nome Fantasia" type="text" required id="nomefantasia">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="segmento">
                                    <option value="" disabled selected> Segmento </option>
                                    <option value="Aves"> Aves </option>
                                    <option value="Suinos"> Suinos </option>
                                    <option value="Bovinos"> Bovinos </option>
                                    <option value="Peixes"> Peixes </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> CNPJ </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CNPJ" type="text" required id="cnpj">
                                <script type="text/javascript">$("#cnpj").mask("99.999.999/9999-99");</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Endereços </span></div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> CEP </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CEP" type="text" required id="cep">
                                <script type="text/javascript">$("#cep").mask("99999-999");</script>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Bairro </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o Bairro" type="text" required id="bairro">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="uf">
                                    <option value="" disabled selected> UF </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Endereço </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <textarea placeholder="Informe o Endereço" type="text" required id="endereco"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="municipio">
                                    <option value="" disabled selected> Município </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Número </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe número" type="number" required id="numero">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Administrativo </span></div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Dominio </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Dominio" type="text" required id="dominio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Database </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Database" type="text" required id="database">
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
$(document).off("click", "#novaEmpresa").on("click", "#novaEmpresa", function () {
    if (validarPermissao() != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        listEstados();
        abreModal('novaEmpresa');
    }
});
$(document).off("submit","#cadastronovaEmpresa").on("submit","#cadastronovaEmpresa", function (e) {
    e.preventDefault();
    if (validarPermissao() != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {

        var datas = {
            "razao_social": $("#razaosocial").val(),
            "fantasia": $("#nomefantasia").val(),
            "cnpj": $("#cnpj").val(),
            "inscricao_estadual": $("#ie").val(),
            "cep": $("#cep").val(),
            "endereco": $("#endereco").val(),
            "municipio": $("#municipio").val(),
            "uf": $("#uf").val(),
            "numero": $("#numero").val(),
            "bairro": $("#bairro").val(),
            "segmento": $("#segmento").val(),
            "db_database": $("#database").val(),
            "dominio": $("#dominio").val()
        };
        $.ajax({
            type: 'POST',
            url: urlApi+'novaEmpresa',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datas,
            success: function (data) {
                abreModal('sucessoCadastroEmpresa');
                listagemEmpresas();
                setTimeout(function () {
                    // $("#razaosocial").val("");$("#nomefantasia").val("");$("#cnpj").val("");$("#ie").val("");$("#cep").val("");$("#endereco").val("");$("#municipio").val("");$("#uf").val("");$("#numero").val("");$("#bairro").val("");$("#segmento").val("");$("#database").val("");$("#dominio").val("");
                    fechaModal('sucessoCadastroEmpresa');
                }, 1500);
            },
            error: function (){
                if ($('#municipio').val() == null || $('#uf').val() == null) {
                    if ($('#municipio').val() == null) {
                        $('#municipio').addClass("alertBg");
                        setTimeout(function () {
                            $('#municipio').removeClass("alertBg");
                        }, 1500);
                    }
                    if ($('#uf').val() == null) {
                        $('#uf').addClass("alertBg");
                        setTimeout(function () {
                            $('#uf').removeClass("alertBg");
                        }, 1500);
                    }
                }else {
                    alert("Não foi possivel realizar a operação!");
                }
            },
        });
    }
});
</script>
<? /*fim nova empresa*/ ?>

<? /*inicio editar empresa*/ ?>
<div class="modal editaEmpresa">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Editar Empresa </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editaEmpresa">
            <div class="titulo-modal"><span> Dados da empresa </span></div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Razão Social </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Razão Social" type="text" required id="razaosocialedit">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> IE </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Inscrição Estadual" type="text" required id="ieedit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Nome Fantasia </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o nome Fantasia" type="text" required id="nomefantasiaedit">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="segmentoedit">
                                    <option value="" disabled selected> Segmento </option>
                                    <option value="Aves"> Aves </option>
                                    <option value="Suinos"> Suinos </option>
                                    <option value="Bovinos"> Bovinos </option>
                                    <option value="Peixes"> Peixes </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> CNPJ </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CNPJ" type="text" required id="cnpjedit">
                                <script type="text/javascript">$("#cnpjedit").mask("99.999.999/9999-99");</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Endereços </span></div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> CEP </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CEP" type="text" required id="cepedit">
                                <script type="text/javascript">$("#cepedit").mask("99999-999");</script>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Bairro </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o Bairro" type="text" required id="bairroedit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <!-- <div id="optionListedit"> -->
                                <select id="ufedit">
                                    <option value="" disabled selected> UF </option>
                                </select>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Endereço </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <textarea placeholder="Informe o Endereço" type="text" required id="enderecoedit"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <!-- <div id="optionList2edit"> -->
                                <select id="municipioedit">
                                    <option value="" disabled selected> Município </option>
                                </select>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Número </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe número" type="number" required id="numeroedit">
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
$(document).off('click', ".editEmpresa").on('click', ".editEmpresa", function () {
    id = $(this).data('id');
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        listEstados();
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheEmpresa/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                $("#razaosocialedit").val(data.empresa.razao_social);
                $("#nomefantasiaedit").val(data.empresa.fantasia);
                $("#cnpjedit").val(data.empresa.cnpj);
                $("#ieedit").val(data.empresa.inscricao_estadual);
                $("#cepedit").val(data.empresa.cep);
                $("#enderecoedit").val(data.empresa.endereco);
                $('#ufedit option[value='+data.empresa.uf+']').attr('selected','selected');
                listCidades(data.empresa.uf);
                $('#municipioedit option[value='+data.empresa.municipio+']').attr('selected','selected');
                $("#numeroedit").val(data.empresa.numero);
                $("#bairroedit").val(data.empresa.bairro);
                $('#segmentoedit option[value='+data.empresa.segmento+']').attr('selected','selected');
                abreModal('editaEmpresa');
            },
            error: function(){alert("Não foi possivel realizar a operação!");}
        });
    }
});
$(document).off('submit',"#editaEmpresa").on('submit',"#editaEmpresa", function (e) {
    e.preventDefault();
    var data = {
        "razao_social": $("#razaosocialedit").val(),
        "fantasia": $("#nomefantasiaedit").val(),
        "cnpj": $("#cnpjedit").val(),
        "inscricao_estadual": $("#ieedit").val(),
        "cep": $("#cepedit").val(),
        "endereco": $("#enderecoedit").val(),
        "municipio": $("#municipioedit").val(),
        "uf": $("#ufedit").val(),
        "numero": $("#numeroedit").val(),
        "bairro": $("#bairroedit").val(),
        "segmento": $("#segmentoedit").val()
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'editarEmpresa/' + id,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemEmpresas();
            $(".empresaEditada").fadeIn(function(){
                $(":checkbox").prop('checked', false);
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        // error: function(){alert("Não foi possivel realizar a operação!");}
        error: function(){
            if ($('#municipioedit').val() == null) {
                $('#municipioedit').addClass("alertBg");
                setTimeout(function () {
                    $('#municipioedit').removeClass("alertBg");
                }, 1500);
            }
            if ($('#ufedit').val() == null) {
                $('#ufedit').addClass("alertBg");
                setTimeout(function () {
                    $('#ufedit').removeClass("alertBg");
                }, 1500);
            }
        }
    });
});
</script>
<? /*fim editar empresa*/ ?>

<? /*inicio deletar empresa*/ ?>
<div class="modal deletarEmpresa">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir essa Empresa? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="deletarEmpresa">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Excluir </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idDelete = 0;
$(document).off('click', "#delEmpresa").on('click', "#delEmpresa", function () {
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        idDelete = $(this).data("id");
        abreModal('deletarEmpresa');
    }
});
$(document).off("submit","#deletarEmpresa").on("submit","#deletarEmpresa", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarEmpresa/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $(".sucessoExcluirEmpresa").fadeIn(function(){
                listagemEmpresas();
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){alert("Não foi possivel realizar a operação!");}
    });
});
</script>
<? /*fim deletar empresa*/ ?>

<? /*inicio listagem estados e cidades*/ ?>
<script type="text/javascript">
function listEstados(){
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemEstados',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var optionList = "";
            optionList += `
            <option value="" selected> UF </option>
            `;
            for (var i = 0; i < data.estados.length; i++) {
                optionList += `<option value="`+data.estados[i].id+`"> `+data.estados[i].nome+" - "+data.estados[i].uf+` </option>`;
            }
            optionList += `
            `;
            $("#uf").html(optionList);
            $("#ufedit").html(optionList);
        },
        error: function (){
            alert("Não foi possivel realizar a operação!");
        },
    });
}
$(document).off("change","#uf").on("change","#uf", function () {listCidades($(this).val());});
$(document).off("change","#ufedit").on("change","#ufedit", function () {listCidades($(this).val());});
function listCidades(idEstado){
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemCidades/'+idEstado,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var optionList = "";
            optionList += `
            <option disabled selected> Município </option>
            `;
            for (var i = 0; i < data.cidades.length; i++) {
                optionList += `<option value="`+data.cidades[i].id+`"> `+data.cidades[i].nome+`  </option>`;
            }
            $("#municipio").html(optionList);
            $("#municipioedit").html(optionList);
        },
        error: function (){
            alert("Não foi possivel realizar a operação!");
        },
    });
}
</script>
