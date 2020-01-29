
<div class="logo" href="home.php">
    <img src="img/logo-white.png">
    <a id="fixa-sidebar"><i class="icon angle left"></i></a>
</div>
<div id="permissaoesMenu">
    <div class="item-menu home ativo" onclick="mudaContent('home')">
        <span>Home</span><i class="home icon"></i>
    </div>
    <div class="item-menu minhaConta" onclick="mudaContent('minhaConta')">
        <span>Minha Conta</span><i class="user circle icon"></i>
    </div>
    <script type="text/javascript">
    if (validarPermissao('deletar') == true || validarPermissao('editar') == true || validarPermissao('criar') == true || validarPermissao('cadastrar Controle') == true || validarPermissao('gerenciar Usuários') == true) {
        var administrativo = `
        <div class="item-menu rotate submenu-administrativo" onclick="mudaContent('submenu-administrativo')">
        <span>Administrativo</span><i class="angle left icon"></i>
        </div>
        <div class="submenu submenu-administrativo">
        `;
        if (validarPermissao('cadastrar Controle') == true) {
            administrativo += `
            <div class="item-submenu cadastroControle" onclick="mudaContent('cadastroControle')">
            <span>Cadastro controle</span><i class="edit icon"></i>
            </div>
            `;
        };
        if (validarPermissao('gerenciar Usuários') == true) {
            administrativo += `
            <div class="item-submenu usuarios" onclick="mudaContent('usuarios')">
            <span>Usuários</span><i class="user icon"></i>
            </div>
            `;
        };
        if (validarPermissao('cadastrar Controle') == true) {
            administrativo += `
            <a class="item-submenu funcionarios" onclick="mudaContent('funcionarios')">
            <span>Funcionários</span><i class="id card icon"></i>
            </a>
            `;
        };
        if (validarPermissao('gerenciar Usuários') == true) {
            administrativo += `
            <a class="item-submenu papeis" onclick="mudaContent('papeis')">
            <span>Papeis</span><i class="lock icon"></i>
            </a>
            `;
        };
        if (validarPermissao('cadastrar Controle') == true) {
            administrativo += `
            <a class="item-submenu naoConformidades" onclick="mudaContent('naoConformidades')">
            <span>Não Conformidades</span><i class="icon ban exclamation triangle"></i>
            </a>
            <a class="item-submenu acaoCorretiva" onclick="mudaContent('acaoCorretiva')">
            <span>Ação Corretiva</span><i class="clipboard check icon"></i>
            </a>
            `;
        };
        administrativo += `
        </div>
        `;
        $("#permissaoesMenu").append(administrativo);
    };
    </script>
    <div class="item-menu controle" onclick="mudaContent('controle')">
        <span>Controle</span><i class="clipboard outline icon"></i>
    </div>
    <div class="item-menu reauditoria" onclick="mudaContent('reauditoria')">
        <span>Reauditoria</span><i class="clipboard list icon"></i>
    </div>
    <script type="text/javascript">
    if (validarPermissao('inspecionar') == true) {
        var inspessao = `
        <div class="item-menu inspecao" onclick="mudaContent('inspecao')">
        <span>Inspeção</span><i class="check icon"></i>
        </div>
        `;
        $("#permissaoesMenu").append(inspessao);
    }
    </script>
    <script type="text/javascript">
    if (validarPermissao('ver') == true) {
        var historico = `
        <div class="item-menu relatorios" onclick="mudaContent('relatorios')">
        <span>Relatórios</span><i class="chart bar icon"></i>
        </div>
        <div class="item-menu historico" onclick="mudaContent('historico')">
        <span>Histórico</span><i class="history icon"></i>
        </div>
        `;
        $("#permissaoesMenu").append(historico);
    }
    </script>
    <script type="text/javascript">
    if (validarPermissao('produtor') == true) {
        var produtor = `
        <div class="item-menu rotate submenu-produtor" onclick="mudaContent('submenu-produtor')">
        <span>Produtor</span><i class="angle left icon"></i>
        </div>
        <div class="submenu submenu-produtor">
        `;
        if (validarPermissao('cadastrar Controle') == true) {
            produtor += `
            <div class="item-submenu produtorCadastroControle" onclick="mudaContent('produtorCadastroControle')">
            <span>Cadastro controle</span><i class="edit icon"></i>
            </div>
            `;
        };

        produtor += `
        <div class="item-submenu produtorControle" onclick="mudaContent('produtorControle')">
            <span>Controle</span><i class="clipboard outline icon"></i>
        </div>
        <div class="item-submenu produtorReauditoria" onclick="mudaContent('produtorReauditoria')">
            <span>Reauditoria</span><i class="clipboard list icon"></i>
        </div>
        <div class="item-submenu produtorPrevisaoAbate" onclick="mudaContent('produtorPrevisaoAbate')">
            <span>Previsão de abate</span><i class="tasks icon"></i>
        </div>
        `;

        produtor += `
        </div>
        `;
        $("#permissaoesMenu").append(produtor);
    };
    </script>

    <script type="text/javascript">
        if (validarPermissao() == true) {
            var cadastroEmpresa = `
            <div class="item-menu cadastroEmpresa" onclick="mudaContent('cadastroEmpresa')">
            <span>Empresas</span><i class="database icon"></i>
            </div>
            `;
            $("#permissaoesMenu").append(cadastroEmpresa);
        }
    </script>

</div>
