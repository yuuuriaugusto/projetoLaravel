<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemPapeis() {
    $("#listaPapeis").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemPapel',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.papeis != undefined){
                dadosListagem = data.papeis;
            }else {
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemPapeis();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listPapeis = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listPapeis += `
            <div class="item">
            <div class="lista">
            <div class="listItem"><span>`+ dados[i].papel.nome + `</span></div>
            <div class="buttonItem"><a class="edita" id="edit" data-id="`+ dados[i].papel.id + `" type="submit"><i class="icon edit"></i></a></div>
            <div class="buttonItem"><a class="del" id="delPapeis" data-id="`+ dados[i].papel.id + `" type="submit"><i class="icon trash alternate"></i></a></div>
            </div>
            </div>
            `;
        }
    }else {
        listPapeis = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem pepeis cadastrados! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaPapeis").html(listPapeis);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Papeis</div>
<div class="botaoNovo"><a id="novoPapel">
    <i class="plus square outline icon"></i>Novo papel
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemPapeis();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem papel*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem"><span>Papel</span></div>
            <div class="buttonItem xsinvisible"><span>Editar</span></div>
            <div class="buttonItem xsinvisible"><span>Excluir</span></div>
        </div>
    </div>
    <div id="listaPapeis"></div>
</div>
<? /*fim listagem papel*/ ?>

<? /*incio novo papel*/ ?>
<div class="modal novoPapel">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de Papel </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroPapel">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o nome do papel" type="text" required id="nomePapel">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox">Setores</span>
                    <div class="filtro">
                        <a class="ordenar" title="Listar todos" id="listAll1"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll1"><i class="check icon"></i></a><input id="checkAllVerify1" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro1" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarSetores1"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll1").on("click", "#checkAll1", function () {
                        if ($("#checkAllVerify1").is(':checked')) {
                            $("#checkAllVerify1").prop('checked', false);
                            $(".checkBox1").prop('checked', false);
                        }else {
                            $("#checkAllVerify1").prop('checked', 'true');
                            $(".checkBox1").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll1").on("click", "#listAll1", function () {
                        $(".busca3").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro1").on("keypress", "#buscarFiltro1", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro1").val() == "") {
                            $(".busca3").removeClass("off");
                        }else{
                            $(".busca3").each(function() {
                                if (removeAcentos(($(this).data('nome').toString()).toLowerCase()).indexOf(removeAcentos($("#buscarFiltro1").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
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
$(document).off("click","#novoPapel").on("click","#novoPapel", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    }else {$(":checkbox").prop('checked', false);abreModal('novoPapel');}
});
$(document).off("submit","#cadastroPapel").on("submit","#cadastroPapel", function (e) {
    e.preventDefault();
    var setor = document.getElementsByName('setores1');
    var valoresetor = new Array();
    for (var i = 0; i < setor.length; i++) {
        if (setor[i].checked) {
            valoresetor.push(setor[i].value);
        }
    }
    var data = {
        "nome": $("#nomePapel").val(),
        "setores": valoresetor
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novoPapel',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemPapeis();
            abreModal('papelCadastrado');
            setTimeout(function () {
                $(":checkbox").prop('checked', false);
                $("#nomePapel").val("");
                fechaModal('papelCadastrado');
            }, 1000);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim novo papel*/ ?>

<? /*inicio editar papel*/ ?>
<div class="modal editaPapel">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Edição de Papel </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editaPapel">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o nome do papel" type="text" required id="nomePapeledit">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <span class="titulo-checkbox">Setores</span>
                    <div class="filtro">
                        <a class="ordenar" title="Listar todos" id="listAll2"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll2"><i class="check icon"></i></a><input id="checkAllVerify2" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro2" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarSetores2"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll2").on("click", "#checkAll2", function () {
                        if ($("#checkAllVerify2").is(':checked')) {
                            $("#checkAllVerify2").prop('checked', false);
                            $(".checkBox2").prop('checked', false);
                        }else {
                            $("#checkAllVerify2").prop('checked', 'true');
                            $(".checkBox2").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll2").on("click", "#listAll2", function () {
                        $(".busca2").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro2").on("keypress", "#buscarFiltro2", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro2").val() == "") {
                            $(".busca2").removeClass("off");
                        }else{
                            $(".busca2").each(function() {
                                if (removeAcentos(($(this).data('nome').toString()).toLowerCase()).indexOf(removeAcentos($("#buscarFiltro2").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
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
var nome = '';
$(document).off('click', "#edit").on('click', "#edit", function () {
    id = $(this).data('id');
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalhePapel/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.papel.nome;
                $("#nomePapeledit").val(nome);
                var teste = '';
                $(":checkbox").prop('checked', false);
                if (data.setores.length > 0) {
                    for (var i = 0; i < data.setores.length; i++) {
                        $("[data-setor=" + data.setores[i].id + "]").prop('checked', 'true');
                    }
                }
                abreModal('editaPapel');
            },
            error: function(resp){console.log(resp.statusText);}
        });
    }
});
$(document).off('submit',"#editaPapel").on('submit',"#editaPapel", function (e) {
    e.preventDefault();
    var setor = document.getElementsByName('setores2');
    var valoresetor = new Array();
    for (var i = 0; i < setor.length; i++) {
        if (setor[i].checked) {valoresetor.push(parseInt(setor[i].value));}
    }
    var data = {
        "nome": $("#nomePapeledit").val(),
        "setores": valoresetor
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'editarPapel/' + id,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemPapeis();
            localStorage.setItem('setores', JSON.stringify(data.setores));
            localStorage.setItem('papeis', JSON.stringify(data.papeis));
            $(".papelEditado").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                    $(":checkbox").prop('checked', false);
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim editar papel*/ ?>

<? /*inicio deletar papel*/ ?>
<div class="modal deletaPapel">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja deletar esse papel? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirPapel">
            <div class="botoes-rodape">
                <div class="cancelar">
                    <a onclick="fechaModal()"> Cancelar </a>
                </div>
                <div class="salvar deletar">
                    <button type="submit"><i class="icon save"></i> Deletar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var idDelete = 0;
$(document).off('click', "#delPapeis").on('click', "#delPapeis", function () {
    idDelete = $(this).data('id');
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        abreModal('deletaPapel');
    }
});
$(document).off('submit',"#excluirPapel").on('submit',"#excluirPapel", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarPapel/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            listagemPapeis();
            $(".papelExcluido").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar papel*/ ?>

<? /*inicio listagem setores*/ ?>
<script type="text/javascript">
var listarSetor1 = '';
var listarSetor2 = '';
var setoresAt = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagem',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        if(data.setores != undefined){
            for (var i = 0; i < data.setores.length; i++) {
                setoresAt = data.setores;
                listarSetor1 += `
                <div class="item itemBusca busca3" data-nome="`+ data.setores[i].nome + `">
                <input type="checkbox" class="checkBox1" name="setores1" value="`+ data.setores[i].id + `" data-setor="` + data.setores[i].id + `">
                <span>`+ data.setores[i].nome + `</span>
                </div>
                `;
                $(".listarSetores1").html(listarSetor1);
                listarSetor2 += `
                <div class="item itemBusca busca2" data-nome="`+ data.setores[i].nome + `">
                <input type="checkbox" class="checkBox2" name="setores2" value="`+ data.setores[i].id + `" data-setor="` + data.setores[i].id + `">
                <span>`+ data.setores[i].nome + `</span>
                </div>
                `;
                $(".listarSetores2").html(listarSetor2);
            };
        }else{
            listarSetor1 = `
                <div class="item">
                <input type="checkbox">
                <span>Sem setores cadastrados!</span>
                </div>
                `;
                $(".listarSetores1").html(listarSetor1);
                $(".listarSetores2").html(listarSetor1);
        };
    },
    error: function(resp){console.log(resp.statusText);}
});
</script>
<? /*fim listagem setores*/ ?>
