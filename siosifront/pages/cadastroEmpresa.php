<script type="text/javascript">verificaLogin();</script>
<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemEmpresas() {
    $("#listaEmpresas").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemEmpresas',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.empresas != undefined){
                dadosListagem = data.empresas;
            }else {
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
listagemEmpresas();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listEmpresas = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listEmpresas += `
            <div class="item itemBusca">
            <div class="lista">
            <div class="listItem x4"><span> `+dados[i].empresaAtual.fantasia+` </span></div>
            <div class="listItem x4 xsinvisible">
            <span class="segspan" data-id="`+dados[i].empresaAtual.segmento+`"></span>
            </div>
            <div class="listItem x4 xsinvisible"><span>`+dados[i].cidadeEstado.cidade[0].nome+` - `+dados[i].cidadeEstado.uf[0].uf+`</span></div>
            <div class="listItem x4 xsinvisible"><span><a target="_blank" href="https://`+dados[i].empresaAtual.dominio+`">`+dados[i].empresaAtual.dominio+`<a></span></div>
            <div class="buttonItem"><a class="edita editEmpresa" data-id="`+dados[i].empresaAtual.id+`" type="submit"><i class="icon edit"></i></a></div>
            <div class="buttonItem"><a class="del" id="delEmpresa" data-id="`+dados[i].empresaAtual.id+`" type="submit"><i class="icon trash alternate"></i></a></div>
            </div>
            </div>
            `;
        };
        $.ajax({
            type: 'GET',
            url: urlApi+'listagemSegmentos',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                $(".segspan").each(function(){
                    for (var i = 0; i < data.segmentos.length; i++) {
                        if(data.segmentos[i].id == $(this).data("id")){
                            $(this).append(data.segmentos[i].nome);
                        };
                    };
                });
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }else {
        listEmpresas = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem empresas cadastradas! </span>
        </div>
        </div>
        </div>
        `;
    };
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
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemEmpresas();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem empresa*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x4"><span>Nome Fantasia</span></div>
            <div class="listItem x4 xsinvisible"><span>Segmento</span></div>
            <div class="listItem x4 xsinvisible"><span>Município - UF</span></div>
            <div class="listItem x4 xsinvisible"><span>Acessar Empresa</span></div>
            <div class="buttonItem xsinvisible"></div>
            <div class="buttonItem xsinvisible"></div>
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
        <div id="cadastronovaEmpresaLoad" class='loading-gif'><img src='img/loading.gif'></div>
        <form style="display:none" class="form" id="cadastronovaEmpresa">
            <div class="titulo-modal"><span> Dados da empresa </span></div>
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> Razão Social </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe a Razão Social" type="text" id="razaosocial">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> IE </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe a Inscrição Estadual" type="text" id="ie">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> Nome Fantasia </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe o nome Fantasia" type="text" id="nomefantasia">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select required id="segmento">
                                    <option disabled selected> Segmento </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> CNPJ </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe o CNPJ" type="text" id="cnpj">
                                <script type="text/javascript">$("#cnpj").mask("99.999.999/9999-99");</script>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select required id="fiscalizacao">
                                    <option disabled selected> Fiscalização </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conteudo">
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> Anexos </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="selecione os arquivos" type="file" id="arquivos-files" multiple="multiple" name="arquivos-files[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Endereços </span></div>
            <div class="conteudo">
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input"> CEP </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe o CEP" type="text" id="cep">
                                <script type="text/javascript">$("#cep").mask("99999-999");</script>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Bairro </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe o Bairro" type="text" id="bairro">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select required id="uf">
                                    <option disabled selected> UF </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Endereço </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <textarea required placeholder="Informe o Endereço" type="text" id="endereco"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select required id="municipio">
                                    <option disabled selected> Município </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input"> Número </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe número" type="number" id="numero">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select required id="pais">
                                    <option disabled selected> País </option>
                                    <option value="1" selected> Brasil - BR </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Administrativo </span></div>
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> Dominio </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe a Dominio" type="text" id="dominio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> Database </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input required placeholder="Informe a Database" type="text" id="database">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input"> Logo </span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="selecione os arquivos" type="file" id="arquivos-logo" name="arquivos-logo[]" style="resize:none;">
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
$(document).off("click", "#novaEmpresa").on("click", "#novaEmpresa", async function () {
    if (validarPermissao() != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        abreModal('novaEmpresa');
        await listEstados();
        await listSegmentos();
        await listFiscalizacoes();
        $('#cadastronovaEmpresa').trigger('reset');
        $('#cadastronovaEmpresaLoad').css('display', 'none');
        $('#cadastronovaEmpresa').css('display', 'block');
    };
});
var form = $('#cadastronovaEmpresa')[0];var formdata = new FormData(form);var storedFiles = [];
$(document).off('change', '#arquivos-logo').on('change', '#arquivos-logo', function (e) {
    var filesArr = Array.prototype.slice.call(e.target.files);
    filesArr.forEach(function (f) {storedFiles.push(f);});
});
var formfiles = $('#cadastronovaEmpresa')[0];var formdatafiles = new FormData(formfiles);var storedFilesfiles = [];
$(document).off('change', '#arquivos-files').on('change', '#arquivos-files', function (e) {
    var filesArrfiles = Array.prototype.slice.call(e.target.files);
    filesArrfiles.forEach(function (f) {storedFilesfiles.push(f);});
});
$(document).off("submit","#cadastronovaEmpresa").on("submit","#cadastronovaEmpresa", function (e) {
    e.preventDefault();
    if (validarPermissao() != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        if($("#arquivos-logo")[0].files[0] != undefined){
            $logoname = '/upload/empresa/'+removeAcentos((($("#razaosocial").val().toString()).toLowerCase()).replace(' ',''))+'/logo.png';
        }else{
            $logoname = '/img/logo-white.png';
        };
        var datas = {
            "razao_social": $('#razaosocial').val(),
            "fantasia": $('#nomefantasia').val(),
            "cnpj": $('#cnpj').val(),
            "inscricao_estadual": $('#ie').val(),
            "cep": $('#cep').val(),
            "endereco": $('#endereco').val(),
            "municipio": $('#municipio').val(),
            "uf": $('#uf').val(),
            "pais": $('#pais').val(),
            "numero": $('#numero').val(),
            "bairro": $('#bairro').val(),
            "segmento": $('#segmento').val(),
            "fiscalizacao": $('#fiscalizacao').val(),
            "db_database": removeAcentos((($("#database").val().toString()).toLowerCase()).replace(' ','')),
            "dominio": removeAcentos((($("#dominio").val().toString()).toLowerCase()).replace(' ','')),
            "logo": $logoname,
        };
        $.ajax({
            type: 'GET',
            url: urlApi+'listagemEmpresas',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: async function (data) {
                var validacaoDadosDB = 1;
                if(data.empresas != undefined){
                    for (var i = 0; i < data.empresas.length; i++) {
                        if (data.empresas[i].empresaAtual.cnpj == $("#cnpj").val()) {$("#cnpj").addClass("alertBg");setTimeout(function () {$("#cnpj").removeClass("alertBg");}, 1000);alert("CNPJ já Existe!");validacaoDadosDB = 0;}
                        if (data.empresas[i].empresaAtual.db_database == removeAcentos((($("#database").val().toString()).toLowerCase()).replace(' ',''))) {$("#database").addClass("alertBg");setTimeout(function () {$("#database").removeClass("alertBg");}, 1000);alert("Dominio já Existe!");validacaoDadosDB = 0;}
                        if (data.empresas[i].empresaAtual.dominio == removeAcentos((($("#dominio").val().toString()).toLowerCase()).replace(' ',''))) {$("#dominio").addClass("alertBg");setTimeout(function () {$("#dominio").removeClass("alertBg");}, 1000);alert("Dominio já Existe!");validacaoDadosDB = 0;}
                    };
                };
                if (validacaoDadosDB) {
                    if($("#arquivos-logo")[0].files[0] != undefined){
                        for (var i = 0; i < storedFiles.length; i++) {
                            var fileData = storedFiles[i];
                            formdata.append('arquivos-logo[]', fileData);
                        };
                        $auxnome = removeAcentos((($("#razaosocial").val().toString()).toLowerCase()).replace(' ',''));
                        formdata.append('nome', $auxnome);
                        formdata.append('tipo', 'empresa');
                        await $.ajax({
                            type: 'POST',
                            url: 'upload/uploadlogo.php',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (responseData, textStatus, jqXHR) {
                                form = $('#cadastronovaEmpresa')[0];
                                formdata = new FormData(form);
                                storedFiles = [];
                                filesArr = '';
                            },
                        });
                    };
                    if($("#arquivos-files")[0].files[0] != undefined){
                        for (var i = 0; i < storedFilesfiles.length; i++) {
                            var fileDatafiles = storedFilesfiles[i];
                            formdatafiles.append('arquivos-files[]', fileDatafiles);
                        };
                        $auxnomefiles = removeAcentos((($("#razaosocial").val().toString()).toLowerCase()).replace(' ',''));
                        formdatafiles.append('nome', $auxnomefiles);
                        formdatafiles.append('tipo', 'empresa');
                        $.ajax({
                            type: 'POST',
                            url: 'upload/uploadfiles.php',
                            data: formdatafiles,
                            processData: false,
                            contentType: false,
                            success: function (responseData, textStatus, jqXHR) {
                                formfiles = $('#cadastronovaEmpresa')[0];
                                formdatafiles = new FormData(formfiles);
                                storedFilesfiles = [];
                                filesArrfiles = '';
                            },
                        });
                    };
                    $.ajax({
                        type: 'POST',
                        url: urlApi+'novaEmpresa',
                        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                        dataType: 'json',
                        data: datas,
                        success: function (data2) {
                            abreModal('sucessoCadastroEmpresa');
                            $('#cadastronovaEmpresa').trigger('reset');
                            listagemEmpresas();
                            setTimeout(function () {
                                fechaModal('sucessoCadastroEmpresa');
                            }, 1500);
                        },
                        error: function(resp){console.log(resp.statusText);}
                    });
                };
            },
            error: function(resp){console.log(resp.statusText);}
        });
    };
});
</script>
<? /*fim nova empresa*/ ?>

<? /*inicio editar empresa*/ ?>
<div class="modal editaEmpresa">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Editar Empresa </span>
            <a class="close" onclick="fechaModal();setTimeout(function(){$('#editaEmpresaLoad').css('display', 'block');$('#editaEmpresa').css('display', 'none');},1000);"><i class="close icon"></i></a>
        </div>
        <div id="editaEmpresaLoad" class='loading-gif'><img src='img/loading.gif'></div>
        <form style="display:none" class="form" id="editaEmpresa">
            <div class="titulo-modal"><span> Dados da empresa </span></div>
            <div class="conteudo">
                <div class="col x3">
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
                <div class="col x3">
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
                        <span class="titulo-input"> Logo </span>
                        <div class="input">
                            <div class="icone">
                                <input style="background-size:100%;background-position:center;background-repeat:no-repeat;" class="ajuda" placeholder="selecione os arquivos" type="file" id="arquivos-logoedit" name="arquivos-logoedit[]" style="resize:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
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
                    <div class="input-div">
                        <span class="titulo-input"> Anexos </span>

                        <div class="input">
                            <div class="icone">
                                <input placeholder="selecione os arquivos" type="file" id="arquivos-filesedit" multiple="multiple" name="arquivos-filesedit[]">
                            </div>
                        </div>

                        <div class="input">
                            <div class="icone" id="listdocempresa">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="titulo-modal"><span> Endereços </span></div>
            <div class="conteudo">
                <div class="col x4">
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
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="ufedit">
                                    <option disabled selected> UF </option>
                                </select>
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
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="municipioedit">
                                    <option disabled selected> Município </option>
                                </select>
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
                <div class="col x4">
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="paisedit">
                                    <option disabled selected> País </option>
                                    <option value="1"> Brasil - BR </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal();setTimeout(function(){$('#editaEmpresaLoad').css('display', 'block');$('#editaEmpresa').css('display', 'none');},1000);"> Cancelar </a>
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
var formedit = $('#editaEmpresa')[0];var formdataedit = new FormData(formedit);var storedFilesedit = [];
$(document).off('change', '#arquivos-logoedit').on('change', '#arquivos-logoedit', function (e) {
    var filesArredit = Array.prototype.slice.call(e.target.files);
    filesArredit.forEach(function (f) {storedFilesedit.push(f);});
});
var formfilesedit = $('#editaEmpresa')[0];var formdatafilesedit = new FormData(formfilesedit);var storedFilesfilesedit = [];
$(document).off('change', '#arquivos-filesedit').on('change', '#arquivos-filesedit', function (e) {
    var filesArrfilesedit = Array.prototype.slice.call(e.target.files);
    filesArrfilesedit.forEach(function (f) {storedFilesfilesedit.push(f);});
});
$(document).off('click', '#delete-file').on('click', '#delete-file', function (e) {
    var filedeletename = $(this).data('file');
    $.ajax({
        type: 'POST',
        url: 'upload/deletefile.php',
        data: {'nomefile':filedeletename,'diretorio':removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ','')),'tipo':'empresa'},
        success: function (data) {
            listFiles({'diretorio':removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ','')),'tipo':'empresa'});
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
function listFiles(datafilelist){
    $.ajax({
        type: 'POST',
        url: 'upload/listarArquivos.php',
        data: datafilelist,
        success: function (data2) {
            $('#listdocempresa').html(data2);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
$(document).off('click', ".editEmpresa").on('click', ".editEmpresa", function () {
    id = $(this).data('id');
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {$(".semPermisao").fadeOut();}, 1500);
    } else {
        abreModal('editaEmpresa');
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheEmpresa/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: async function (data) {
                $("#razaosocialedit").val(data.empresa.razao_social);
                $("#nomefantasiaedit").val(data.empresa.fantasia);
                $("#cnpjedit").val(data.empresa.cnpj);
                $("#ieedit").val(data.empresa.inscricao_estadual);
                $("#cepedit").val(data.empresa.cep);
                $("#enderecoedit").val(data.empresa.endereco);
                $('#paisedit option[value='+data.empresa.pais+']').attr('selected','selected');
                $("#numeroedit").val(data.empresa.numero);
                $("#bairroedit").val(data.empresa.bairro);
                $("#arquivos-logoedit").css('background-image', 'url("./'+data.empresa.logo+'")');
                $logoname = data.empresa.logo;
                await listEstados();
                await listCidades(data.empresa.uf);
                $('#ufedit option[value='+data.empresa.uf+']').attr('selected','selected');
                $('#municipioedit option[value='+data.empresa.municipio+']').attr('selected','selected');
                await listFiles({'diretorio':removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ','')),'tipo':'empresa'});
                $('#editaEmpresaLoad').css('display', 'none');
                $('#editaEmpresa').css('display', 'block');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    };
});
$(document).off('submit',"#editaEmpresa").on('submit',"#editaEmpresa", async function (e) {
    e.preventDefault();
    if($("#arquivos-logoedit")[0].files[0] != undefined){
        $logoname = '/upload/empresa/'+removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ',''))+'/logo.png';
    };
    var data = {
        "razao_social": $("#razaosocialedit").val(),
        "fantasia": $("#nomefantasiaedit").val(),
        "cnpj": $("#cnpjedit").val(),
        "inscricao_estadual": $("#ieedit").val(),
        "cep": $("#cepedit").val(),
        "endereco": $("#enderecoedit").val(),
        "municipio": $("#municipioedit").val(),
        "uf": $("#ufedit").val(),
        "pais": $("#paisedit").val(),
        "numero": $("#numeroedit").val(),
        "bairro": $("#bairroedit").val(),
        "logo": $logoname
    };
    if($("#arquivos-logoedit")[0].files[0] != undefined){
        for (var i = 0; i < storedFilesedit.length; i++) {
            var fileDataedit = storedFilesedit[i];
            formdataedit.append('arquivos-logo[]', fileDataedit);
        };
        $auxnome = removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ',''));
        formdataedit.append('nome', $auxnome);
        formdataedit.append('tipo', 'empresa');
        await $.ajax({
            type: 'POST',
            url: './upload/uploadlogo.php',
            data: formdataedit,
            processData: false,
            contentType: false,
            success: function (responseData, textStatus, jqXHR) {
                formedit = $('#editaEmpresa')[0];
                formdataedit = new FormData(formedit);
                storedFilesedit = [];
                filesArredit = '';
            },
        });
    };
    if($("#arquivos-filesedit")[0].files[0] != undefined){
        for (var i = 0; i < storedFilesfilesedit.length; i++) {
            var fileDatafilesedit = storedFilesfilesedit[i];
            formdatafilesedit.append('arquivos-files[]', fileDatafilesedit);
        };
        $auxnomefilesedit = removeAcentos((($("#razaosocialedit").val().toString()).toLowerCase()).replace(' ',''));
        formdatafilesedit.append('nome', $auxnomefilesedit);
        formdatafilesedit.append('tipo', 'empresa');
        $.ajax({
            type: 'POST',
            url: 'upload/uploadfiles.php',
            data: formdatafilesedit,
            processData: false,
            contentType: false,
            success: function (responseData, textStatus, jqXHR) {
                formfilesedit = $('#editaEmpresa')[0];
                formdatafilesedit = new FormData(formfilesedit);
                storedFilesfilesedit = [];
                filesArrfilesedit = '';
            },
        });
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
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
                $(":checkbox").prop('checked', false);
                $('#editaEmpresa').css('display', 'none');
                $('#editaEmpresaLoad').css('display', 'block');
            });
        },
        error: function(resp){console.log(resp.statusText);}
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
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar empresa*/ ?>

<? /*inicio listagem estados, cidades e segmentos*/ ?>
<script type="text/javascript">
async function listEstados(){
    await $.ajax({
        type: 'GET',
        url: urlApi+'listagemEstados',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var optionList = "";
            optionList += `
            <option disabled selected> UF </option>
            `;
            for (var i = 0; i < data.estados.length; i++) {
                optionList += `<option value="`+data.estados[i].id+`"> `+data.estados[i].nome+" - "+data.estados[i].uf+` </option>`;
            }
            optionList += `
            `;
            $("#uf").html(optionList);
            $("#ufedit").html(optionList);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
$(document).off("change","#uf").on("change","#uf", function () {listCidades($(this).val());});
$(document).off("change","#ufedit").on("change","#ufedit", function () {listCidades($(this).val());});
async function listCidades(idEstado){
    await $.ajax({
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
        error: function(resp){console.log(resp.statusText);}
    });
};
async function listSegmentos(){
    await $.ajax({
        type: 'GET',
        url: urlApi+'listagemSegmentos',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var optionList = "";
            optionList += `
            <option disabled selected> Segmento </option>
            `;
            for (var i = 0; i < data.segmentos.length; i++) {
                optionList += `<option value="`+data.segmentos[i].id+`"> `+data.segmentos[i].nome+` </option>`;
            }
            optionList += `
            `;
            $("#segmento").html(optionList);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
async function listFiscalizacoes(){
    await $.ajax({
        type: 'GET',
        url: urlApi+'listFiscalizacoes',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var optionList = "";
            optionList += `
            <option disabled selected> Fiscalização </option>
            `;
            for (var i = 0; i < data.fiscalizacoes.length; i++) {
                optionList += `<option value="`+data.fiscalizacoes[i].id+`"> `+data.fiscalizacoes[i].nome+` </option>`;
            }
            optionList += `
            `;
            $("#fiscalizacao").html(optionList);
        },
        error: function(resp){console.log(resp.statusText);}
    });
};
</script>
