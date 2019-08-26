<script type="text/javascript">verificaLogin();</script>

<div class="minha-conta">
    <script type="text/javascript">var usuarioLogado = JSON.parse(localStorage.getItem('usuario'));</script>
    <div class="icone-imagem">
        <!-- <i class="icon user"></i> -->
        <img src="img/user.jpg">
    </div>
    <div class="info-perfil">
        <div class="table">
            <div class="nome" id="nomeUser">
                <span id="usuarioLogado-nome"></span>
                <a class="editar" id="edit" data-id=""><i class="icon edit"></i>editar</a>
            </div>
            <div class="permissoes" id="permissoesUser">
                <script type="text/javascript">
                var usuarioPermissoes = JSON.parse(localStorage.getItem('permissoes'));
                var divPermissoes = "";
                if (usuarioPermissoes.length > 0) {
                    divPermissoes += `
                    <span class="item-list titulo-lista"> Permissões </span>
                    `;
                    for (var i = 0; i < usuarioPermissoes.length; i++) {
                        divPermissoes += `
                        <span class="item-list"><i class="icon caret right"></i>`+usuarioPermissoes[i].descricao+`</span>
                        `;
                    }
                }
                $("#permissoesUser").append(divPermissoes);
                </script>
            </div>
            <div class="contato">
                <div class="tab"><span id="usuarioLogado-email"></span><i class="icon mail"></i></div>
                <div class="tab"><span id="usuarioLogado-telefone"></span><i class="icon phone"></i></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#edit").data("id",usuarioLogado.id);
$("#usuarioLogado-nome").html(usuarioLogado.nome);
$("#usuarioLogado-telefone").html(usuarioLogado.telefone);
$("#usuarioLogado-email").html(usuarioLogado.email);
</script>
<div class="titulo">
    Histórico de Auditorias:
</div>
<div class="filtro">
    <a class="ordenar paginacao"><input title="Itens por Página" id="PaginacaoItens" type="number" min="1" max="99" value="10"></a>
    <a class="ordenar paginacao" id="PaginacaoAnterior" disabled title="Página Anterior"> <i class="icon caret left"></i> </a>
    <span class="ordenar paginacao" id="PaginacaoNumeracao"></span>
    <a class="ordenar paginacao" id="PaginacaoProximo" disabled title="Próxima Página"> <i class="icon caret right"></i> </a>
