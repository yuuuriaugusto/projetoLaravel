<script type="text/javascript">verificaLogin();</script>

<? /*inicio paginacao*/ ?>
<script type="text/javascript">
var dadosListagem = [];
var paginacao = {tamanhoPagina:20,pagina:0};
function listagemFuncionarios() {
    $("#listaFuncionarios").html("<div class='loading-gif'><img src='img/loading.gif'></div>");
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemFuncionario',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            if(data.funcionarios != undefined){
                dadosListagem = data.funcionarios;
            }else {
                dadosListagem = data;
            };
            paginar(dadosListagem,paginacao);
        },
        error: function(resp){console.log(resp.statusText);}
    });
}
listagemFuncionarios();
function paginar(dados,usepaginacao) {
    PaginacaoNumeracao(dados,usepaginacao);
    var listFuncionarios = "";
    if (dados.length > 0) {
        for (var i = usepaginacao.pagina * usepaginacao.tamanhoPagina; i < dados.length && i < (usepaginacao.pagina + 1) *  usepaginacao.tamanhoPagina; i++) {
            listFuncionarios += `
            <div class="item">
            <div class="lista">
            <div class="listItem x2"><span>`+ dados[i].funcionario.nome + `</span></div>
            <div class="listItem x2 xsinvisible"><span>`+ dados[i].funcionario.cpf + `</span></div>
            <div class="buttonItem"><a class="del" data-id="`+ dados[i].funcionario.id + `" type="submit"><i class="icon trash alternate"></i></a></div>
            </div>
            </div>
            `;
        }
    }else {
        listFuncionarios = `
        <div class="item">
        <div class="lista">
        <div class="listItem">
        <span> Sem funcionarios cadastrados! </span>
        </div>
        </div>
        </div>
        `;
    }
    $("#listaFuncionarios").html(listFuncionarios);
}
</script>
<? /*fim paginacao*/ ?>

<div class="titulo">Lista de Funcionários</div>
<div class="botaoNovo"><a id="novoFuncionario">
    <i class="plus square outline icon"></i>Novo Funcionário
</a></div>

<? /*inicio filtro*/ ?>
<div class="filtro">
    <a class="ordenar paginacao"><input class="PaginacaoItens" title="Itens por Página" onchange="javascript:PaginacaoItens(this.value,dadosListagem,paginacao);" type="number" min="1" max="99"></a>
    <a onclick="javascript:PaginacaoAnterior(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoAnterior" title="Página Anterior"> <i class="icon caret left"></i></a>
    <span class="ordenar paginacao PaginacaoNumeracao"></span>
    <a onclick="javascript:PaginacaoProximo(dadosListagem,paginacao);" class="ordenar paginacao PaginacaoProximo" title="Próxima Página"> <i class="icon caret right"></i> </a>
    <a class="ordenar" title="Listar todos" onclick="javascript:listagemFuncionarios();"><i class="list icon"></i></a>
    <div class="ordenar busca"><input onkeyup="javascript:PaginacaoBusca(this.value,dadosListagem,paginacao);" class="buscaInput buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<? /*fim filtro*/ ?>

<? /*inicio listagem funcionario*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x2"><span>Nome</span></div>
            <div class="listItem x2 xsinvisible"><span>CPF</span></div>
            <div class="buttonItem xsinvisible"><span>Excluir</span></div>
        </div>
    </div>
    <div id="listaFuncionarios"></div>
</div>
<? /*fim listagem funcionario*/ ?>

<? /*incio novo funcionario*/ ?>
<div class="modal novoFuncionario">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo Funcionario </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastronovoFuncionario">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o nome do funcionário" type="text" required id="nomeFuncionario">
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">CPF</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o CPF do funcionário" type="text" required id="cpfFuncionario">
                                <script type="text/javascript">$("#cpfFuncionario").mask("999.999.999-99");</script>
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3"></div>
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
$(document).off("click","#novoFuncionario").on("click","#novoFuncionario", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {abreModal('novoFuncionario');}
});
$(document).off("submit","#cadastronovoFuncionario").on("submit","#cadastronovoFuncionario", function (e) {
    e.preventDefault();
    var acrescimo;
    var data = {
        "nome": $("#nomeFuncionario").val(),
        "cpf": $("#cpfFuncionario").val(),
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novaFuncionario',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            listagemFuncionarios();
            abreModal('sucessoCadastrarFunc');
            setTimeout(function () {
                $("#nomeFuncionario").val("");
                $("#cpfFuncionario").val("");
                fechaModal('sucessoCadastrarFunc');
            }, 1500);
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim novo funcionario*/ ?>

<? /*inicio deletar funcionario*/ ?>
<div class="modal deletarFuncionario">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse funcionário? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="deletarFuncionario">
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
var id = 0;
$(document).off('click', ".del").on('click', ".del", function () {
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        idDelete = $(this).data("id");
        abreModal('deletarFuncionario');
    }
});
$(document).off("submit","#deletarFuncionario").on("submit","#deletarFuncionario", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarFuncionario/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            listagemFuncionarios();
            $(".sucessoExcluirFunc").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(resp){console.log(resp.statusText);}
    });
});
</script>
<? /*fim deletar funcionario*/ ?>
