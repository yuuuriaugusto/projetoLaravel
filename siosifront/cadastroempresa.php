<!DOCTYPE html>
<html>
<script type="text/javascript">verificaLogin();</script>
<?php include("header.php") ?>
<body>
    <div class="cadastroempresa">
        <form class="formulario" id="cadastroNovaEmpresa">
            <div class="titulo-cadastroempresa"> Cadastro de Nova empresa </div>
            <span class="titulo"> Dados da empresa </span><br><br>
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
                        <span class="titulo-input"> CEP </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CEP" type="text" required id="cep">
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
                        <span class="titulo-input"> Nome Fantasia </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o nome Fantasia" type="text" required id="nomefantasia">
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
                        <span class="titulo-input"> CNPJ </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe o CNPJ" type="text" required id="cnpj">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="municipio">
                                    <option value="" disabled selected> Município </option>
                                    <option> 1 </option>
                                    <option> opção </option>
                                    <option> opção </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="segmento">
                                    <option value="" disabled selected> Segmento </option>
                                    <option> Aves </option>
                                    <option> Suinos </option>
                                    <option> Bovinos </option>
                                    <option> Peixes </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div">
                        <span class="titulo-input"> IE </span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a Inscrição Estadual" type="text" required id="ie">
                            </div>
                        </div>
                    </div>
                    <div class="input-div">
                        <span class="titulo-input">  </span>
                        <div class="input">
                            <div class="icone">
                                <select id="uf">
                                    <option value="" disabled selected> UF </option>
                                    <option> 1 </option>
                                    <option> opção </option>
                                    <option> opção </option>
                                </select>
                            </div>
                        </div>
                    </div>
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







            <!-- <br><span class="titulo"> Dados do usuário administrativo </span><br><br>
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
                    <div class="input-div">
                        <span class="titulo-input">Senha</span>
                        <div class="input">
                            <div class="icone">
                                <div class="bord"></div><i class="asterisk icon"></i>
                                <input placeholder="Informe a senha do usuário" type="password" required id="senhacadEditar">
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
                                <input placeholder="Informe o telefone do usuário" type="text" required id="telefonecadEditar">
                            </div>
                        </div>
                    </div>
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
            </div> -->

            <div class="botoes-rodape">
                <div class="cancelar">
                    <a hred="index.php"> Sair </a>
                </div>
                <div class="salvar">
                    <button type="submit"><i class="icon save"></i> Cadastrar </button>
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $(document).off("submit","#cadastroNovaEmpresa").on("submit","#cadastroNovaEmpresa", function (e) {
        e.preventDefault();
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
            "dominio": $("#dominio").val(),
        };
        $.ajax({
            type: 'POST',
            url: urlApi+'novaEmpresa',
            headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
            dataType: 'json',
            data: datas,
            success: function (data) {
                abreModal('sucessoCadastroUser');
            },
            error: function (){
                $(".usuarioExistente").fadeOut(function(){
                    $(".usuarioExistente").fadeIn();
                });
            },
        });
    });
</script>
</html>