</div>
<div class="listagem">
    <div class="item">
        <div class="topo">

            <div class="listItem alertIcon">
                <i title="Ordenar por Data" value="Desc" data-ordem="Desc" id="PaginacaoOrdemData" class="paginacaoOrdem icon sort numeric down"></i>
            </div>
            <div class="listItem x3">
                <span>Data</span>
            </div>
            <div class="listItem x3">
                <span>Setor</span>
            </div>
            <div class="listItem x3">
                <span>Processo</span>
            </div>
            <div class="buttonItem">
                <span></span>
            </div>
        </div>
    </div>
    <div id="listAuditoriasUser">
        <div class="item">
            <div class="lista">
                <div class="listItem">
                    <span> Sem registros! </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$.ajax({
    type: 'GET',
    url: urlApi+'listAuditoriasUser/'+ usuarioLogado.id,
    headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
    dataType: 'json',
    success: function (data) {
        var tamanhoPagina = 10;
        var pagina = 0;
        var dados = data.auditorias;
        function paginar() {
            if (dados.length > 0) {
                var listAuditorias = "";
                $('#listAuditoriasUser').html("");
                for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
                    var tipoItem = "";
                    var confOuNao = "";
                    var Processo = "";
                    var Setor = "";
                    // var confOuNao = "conforme";
                    var confOuNaoIcon = "check";
                    if (data.auditorias[i].fichas.FichaItensConf.length > 0) {
                        tipoItem = "conf";
                        for (var j = 0; j < data.auditorias[i].fichas.FichaItensConf.length; j++) {
                            if (data.auditorias[i].fichas.FichaItensConf[j].ficha.reaudita != null && data.auditorias[i].fichas.FichaItensConf[j].ficha.conforme == 1 && confOuNao != "naoconforme") {
                                confOuNao = "reauditado";
                                confOuNaoIcon = "exclamation";
                            }
                            if (data.auditorias[i].fichas.FichaItensConf[j].ficha.reaudita == null && data.auditorias[i].fichas.FichaItensConf[j].ficha.conforme == 0) {
                                confOuNao = "naoconforme";
                                confOuNaoIcon = "exclamation triangle";
                            }
                            Processo = data.auditorias[i].fichas.FichaItensConf[j].itens.processosetores.processo[0].nome;
                            Setor = data.auditorias[i].fichas.FichaItensConf[j].itens.processosetores.setor[0].nome;
                        }
                    }
                    if (dados[i].fichas.FichaItensTemp.length > 0) {
                        tipoItem = "temp";
                        for (var j = 0; j < dados[i].fichas.FichaItensTemp.length; j++) {
                            if (dados[i].fichas.FichaItensTemp[j].ficha.reaudita != null && dados[i].fichas.FichaItensTemp[j].ficha.conforme == 1 && confOuNao != "naoconforme") {
                                confOuNao = "reauditado";
                                confOuNaoIcon = "exclamation";
                            }
                            if (dados[i].fichas.FichaItensTemp[j].ficha.reaudita == null && dados[i].fichas.FichaItensTemp[j].ficha.conforme == 0) {
                                confOuNao = "naoconforme";
                                confOuNaoIcon = "exclamation triangle";
                            }
                            Processo = data.auditorias[i].fichas.FichaItensTemp[j].itens.processosetores.processo[0].nome;
                            Setor = data.auditorias[i].fichas.FichaItensTemp[j].itens.processosetores.setor[0].nome;
                        }
                    }
                    listAuditorias = `
                    <div class="item `+confOuNao+`">
                    <div class="lista">
                    <div class="listItem alertIcon">
                    <i class="`+confOuNaoIcon+` icon"></i>
                    </div>
                    <div class="listItem x3">
                    <span>`+dados[i].auditoria.created_at+`</span>
                    </div>
                    <div class="listItem x3">
                    <span>`+Setor+`</span>
                    </div>
                    <div class="listItem x3">
                    <span>`+Processo+`</span>
                    </div>
                    <div class="buttonItem">
                    <a class="edita verDetalhes" data-tipo="`+tipoItem+`" data-id="`+dados[i].auditoria.id+`"><i class="icon eye"></i></a>
                    </div>
                    </div>
                    </div>
                    `;
                    $('#listAuditoriasUser').append(listAuditorias);
                }
                $('#PaginacaoNumeracao').text((pagina+1)+' - '+Math.ceil(dados.length/tamanhoPagina));
            }
        }
        $(function() {
            $('#PaginacaoProximo').click(function() {
                if (pagina < dados.length / tamanhoPagina - 1) {
                    pagina++;
                    paginar();
                }
            });
            $('#PaginacaoAnterior').click(function() {
                if (pagina > 0) {
                    pagina--;
                    paginar();
                }
            });
            $('#PaginacaoItens').change(function() {
                tamanhoPagina = parseInt($(this).val());
                if (tamanhoPagina*pagina >= dados.length && pagina > 0) {
                    pagina--;
                }
                paginar();
            });
            $('#PaginacaoOrdemData').click(function() {
                if ($(this).val() == "Desc") {
                    dados.sort(ordenarPorDataAsc);
                    $(this).val('Asc');
                    $(this).removeClass('up');
                    $(this).addClass('down');
                }else{
                    dados.sort(ordenarPorDataDesc);
                    $(this).val('Desc');
                    $(this).removeClass('down');
                    $(this).addClass('up');
                }
                paginar();
            });
            paginar();
        });
    }
});

</script>












<div class="modal historicoConf">
    <div class="content-modal">
        <div id="listItensAuditoria"></div>
    </div>
