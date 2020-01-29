<script type="text/javascript">verificaLogin();</script>

<div class="titulo">Comunicado de Previsão de Abate</div>

<div class="listagem-collapse">
    <span class="subtitulo">FRIAVES - INDUSTRIA DE ALIMENTOS LTDA</span>
    <div class="bloco-lista"></div>
</div>
<? /*inicio cadastro Previsão de Abate*/ ?>
<div class="listagem">
    <div class="item">
        <div class="topo">
            <div class="listItem"><span>Cadastro</span></div>
        </div>
    </div>
    <form class="item" id="formCadastroPA">
        <div class="lista conteudo">

            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input">Data</span>
                    <div class="input">
                        <div class="icone">
                            <input disabled placeholder="Data" type="date" required id="padata">
                            <script> $('#padata').val(new Date().getFullYear() + '-' + new Date().getMonth() + '-' + (new Date().getDate() > 9 ? new Date().getDate() : '0' + new Date().getDate())); </script>
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input">Previsão de abate para</span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Previsão de abate para" type="date" required id="paprevisaoPara">
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input">Lote</span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe o número do lote" min="0" type="number" required id="palote">
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input">Produtor</span>
                    <div class="input">
                        <div class="icone">
                            <div class="bord"></div><i class="asterisk icon"></i>
                            <select id="paprodutor">
                                <option selected disabled> Selecione um Produtor </option>
                                <option value=""> Nome do Produtor </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="lista conteudo">

            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input">UF - Município</span>
                    <div class="input">
                        <div class="icone time2">
                            <div class="bord"></div><i class="asterisk icon"></i>
                            <select id="pauf">
                                <option selected disabled> UF </option>
                                <option value=""> SC - Santa Catarina </option>
                            </select>
                        </div>
                        <div class="icone time1">
                            <div class="bord"></div><i class="asterisk icon"></i>
                            <select id="pamunicipio">
                                <option selected disabled> Município </option>
                                <option value=""> Chapecó </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input"> Número de Aves </span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe o número de Aves" min="0" type="number" required id="panAves">
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input"> GTA </span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe o GTA" type="text" required id="pagta">
                            <script type="text/javascript">$("#pagta").mask("999.999");</script>
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input"> Placa do Caminhão </span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe a placa do caminhão" type="text" required id="paplacaCaminhao">
                            <script type="text/javascript">$("#paplacaCaminhao").mask("aaa-9999");</script>
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="lista conteudo">

            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input"> Sexo </span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe o sexo do lote" type="text" required id="pasexo">
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">
                <div class="input-div">
                    <span class="titulo-input"> Idade </span>
                    <div class="input">
                        <div class="icone">
                            <input placeholder="Informe a idade do lote" type="number" min="0" required id="paidade">
                            <div class="bord"></div><i class="asterisk icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listItem col x4">

                <div class="input-div">
                    <span class="titulo-input"> Adicionar </span>
                    <div class="input">
                        <div class="icone">
                            <button type="submit" class="save-cadastro" type="submit">
                                <!-- cadastrar -->
                                <i class="icon plus"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="listItem col x4"></div>

        </div>

    </form>
</div>
<? /*fim cadastro Previsão de Abate*/ ?>

<script>
var itensPrevisao = [];
$(function () {
    $("#sortable").sortable();
    $("#sortable").disableSelection();
});
</script>
  
<div class="listagem semborda">
    <div class="item">
        <div class="topo">
            <div class="listItem col x4"><span>Previsão para</span></div>
            <div class="listItem col x4"><span>Produtor</span></div>
            <div class="listItem col x4"><span>UF - Município</span></div>
            <div class="listItem col x4"><span>Número de Aves</span></div>
            <div class="buttonItem"></div>
            <div class="buttonItem"></div>
        </div>
    </div>
    <div id="sortable"></div>
    <div id="finalizarCadastro"></div>
</div>


<script>
    $(document).off('submit', '#formCadastroPA').on('submit', '#formCadastroPA', e => {
        e.preventDefault();
        if (validarPermissao('criar') != true) {
            abreModal('semPermisao');
            setTimeout(function () {
                $(".semPermisao").fadeOut();
            }, 1500);
        } else {addElement();}
    });
    function remElement(id){
        for(var i in itensPrevisao){
            if(itensPrevisao[i].id == id){
                itensPrevisao.splice(i, 1);
                listElement();
            };
        };
    };
    function addElement(){
        itensPrevisao.push({
            'id': itensPrevisao.length > 0 ? itensPrevisao[itensPrevisao.length-1].id+1 : 1,
            'data': $('#padata').val(),
            'data_previsao_abate': $('#paprevisaoPara').val(),
            'lote': $('#palote').val(),
            'produtor': $('#paprodutor').val(),
            'uf': $('#pauf').val(),
            'municipio': $('#pamunicipio').val(),
            'numero_aves': $('#panAves').val(),
            'gta': $('#pagta').val(),
            'placa_caminhao': $('#paplacaCaminhao').val(),
            'ordemDescarga': 0,
            'sexo_frango': $('#pasexo').val(),
            'idade_frango': $('#paidade').val(),
        });
        listElement();
    };
    function listElement() {
        var aux = '';
        if(itensPrevisao.length <= 0){
            aux = `<div class="item"><div class="lista"><div class="listItem"><span> Sem cadastros </span></div></div></div>`;
        }else{
            for(var i in itensPrevisao){
                aux +=`
                <div class="item">
                    <div class="lista">
                    `+ itensPrevisao[i].id +`
                        <div class="listItem col x4"><span> `+ itensPrevisao[i].data_previsao_abate +` </span></div>
                        <div class="listItem col x4"><span> `+ itensPrevisao[i].produtor +` </span></div>
                        <div class="listItem col x4"><span> `+ itensPrevisao[i].uf +` - `+ itensPrevisao[i].municipio +` </span></div>
                        <div class="listItem col x4"><span> `+ itensPrevisao[i].numero_aves +` </span></div>
                        <div class="buttonItem"><a class="edita"><i class="icon edit"></i></a></div>
                        <div class="buttonItem"><a class="del" onClick="remElement(`+ itensPrevisao[i].id +`);"><i class="icon trash alternate"></i></a></div>
                    </div>
                </div>
                `;
            }
        }
        $('#sortable').html(aux);
        if(itensPrevisao.length > 0){
            $('#finalizarCadastro').html(`
                <div class="item">
                    <div class="topo">
                        <div class="buttonItem"><a id="finalizaCadastroPA" class="edita"><i class="icon save"></i><i>Finalizar Cadastro</i></a></div>
                    </div>
                </div>
            `);
        }
    };listElement();

    $(document).off('click', '#finalizaCadastroPA').on('click', '#finalizaCadastroPA', e => {
        if (validarPermissao('criar') != true) {
            abreModal('semPermisao');
            setTimeout(function () {
                $(".semPermisao").fadeOut();
            }, 1500);
        } else {
            $.ajax({
                type: 'POST',
                url: urlApi+'novaPrevisaoAbate',
                headers: { 'Authorization': "Bearer " + localStorage.getItem('token') },
                dataType: 'json',
                data: itensPrevisao,
                success: function (data) {
                    abreModal('sucessoCadastrarPrevisaoAbate');

                    
                    setTimeout(function () {
                        fechaModal('sucessoCadastrarPrevisaoAbate');
                    }, 1500);
                },
                error: function(resp){console.log(resp.statusText);}
            });
        };
        console.log(itensPrevisao);
    });
</script>