<script type="text/javascript">verificaLogin();</script>

<div class="titulo">
    Lista de Usuários
</div>
<div class="botaoNovo">
    <a id="novoUsuario">
        <i class="plus square outline icon"></i>
        Novo Usuário
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
            <div class="listItem x4">
                <span>Nome</span>
            </div>
            <div class="listItem x4">
                <span>Telefone</span>
            </div>
            <div class="listItem x4">
                <span>Usuário</span>
            </div>
            <div class="listItem x4">
                <span>Papéis</span>
            </div>
            <div class="buttonItem"></div>
            <div class="buttonItem"></div>
        </div>
    </div>
    <div id="listaUsuarios"></div>
    <script type="text/javascript">
    $.ajax({
        type: 'GET',
        url: urlApi+'listar',
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            var tabela = '';
            if (data.user.length > 0) {
                for (var i = 0; i < data.user.length; i++) {
                    tabela += `
                    <div class="item itemBusca busca1" data-id="`+ data.user[i].usuario.id + `" data-nome="`+ data.user[i].usuario.nome + `">
                    <div class="lista">
                    <div class="listItem x4">
                    <span data-nome="`+ data.user[i].usuario.nome + data.user[i].usuario.id +`">`+ data.user[i].usuario.nome + `</span>
                    </div>
                    <div class="listItem x4">
                    <span data-telefone="`+ data.user[i].usuario.telefone + data.user[i].usuario.id +`">`+ data.user[i].usuario.telefone + `</span>
                    </div>
                    <div class="listItem x4">
                    <span data-email="`+ data.user[i].usuario.email + data.user[i].usuario.id +`">`+ data.user[i].usuario.email + `</span>
                    </div>
                    <div class="listItem x4">
                    <span>Papeis</span>
                    </div>
                    <div class="buttonItem">
                    <a class="edita" id="edit" data-id="`+ data.user[i].usuario.id + `" type="submit"><i class="icon edit"></i></a>
                    </div>
                    <div class="buttonItem">
                    <a class="del" id="delUser" data-id="`+ data.user[i].usuario.id + `" type="submit"><i class="icon trash alternate"></i></a>
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
                <span> Sem usuários cadastrados </span>
                </div>
                </div>
                </div>
                `;
            }
            $("#listaUsuarios").html(tabela);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
    </script>
</div>
<div class="modal deletaUser">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Você tem certeza que deseja excluir esse usuário? </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="excluirUsuario">
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
var idDel = "";
$(document).off('click', "#delUser").on('click', "#delUser", function () {
    var pode = 0;
    idDel = $(this).data("id");
    if (validarPermissao('deletar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        abreModal('deletaUser');
    }
});
$(document).off('submit',"#excluirUsuario").on('submit',"#excluirUsuario", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'DELETE',
        url: urlApi+'deletar/' + idDel,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            $(".item").each(function() {
                if ($(this).data('id') == idDel) {
                    $(this).hide();
                }
            });
            $(".sucessoExcluirUser").fadeIn(function(){
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
<div class="modal editaUsuario">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Edição de Usuário </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="editarUsuario">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o nome do usuário" type="text" required id="nomecadEditar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Telefone</span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o telefone do usuário" type="text" id="telefonecadEditar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">E-mail</span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o e-mail do usuário" type="text" required id="emailcadEditar">
                            </div>
                        </div>
                        <div class="usuarioExistente">Usuário ja Existente!</div>
                    </div>
                </div>
            </div>
            <div class="conteudo">
                <a id="btnAlterarSenha" class="titulo-alteraSenha">alterar senha</a>
            </div>
            <script type="text/javascript">
            $(document).off("click","#btnAlterarSenha").on("click","#btnAlterarSenha", function(){
                if ($("#alterarSenha").text() == "") {
                    var inputs = `
                    <div class="col x3">
                    <div class="input-div">
                    <span class="titulo-input">Nova senha</span>
                    <div class="input">
                    <div class="icone">
                    <div class="bord"></div><i class="asterisk icon"></i>
                    <input placeholder="Informe a nova senha do usuário" type="password" required id="senhacadEditar">
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col x3">
                    <div class="input-div">
                    <span class="titulo-input">Confirmar senha</span>
                    <div class="input">
                    <div class="icone">
                    <div class="bord"></div><i class="asterisk icon"></i>
                    <input placeholder="Informe novamente a senha" type="password" required id="confirmarSenhaEditar">
                    </div>
                    </div>
                    <div class="validaSenha">O campo de senha deve ser igual ao de confirmar senha!</div>
                    </div>
                    </div>
                    <div class="col x3"></div>
                    `;
                    $("#alterarSenha").html(inputs);
                }else {
                    $("#alterarSenha").html("");
                }
            });
            </script>
            <div class="conteudo" id="alterarSenha"></div>
            <div class="conteudo">
                <div class="col x3">
                    <span class="titulo-checkbox">Papeis</span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Novo Papel" id="novoPapel"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll1"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll2"><i class="check icon"></i></a><input id="checkAllVerify2" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro1" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarPapel2"></div>
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
                    $(document).off("click", "#listAll1").on("click", "#listAll1", function () {
                        $(".busca2").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro1").on("keypress", "#buscarFiltro1", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro1").val() == "") {
                            $(".busca2").removeClass("off");
                        }else{
                            $(".busca2").each(function() {
                                if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro1").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
                <div class="col x3">
                    <span class="titulo-checkbox">Permissões</span>
                    <div class="filtro">
                        <a class="ordenar" title="Listar todos" id="listAll2"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll4"><i class="check icon"></i></a><input id="checkAllVerify4" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro2" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarPermissao2"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll4").on("click", "#checkAll4", function () {
                        if ($("#checkAllVerify4").is(':checked')) {
                            $("#checkAllVerify4").prop('checked', false);
                            $(".checkBox4").prop('checked', false);
                        }else {
                            $("#checkAllVerify4").prop('checked', 'true');
                            $(".checkBox4").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll2").on("click", "#listAll2", function () {
                        $(".busca3").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro2").on("keypress", "#buscarFiltro2", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro2").val() == "") {
                            $(".busca3").removeClass("off");
                        }else{
                            $(".busca3").each(function() {
                                if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro2").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
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
var id =0;
var nome ='';
var telefone ='';
var email ='';
$(document).off('click', "#edit").on('click', "#edit", function () {
    var pode = 0;
    id = $(this).data('id');
    if (validarPermissao('editar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else{
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheUser/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                nome = data.usuario.nome,
                telefone = data.usuario.telefone,
                email = data.usuario.email,
                $(":checkbox").prop('checked', false);
                $("#nomecadEditar").val(nome);
                $("#telefonecadEditar").val(telefone);
                $("#emailcadEditar").val(email);
                $("#senhacadEditar").val("");
                $("#confirmarSenhaEditar").val("");
                var teste = '';
                for (var i = 0; i < data.papels.length; i++) {
                    $("[data-papel=" + data.papels[i].id + "]").prop('checked', 'true');
                }
                for (var j = 0; j < data.permissoels.length; j++) {
                    $("[data-permi=" + data.permissoels[j].id + "]").prop('checked', 'true');
                }
            },
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
        abreModal('editaUsuario');
    }
});
$(document).off("submit","#editarUsuario").on("submit","#editarUsuario", function (e) {
    e.preventDefault();
    if ($("#senhacadEditar").val() == $("#confirmarSenhaEditar").val()) {
        var papeis = new Array();
        var permissoes = new Array();
        $(".papel2").each(function(){
            if($(this).is(':checked')){
                papeis.push($(this).val());
            }
        });
        $(".permissao2").each(function(){
            if($(this).is(':checked')){
                permissoes.push($(this).val())
            }
        });
        var datas = {
            "nome": $("#nomecadEditar").val(),
            "telefone": $("#telefonecadEditar").val(),
            "email": $("#emailcadEditar").val(),
            "password": $("#senhacadEditar").val(),
            "papels": papeis,
            "permissoes": permissoes
        };
        $.ajax({
            type: 'POST',
            url: urlApi+'atualizar/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datas,
            success: function (data2) {
                $("span").each(function() {
                    if ($(this).data("nome") == nome+id) {
                        $(this).html($("#nomecadEditar").val());
                    }
                    if ($(this).data("telefone") == telefone+id) {
                        $(this).html($("#telefonecadEditar").val());
                    }
                    if ($(this).data("email") == email+id) {
                        $(this).html($("#emailcadEditar").val());
                    }
                });
                $(".sucessoEditaUser").fadeIn(function(){
                    setTimeout(function () {
                        $(".modal").fadeOut();
                    }, 1500);
                });
                var usuarioLogado = JSON.parse(localStorage.getItem('usuario'));
                if (id == usuarioLogado.id) {
                    localStorage.setItem('setores', JSON.stringify(data2.setores));
                    localStorage.setItem('permissoes', JSON.stringify(data2.permissoes));
                    localStorage.setItem('papeis', JSON.stringify(data2.papeis));
                }
            },
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });

    } else {
        $(".validaSenha").fadeOut(function(){
            $(".validaSenha").fadeIn();
        });
    }
});
</script>
<script type="text/javascript">
var listarPapel1 = '';
var listarPapel2 = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagemPapel',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        for (var i = 0; i < data.papeis.length; i++) {
            listarPapel1 += `
            <div class="item itemBusca busca4" data-nome="`+ data.papeis[i].nome + `">
            <input type="checkbox" class="papel1 checkBox1" name="papeis" value="`+ data.papeis[i].id + `" data-papel="` + data.papeis[i].id + `">
            <span>`+ data.papeis[i].nome + `</span>
            </div>
            `;
            $(".listarPapel1").html(listarPapel1);
            listarPapel2 += `
            <div class="item itemBusca busca2" data-nome="`+ data.papeis[i].nome + `">
            <input type="checkbox" class="papel2 checkBox2" name="papeis" value="`+ data.papeis[i].id + `" data-papel="` + data.papeis[i].id + `">
            <span>`+ data.papeis[i].nome + `</span>
            </div>
            `;
            $(".listarPapel2").html(listarPapel2);
        }
    },
    error: function(){
        alert("Não foi possivel realizar a operação!");
    }
});
var listarPermissao1 = '';
var listarPermissao2 = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagemPermissoes',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        for (var i = 0; i < data.permissoes.length; i++) {
            listarPermissao1 += `
            <div class="item itemBusca busca5" data-nome="`+ data.permissoes[i].descricao + `">
            <input type="checkbox" class="permissao1 checkBox3" name="permissoes" value="`+ data.permissoes[i].id + `" data-permi="` + data.permissoes[i].id + `">
            <span>`+ data.permissoes[i].descricao + `</span>
            </div>
            `;
            $(".listarPermissao1").html(listarPermissao1);
            listarPermissao2 += `
            <div class="item itemBusca busca3" data-nome="`+ data.permissoes[i].descricao + `">
            <input type="checkbox" class="permissao2 checkBox4" name="permissoes" value="`+ data.permissoes[i].id + `" data-permi="` + data.permissoes[i].id + `">
            <span>`+ data.permissoes[i].descricao + `</span>
            </div>
            `;
            $(".listarPermissao2").html(listarPermissao2);
        }
    },
    error: function(){
        alert("Não foi possivel realizar a operação!");
    }
});
</script>
<div class="modal novoUsuario">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de Usuário </span>
            <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
        </div>
        <form class="form" id="cadastronovoUsuario">
            <div class="conteudo">
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Nome</span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o nome do usuário" type="text" required id="nomecad">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Senha</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe a senha do usuário" type="password" required id="senhacad">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">Telefone</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o telefone do usuário" type="text" required id="telefonecad">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">Confirmar senha</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe novamente a senha" type="password" required id="confirmarSenha">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                        <div class="validaSenha">O campo de senha deve ser igual ao de confirmar senha!</div>
                    </div>
                </div>
                <div class="col x3">
                    <div class="input-div">
                        <span class="titulo-input">E-mail</span>
                        <div class="input">
                            <div class="icone">
                                <input placeholder="Informe o e-mail do usuário" type="text" required id="emailcad">
                                <div class="bord"></div><i class="asterisk icon"></i>
                            </div>
                        </div>
                        <div class="usuarioExistente">Usuário ja Existente!</div>
                    </div>
                </div>
            </div>
            <div class="conteudo">
                <div class="col x3">
                    <span class="titulo-checkbox">Papeis</span>
                    <div class="filtro">
                        <a class="ordenar novo" title="Novo Papel" id="novoPapel"><i class="plus square outline icon"></i></a>
                        <a class="ordenar" title="Listar todos" id="listAll3"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll1"><i class="check icon"></i></a><input id="checkAllVerify1" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro3" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarPapel1"></div>
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
                    $(document).off("click", "#listAll3").on("click", "#listAll3", function () {
                        $(".busca4").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro3").on("keypress", "#buscarFiltro3", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro3").val() == "") {
                            $(".busca4").removeClass("off");
                        }else{
                            $(".busca4").each(function() {
                                if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro3").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
                </div>
                <div class="col x3">
                    <span class="titulo-checkbox">Permissões</span>
                    <div class="filtro">
                        <a class="ordenar" title="Listar todos" id="listAll4"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll3"><i class="check icon"></i></a><input id="checkAllVerify3" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro4" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarPermissao1"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll3").on("click", "#checkAll3", function () {
                        if ($("#checkAllVerify3").is(':checked')) {
                            $("#checkAllVerify3").prop('checked', false);
                            $(".checkBox3").prop('checked', false);
                        }else {
                            $("#checkAllVerify3").prop('checked', 'true');
                            $(".checkBox3").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll4").on("click", "#listAll4", function () {
                        $(".busca5").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro4").on("keypress", "#buscarFiltro4", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro4").val() == "") {
                            $(".busca5").removeClass("off");
                        }else{
                            $(".busca5").each(function() {
                                if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro4").val().toLowerCase())) != -1) {
                                    $(this).removeClass("off");
                                }else{
                                    $(this).addClass("off");
                                }
                            });
                        }
                    });
                    </script>
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
$(document).off("click","#novoUsuario").on("click","#novoUsuario", function () {
    $(":checkbox").prop('checked', false);
    $("#nomecad").val("");
    $("#telefonecad").val("");
    $("#emailcad").val("");
    $("#senhacad").val("");
    $("#confirmarSenha").val("");
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        abreModal('novoUsuario');
    }
});
$(document).off("submit","#cadastronovoUsuario").on("submit","#cadastronovoUsuario", function (e) {
    e.preventDefault();
    if ($("#senhacad").val() == $("#confirmarSenha").val()) {
        var papeis = new Array();
        var permissoes = new Array();
        $(".papel1").each(function(){
            if($(this).is(':checked')){
                papeis.push($(this).val());
            }
        });
        $(".permissao1").each(function(){
            if($(this).is(':checked')){
                permissoes.push($(this).val())
            }
        });
        var datas = {
            "nome": $("#nomecad").val(),
            "telefone": $("#telefonecad").val(),
            "email": $("#emailcad").val(),
            "password": $("#senhacad").val(),
            "papels": papeis,
            "permissoes": permissoes
        };
        $.ajax({
            type: 'POST',
            url: urlApi+'registrar',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datas,
            success: function (data) {
                $.ajax({
                    type: 'GET',
                    url: urlApi+'listar',
                    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                    dataType: 'json',
                    success: function (data2) {
                        for (var i = 0; i < data2.user.length; i++) {
                            if (data2.user[i].usuario.email == $("#emailcad").val()) {
                                var acrescimo = `
                                <div class="item itemBusca busca1" data-id="`+ data2.user[i].usuario.id + `" data-nome="`+ data2.user[i].usuario.nome + `">
                                <div class="lista">
                                <div class="listItem x4">
                                <span data-nome="`+ data2.user[i].usuario.nome + data2.user[i].usuario.id+ `">`+ data2.user[i].usuario.nome + `</span>
                                </div>
                                <div class="listItem x4">
                                <span data-telefone="`+ data2.user[i].usuario.telefone + data2.user[i].usuario.id+ `">`+ data2.user[i].usuario.telefone + `</span>
                                </div>
                                <div class="listItem x4">
                                <span data-email="`+ data2.user[i].usuario.email + data2.user[i].usuario.id+ `">`+ data2.user[i].usuario.email + `</span>
                                </div>
                                <div class="listItem x4">
                                <span>Papeis</span>
                                </div>
                                <div class="buttonItem">
                                <a class="edita" id="edit" data-id="`+ data2.user[i].usuario.id + `" type="submit"><i class="icon edit"></i></a>
                                </div>
                                <div class="buttonItem">
                                <a class="del" id="delUser" data-id="`+ data2.user[i].usuario.id + `" type="submit"><i class="icon trash alternate"></i></a>
                                </div>
                                </div>
                                </div>
                                `;
                            }
                        }
                        $("#listaUsuarios").append(acrescimo);
                    },
                    error: function(){
                        alert("Não foi possivel realizar a operação!");
                    }
                });
                abreModal('sucessoCadastroUser');
                setTimeout(function () {
                    $(".validaSenha").fadeOut();
                    $(".usuarioExistente").fadeOut();
                    $(":checkbox").prop('checked', false);
                    $("#nomecad").val("");
                    $("#telefonecad").val("");
                    $("#emailcad").val("");
                    $("#senhacad").val("");
                    $("#confirmarSenha").val("");
                    fechaModal('sucessoCadastroUser');
                }, 1000);
            },
            error: function (){
                $(".usuarioExistente").fadeOut(function(){
                    $(".usuarioExistente").fadeIn();
                });
            },
        });
    } else {
        $(".validaSenha").fadeOut(function(){
            $(".validaSenha").fadeIn();
        });
    }
});
</script>










<div class="modal novoPapel">
    <div class="content-modal">
        <div class="titulo-modal">
            <span class="titulo"> Cadastro de Papel </span>
            <a class="close" onclick="fechaModal('novoPapel')"><i class="close icon"></i></a>
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
                        <a class="ordenar" title="Listar todos" id="listAll6"><i class="list icon"></i></a>
                        <a class="ordenar" title="Selecionar todos" id="checkAll6"><i class="check icon"></i></a><input id="checkAllVerify6" type="checkbox" hidden>
                        <div class="ordenar busca"><input class="buscaInput" id="buscarFiltro6" placeholder="Buscar..." type="search"><i class="search icon"></i></div>
                    </div>
                    <div class="boxlista listarSetores1"></div>
                    <script type="text/javascript">
                    $(document).off("click", "#checkAll6").on("click", "#checkAll6", function () {
                        if ($("#checkAllVerify6").is(':checked')) {
                            $("#checkAllVerify6").prop('checked', false);
                            $(".checkBox6").prop('checked', false);
                        }else {
                            $("#checkAllVerify6").prop('checked', 'true');
                            $(".checkBox6").prop('checked', 'true');
                        }
                    });
                    $(document).off("click", "#listAll6").on("click", "#listAll6", function () {
                        $(".busca6").removeClass("off");
                    });
                    $(document).off("keypress", "#buscarFiltro6").on("keypress", "#buscarFiltro6", function (e) {
                        if(e.keyCode === 13) {
                            event.preventDefault();
                        }
                        if ($("#buscarFiltro6").val() == "") {
                            $(".busca6").removeClass("off");
                        }else{
                            $(".busca6").each(function() {
                                if (removeAcentos($(this).data('nome').toLowerCase()).indexOf(removeAcentos($("#buscarFiltro6").val().toLowerCase())) != -1) {
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
                    <a onclick="fechaModal('novoPapel')"> Cancelar </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
var listarSetor1 = '';
var setoresAt = '';
$.ajax({
    type: 'GET',
    url: urlApi+'listagem',
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        for (var i = 0; i < data.setores.length; i++) {
            setoresAt = data.setores;
            listarSetor1 += `
            <div class="item itemBusca busca6" data-nome="`+ data.setores[i].nome + `">
            <input type="checkbox" class="checkBox6" name="setores1" value="`+ data.setores[i].id + `" data-setor="` + data.setores[i].id + `">
            <span>`+ data.setores[i].nome + `</span>
            </div>
            `;
            $(".listarSetores1").prepend(listarSetor1);
        }
    },
    error: function(){
        alert("Não foi possivel realizar a operação!");
    }
});
$(document).off("click","#novoPapel").on("click","#novoPapel", function () {
    if (validarPermissao('criar') != true) {
        abreModal('semPermisao');
        setTimeout(function () {
            $(".semPermisao").fadeOut();
        }, 1500);
    } else {
        $(":checkbox").prop('checked', false);
        abreModal('novoPapel');
    }
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
            $.ajax({
                type: 'GET',
                url: urlApi+'listagemPapel',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                success: function (data2) {
                    var listarPapel1 = "";
                    var listarPapel2 = "";
                    for (var i = 0; i < data2.papeis.length; i++) {
                        if (data2.papeis[i].nome == $("#nomePapel").val()) {
                            listarPapel1 += `
                            <div class="item itemBusca busca4" data-nome="`+ data2.papeis[i].nome + `">
                            <input type="checkbox" class="papel1 checkBox1" name="papeis" value="`+ data2.papeis[i].id + `" data-papel="` + data2.papeis[i].id + `">
                            <span>`+ data2.papeis[i].nome + `</span>
                            </div>
                            `;
                            listarPapel2 += `
                            <div class="item itemBusca busca2" data-nome="`+ data2.papeis[i].nome + `">
                            <input type="checkbox" class="papel2 checkBox2" name="papeis" value="`+ data2.papeis[i].id + `" data-papel="` + data2.papeis[i].id + `">
                            <span>`+ data2.papeis[i].nome + `</span>
                            </div>
                            `;
                        }
                    }
                    if (data2.papeis.length == 1) {
                        $(".listarPapel1").html(listarPapel1);
                        $(".listarPapel2").html(listarPapel2);
                    }else {
                        $(".listarPapel1").prepend(listarPapel1);
                        $(".listarPapel2").prepend(listarPapel2);
                    }
                },
                error: function(){
                    alert("Não foi possivel realizar a operação!");
                }
            });
            abreModal('papelCadastrado');
            setTimeout(function () {
                $(":checkbox").prop('checked', false);
                $("#nomePapel").val("");
                fechaModal('papelCadastrado');
                fechaModal('novoPapel');
            }, 1000);
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
});
</script>
