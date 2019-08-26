<script type="text/javascript">verificaLogin();</script>

<div class="titulo">
    Lista de Funcionários
</div>
<div class="botaoNovo">
    <a id="novoFuncionario">
        <i class="plus square outline icon"></i>
        Novo Funcionário
    </a>
</div>
<div class="filtro listagens">
    <a class="ordenar" title="Listar todos" id="listAll"><i class="list icon"></i></a>
    <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
</div>
<script type="text/javascript">
$(document).off("click", "#listAll").on("click", "#listAll", function () {
    $(".busca1").removeClass("off");
});
$(document).off("keypress", "#buscarFiltro").on("keypress", "#buscarFiltro", function (e) {
    if(e.keyCode === 13) {
        event.preventDefault();
    }
    if ($("#buscarFiltro").val() == "") {
        $(".busca1").removeClass("off");
    }else{
        $(".busca1").each(function() {
            if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro").val().toLowerCase())) != -1) {
                $(this).removeClass("off");
            }else{
                $(this).addClass("off");
            }
        });
    }
});
</script>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem x2">
                <span>Nome</span>
            </div>
            <div class="listItem x2">
                <span>CPF</span>
            </div>
            <div class="buttonItem">
                <span>Excluir</span>
            </div>
        </div>
    </div>
    <div id="listaFuncionarios"></div>
    <script type="text/javascript">
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemFuncionario',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var tabela = '';
            if (data.funcionario.length > 0) {
                for (var i = 0; i < data.funcionario.length; i++) {
                    tabela += `
                    <div class="item itemBusca busca1" data-id="`+ data.funcionario[i].id + `" data-nome="`+ data.funcionario[i].nome + `">
                    <div class="lista">
                    <div class="listItem x2">
                    <span>`+ data.funcionario[i].nome + `</span>
                    </div>
                    <div class="listItem x2">
                    <span>`+ data.funcionario[i].cpf + `</span>
                    </div>
                    <div class="buttonItem">
                    <a class="del" data-id="`+ data.funcionario[i].id + `" type="submit"><i class="icon trash alternate"></i></a>
                    </div>
                    </div>
                    </div>
                    `;
                }
            }else{
                tabela += `
                <div class="item">
                <div class="lista">
                <div class="listItem">
                <span> Sem funcionários cadastrados </span>
                </div>
                </div>
                </div>
                `;
            }
            $("#listaFuncionarios").html(tabela);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
    </script>
</div>
<div class="modal novoFuncionario">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro novo processo </span>
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
    } else {
        abreModal('novoFuncionario');
    }
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
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemFuncionario',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data2) {
                    for (var i = 0; i < data2.funcionario.length; i++) {
                        if (data2.funcionario[i].nome == $("#nomeFuncionario").val() && data2.funcionario[i].cpf == $("#cpfFuncionario").val()) {
                            acrescimo = `
                            <div class="item itemBusca busca1" data-id="`+ data2.funcionario[i].id + `" data-nome="`+ data2.funcionario[i].nome + `">
                            <div class="lista">
                            <div class="listItem x2">
                            <span>`+ data2.funcionario[i].nome + `</span>
                            </div>
                            <div class="listItem x2">
                            <span>`+ data2.funcionario[i].cpf + `</span>
                            </div>
                            <div class="buttonItem">
                            <a class="del" data-id="`+ data2.funcionario[i].id + `" type="submit"><i class="icon trash alternate"></i></a>
                            </div>
                            </div>
                            </div>
                            `;
                        }
                    }
                    if (data2.funcionario.length == 1) {
                        $("#listaFuncionarios").html(acrescimo);
                    }else {
                        $("#listaFuncionarios").prepend(acrescimo);
                    }
                },
                error: function(){
                    alert("Não foi possivel realizar a operação!");
                }
            });
            abreModal('sucessoCadastrarFunc');
            setTimeout(function () {
                $("#nomeFuncionario").val("");
                $("#cpfFuncionario").val("");
                fechaModal('sucessoCadastrarFunc');
            }, 1500);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>
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
            $(".item").each(function() {
                if ($(this).data('id') == idDelete) {
                    $(this).hide();
                }
            });
            $(".sucessoExcluirFunc").fadeIn(function(){
                setTimeout(function () {
                    $(".modal").fadeOut();
                }, 1500);
            });
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>
