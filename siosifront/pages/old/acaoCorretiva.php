<script type="text/javascript">verificaLogin();</script>
<div class="titulo">
    Ações Corretivas
</div>
<div class="botaoNovo">
    <a id="novaAcaoCorretiva">
        <i class="plus square outline icon"></i>
        Nova ação corretiva
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
            <div class="listItem x3">
                <span>Ações Corretivas</span>
            </div>
            <div class="listItem x3">
                <span>Descrição</span>
            </div>
            <div class="listItem x3">
                <span>Tempo</span>
            </div>
            <div class="buttonItem">
                <span>Editar</span>
            </div>
            <div class="buttonItem">
                <span>Excluir</span>
            </div>
        </div>
    </div>
    <div id="listagemAcaoCorretiva"></div>
    <script type="text/javascript">
    $.ajax({
        type: 'GET',
        url: urlApi+'listagemAcaoCorretiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var tabela = '';
            if (data.acoescorretivas.length > 0) {
                for (var i = 0; i < data.acoescorretivas.length; i++) {
                    tabela = `
                    <div class="item itemBusca busca1" data-id="`+ data.acoescorretivas[i].id + `" data-nome="`+ data.acoescorretivas[i].nome + `">
                    <div class="lista">
                    <div class="listItem x3">
                    <span data-nome="`+ data.acoescorretivas[i].nome + data.acoescorretivas[i].id + `">`+ data.acoescorretivas[i].nome + `</span>
                    </div>
                    <div class="listItem x3">
                    <span data-descricao="`+ data.acoescorretivas[i].descricao + data.acoescorretivas[i].id + `">`+ data.acoescorretivas[i].descricao + `</span>
                    </div>
                    <div class="listItem x3">
                    <span data-tempo="`+ data.acoescorretivas[i].descricao + data.acoescorretivas[i].id + `">`+ data.acoescorretivas[i].tempo + `</span>
                    </div>
                    <div class="buttonItem">
                    <a data-id="`+ data.acoescorretivas[i].id + `" class="edita editACeditar" type="submit"><i class="icon edit"></i></a>
                    </div>
                    <div class="buttonItem">
                    <a class="del" data-id="`+ data.acoescorretivas[i].id + `" type="submit"><i class="icon trash alternate"></i></a>
                    </div>
                    </div>
                    </div>
                    `;
                    $("#listagemAcaoCorretiva").append(tabela);
                }
            }else{
                tabela = `
                <div class="item">
                <div class="lista">
                <div class="listItem">
                <span>Sem ações corretivas cadastradas</span>
                </div>
                </div>
                </div>
                `;
                $("#listagemAcaoCorretiva").append(tabela);
            }
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
</script>
</div>
<div class="modal novaAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de ações corretivas </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastroAcaoCorretiva">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input id="nome" placeholder="Informe o nome" type="text" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricao" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Tempo para Correção1</span>
                        <div class="input">
                            <div class="icone time2">
                                <select id="mudaTipoSelect2">
                                    <option selected value="horas"> Horas </option>
                                    <option value="dias"> Dias </option>
                                </select>
                                <script>
                                $(document).off("change","#mudaTipoSelect2").on("change","#mudaTipoSelect2",function(){
                                    if ($(this).val() == "horas"){$("#tempo").prop("type", "time");}
                                    if ($(this).val() == "dias"){$("#tempo").prop("type", "number");}
                                });
                                </script>
                            </div>
                            <div class="icone time1">
                                <input id="tempo" placeholder="0" type="time" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
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
$(document).off("click","#novaAcaoCorretiva").on("click","#novaAcaoCorretiva", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        abreModal('novaAcaoCorretiva');
    }
});
$(document).off('submit',"#cadastroAcaoCorretiva").on('submit',"#cadastroAcaoCorretiva", function (e) {
    e.preventDefault();
    var tempoConvertido = "";
    if($("#mudaTipoSelect").val() == "horas"){
        tempoConvertido = $("#tempo").val();
    }
    if($("#mudaTipoSelect").val() == "dias"){
        tempoConvertido = ($("#tempo").val()*24)+":00";
    }
    var data = {
        "nome": $("#nome").val(),
        "descricao": $("#descricao").val(),
        "tempo": tempoConvertido+":00"
    };
    $.ajax({
        type: 'POST',
        url: urlApi+'novaAcaoCorretiva',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        data: data,
        success: function (data) {
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemAcaoCorretiva',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data2) {
                    var acrescimo = "";
                    for (var i = 0; i < data2.acoescorretivas.length; i++) {
                        if (data2.acoescorretivas[i].nome == $("#nome").val() && data2.acoescorretivas[i].descricao == $("#descricao").val()) {
                            acrescimo = `
                            <div class="item itemBusca busca1" data-id="`+ data2.acoescorretivas[i].id + `" data-nome="`+ data2.acoescorretivas[i].nome + `">
                            <div class="lista">
                            <div class="listItem x3">
                            <span data-nome="`+ data2.acoescorretivas[i].nome +data2.acoescorretivas[i].id + `">`+ data2.acoescorretivas[i].nome + `</span>
                            </div>
                            <div class="listItem x3">
                            <span data-descricao="`+ data2.acoescorretivas[i].descricao +data2.acoescorretivas[i].id + `">`+ data2.acoescorretivas[i].descricao + `</span>
                            </div>
                            <div class="listItem x3">
                            <span data-tempo="`+ data2.acoescorretivas[i].descricao +data2.acoescorretivas[i].id + `">`+ data2.acoescorretivas[i].tempo + `</span>
                            </div>
                            <div class="buttonItem">
                            <a data-id="`+ data2.acoescorretivas[i].id + `" class="edita editACeditar" type="submit"><i class="icon edit"></i></a>
                            </div>
                            <div class="buttonItem">
                            <a class="del" data-id="`+ data2.acoescorretivas[i].id + `" type="submit"><i class="icon trash alternate"></i></a>
                            </div>
                            </div>
                            </div>
                            `;
                        }
                    }
                    if (data2.acoescorretivas.length == 1) {
                        $("#listagemAcaoCorretiva").html(acrescimo);
                    }else {
                        $("#listagemAcaoCorretiva").prepend(acrescimo);
                    }
                }
            });
            abreModal('sucessoCadastroAC');
            setTimeout(function () {
                $("#nome").val("");
                $("#descricao").val("");
                $("#tempo").val("");
                fechaModal('sucessoCadastroAC');
            }, 1000);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>
<div class="modal editaAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Edição de ação corretiva </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editaAcaoCorretiva">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o nome" type="text" required id="nomeEditar">
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Descrição</span>
                        <div class="input">
                            <div class="icone">
                                <textarea id="descricaoEditar" placeholder="Informe a descrição" rows="1" required onkeyup="auto_grow(this)"></textarea>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Tempo para Correção</span>
                        <div class="input">
                            <div class="icone time2">
                                <select id="mudaTipoSelect">
                                    <option selected value="horas"> Horas </option>
                                    <option value="dias"> Dias </option>
                                </select>
                                <script>
                                $(document).off("change","#mudaTipoSelect").on("change","#mudaTipoSelect",function(){
                                    if ($(this).val() == "horas"){$("#descricaotempo").prop("type", "time");}
                                    if ($(this).val() == "dias"){$("#descricaotempo").prop("type", "number");}
                                });
                                </script>
                            </div>
                            <div class="icone time1">
                                <input id="descricaotempo" placeholder="0" type="time" required>
                                <div class="bord"></div>
                                <i class="asterisk icon"></i>
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
        <script type="text/javascript">
        var id = 0;
        var nome = '';
        var descricao = '';
        var tempo = '';
        $(document).off('click', ".editACeditar").on('click', ".editACeditar", function () {
            id = $(this).data('id');
            if (validarPermissao('editar') != true) {
                abreModal('semPermisao');
                setTimeout(function () {
                    $(".semPermisao").fadeOut();
                }, 1500);
            }else {
                $.ajax({
                    type: 'GET',
                    url: urlApi+'detalheAcaoCorretiva/' + id,
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    success: function (data) {
                        nome = data.acaocorretiva.nome;
                        descricao = data.acaocorretiva.descricao;
                        tempo = data.acaocorretiva.tempo;
                        $("#nomeEditar").val(nome);
                        $("#descricaoEditar").val(descricao);
                        if (parseInt(tempo.split(":", 1)) >= 24) {
                            $('#mudaTipoSelect option[value=dias]').attr('selected','selected');
                            $("#descricaotempo").prop("type", "number");
                            $("#descricaotempo").val(parseInt(tempo.split(":", 1))/24);
                        }else {
                            $('#mudaTipoSelect option[value=horas]').attr('selected','selected');
                            $("#descricaotempo").prop("type", "time");
                            $("#descricaotempo").val(tempo);

                        }
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
                abreModal('editaAcaoCorretiva');
            }
        });
        $(document).off('submit', "#editaAcaoCorretiva").on('submit', "#editaAcaoCorretiva", function (e) {
            e.preventDefault();
            var tempoConvertido = "";
            if($("#mudaTipoSelect").val() == "horas"){
                tempoConvertido = $("#descricaotempo").val();
                if (tempoConvertido.length == 5) {
                    tempoConvertido += ":00";
                }
            }
            if($("#mudaTipoSelect").val() == "dias"){
                tempoConvertido = ($("#descricaotempo").val()*24)+":00:00";
            }
            var data = {
                "nome": $("#nomeEditar").val(),
                "descricao": $("#descricaoEditar").val(),
                "tempo": tempoConvertido
            };
            $.ajax({
                type: 'POST',
                url: urlApi+'editarAcaoCorretiva/' + id,
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                data: data,
                success: function (data) {
                    $("span").each(function() {
                        if ($(this).data("nome") == nome+id) {
                            $(this).html($("#nomeEditar").val());
                        }
                        if ($(this).data("descricao") == descricao+id) {
                            $(this).html($("#descricaoEditar").val());
                        }
                        if ($(this).data("tempo") == descricao+id) {
                            $(this).html(tempoConvertido);
                        }
                    });
                    $(".sucessoEditaAC").fadeIn(function(){
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
    </div>
</div>
<div class="modal deletarAcaoCorretiva">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você realmente deseja deletar essa ação corretiva? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="deletarAcaoCorretiva">
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
var id = 0;
var nome = '';
var descricao = '';
$(document).off('click', ".del").on('click', ".del", function () {
    idDelete = $(this).data('id');
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        abreModal('deletarAcaoCorretiva');
    }
});
$(document).off('submit',"#deletarAcaoCorretiva").on('submit',"#deletarAcaoCorretiva", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletarAcaoCorretiva/' + idDelete,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $(".item").each(function() {
                if ($(this).data('id') == idDelete) {
                    $(this).hide();
                }
            });
            $(".sucessoInativaAC").fadeIn(function(){
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