</div>
<script type="text/javascript">
$(document).off("click",".verDetalhes").on("click",".verDetalhes", function () {
    $("#listItensAuditoria").html("");
    var idAuditoria = $(this).data("id");
    var tipoItem = $(this).data("tipo");
    var itens = '';
    if (tipoItem == "temp") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoriaHistoricoTemperatura/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens = `
                <div class="titulo-modal">
                <span> `+data.fichasItens[0].ficha.created_at+` </span>
                <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
                </div>
                <div class="form">
                `;
                if (data.fichasItens.length > 0) {
                    itens +=`
                    <div class="conteudo">
                    <div class="listagem hist">
                    <div class="item">
                    <div class="topo">
                    <div class="listItem x3">
                    <span class="itemTitulo"> Item </span>
                    </div>
                    <div class="listItem center x3 bgCinza">
                    <span class="itemTitulo"> Temperatura do Painel </span>
                    </div>
                    <div class="listItem center x3">
                    <span class="itemTitulo"> Temperatura Aferida </span>
                    </div>
                    <div class="buttonItem">
                    <span class="itemTitulo"> Mínima </span>
                    </div>
                    <div class="buttonItem">
                    <span class="itemTitulo"> Máxima </span>
                    </div>
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {

                        var reauditado = "";
                        var confOuNaoIcon = "";
                        if (data.fichasItens[i].ficha.reaudita != null) {
                            reauditado = "reauditado";
                            confOuNaoIcon = "<i class='exclamation icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 0) {
                            reauditado = "naoconforme";
                            confOuNaoIcon = "<i class='exclamation triangle icon'></i>";
                        }
                        itens +=`
                        <div class="item `+reauditado+`">
                        <div class="lista">
                        <div class="listItem x3">
                        <span class="itemTitulo"> `+confOuNaoIcon+data.fichasItens[i].itens[0].nome+` </span>
                        </div>
                        <div class="listItem center x3 bgCinza">
                        <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_painel+`°C </span>
                        </div>
                        <div class="listItem center x3">
                        <span class="itemTitulo"> `+data.fichasItens[i].ficha.temperatura_aferida+`°C </span>
                        </div>
                        <div class="buttonItem">
                        <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_minima+`°C </span>
                        </div>
                        <div class="buttonItem">
                        <span class="itemTitulo"> `+data.fichasItens[i].itens[0].temperatura_maxima+`°C </span>
                        </div>
                        </div>
                        </div>
                        `;
                    }
                }
                itens +=`
                </div>
                </div>
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                </div>
                </div>
                `;
                $("#listItensAuditoria").html(itens);
            },
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
        abreModal('historicoConf');
    }
    if (tipoItem == "conf") {
        $.ajax({
            type: 'GET',
            url: urlApi+'detalheAuditoriaHistorico/'+idAuditoria,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            success: function (data) {
                itens +=`
                <div class="titulo-modal">
                <span> `+data.fichasItens[0].ficha.created_at+` </span>
                <a class="close" onclick="fechaModal()"><i class="close icon"></i></a>
                </div>
                <div class="form">
                `;
                if (data.fichasItens.length > 0) {
                    itens +=`
                    <div class="conteudo">
                    <div class="listagem hist">
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
                    </div>
                    </div>
                    `;
                    for (var i = 0; i < data.fichasItens.length; i++) {
                        var reauditado = "";
                        var confOuNaoIcon = "";
                        if (data.fichasItens[i].ficha.reaudita != null) {
                            reauditado = "reauditado";
                            confOuNaoIcon = "<i class='exclamation icon'></i>";
                        }
                        if (data.fichasItens[i].ficha.conforme == 0) {
                            reauditado = "naoconforme";
                            confOuNaoIcon = "<i class='exclamation triangle icon'></i>";
                        }
                        itens +=`
                        <div class="item `+reauditado+`">
                        <div class="lista">
                        <div class="listItem">
                        <span>`+confOuNaoIcon+data.fichasItens[i].itens[0].nome+` </span>
                        </div>
                        <div class="listItem xInput">
                        <input disabled type="radio" name="`+data.fichasItens[i].ficha.id+`" `; if(data.fichasItens[i].ficha.conforme == 1){itens +=`checked`;} itens +=`>
                        </div>
                        <div class="listItem xInput">
                        <input disabled type="radio" name="`+data.fichasItens[i].ficha.id+`" `; if(data.fichasItens[i].ficha.conforme == 0){itens +=`checked`;} itens +=`>
                        </div>
                        </div>
                        </div>
                        `;
                    }
                    itens +=`
                    </div>
                    </div>
                    `;
                }else {
                    itens +=`
                    <div class="conteudo">
                    <div class="listagem hist">
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
                    </div>
                    </div>
                    <div class="item">
                    <div class="lista">
                    <div class="listItem">
                    <span>Sem registro de Itens Auditados</span>
                    </div>
                    <div class="listItem xInput">
                    <input disabled type="radio" class="conforme" name="">
                    </div>
                    <div class="listItem xInput">
                    <input disabled type="radio" class="naoconforme" name="">
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    `;
                }
                itens +=`
                <div class="botoes-rodape">
                <div class="cancelar">
                <a onclick="fechaModal()"> Cancelar </a>
                </div>
                </div>
                </div>
                `;
                $("#listItensAuditoria").html(itens);
            },
            error: function(){
                alert("Não foi possivel realizar a operação!");
            }
        });
        abreModal('historicoConf');
    }
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
    id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: urlApi+'detalheUser/' + id,
        headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
        dataType: 'json',
        success: function (data) {
            nome = data.usuario.nome,
            telefone = data.usuario.telefone,
            email = data.usuario.email,
            $("#nomecadEditar").val(nome);
            $("#telefonecadEditar").val(telefone);
            $("#emailcadEditar").val(email);
            $("#senhacadEditar").val("");
            $("#confirmarSenhaEditar").val("");
        },
        error: function(){
            alert("Não foi possivel realizar a operação!");
        }
    });
    abreModal('editaUsuario');
});
$(document).off("submit","#editarUsuario").on("submit","#editarUsuario", function (e) {
    e.preventDefault();
    if ($("#senhacadEditar").val() == $("#confirmarSenhaEditar").val()) {
        var datas = {
            "nome": $("#nomecadEditar").val(),
            "telefone": $("#telefonecadEditar").val(),
            "email": $("#emailcadEditar").val(),
            "password": $("#senhacadEditar").val()
        };
        $.ajax({
            type: 'POST',
            url: urlApi+'atualizar/' + id,
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datas,
            success: function (data2) {
                $("#usuarioLogado-nome").html($("#nomecadEditar").val());
                $("#usuarioLogado-telefone").html($("#telefonecadEditar").val());
                $("#usuarioLogado-email").html($("#emailcadEditar").val());
                $(".sucessoEditaUser").fadeIn(function(){
                    setTimeout(function () {
                        $(".modal").fadeOut();
                    }, 1500);
                });
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
