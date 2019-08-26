
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
    if (validarPermissao('deletar') == true && validarPermissao('editar') == true && validarPermissao('criar') == true) {
        var administrativo = `
        <div class="item-menu rotate submenu-administrativo" onclick="mudaContent('submenu-administrativo')">
        <span>Administrativo</span><i class="angle left icon"></i>
        </div>
        <div class="submenu submenu-administrativo">
        <div class="item-submenu cadastroControle" onclick="mudaContent('cadastroControle')">
        <span>Cadastro controle</span><i class="edit icon"></i>
        </div>
        <div class="item-submenu usuarios" onclick="mudaContent('usuarios')">
        <span>Usuários</span><i class="user icon"></i>
        </div>
        <a class="item-submenu funcionarios" onclick="mudaContent('funcionarios')">
        <span>Funcionários</span><i class="id card icon"></i>
        </a>
        <a class="item-submenu papeis" onclick="mudaContent('papeis')">
        <span>Papeis</span><i class="lock icon"></i>
        </a>
        <a class="item-submenu naoConformidades" onclick="mudaContent('naoConformidades')">
        <span>Não Conformidades</span><i class="icon ban exclamation triangle"></i>
        </a>
        <a class="item-submenu acaoCorretiva" onclick="mudaContent('acaoCorretiva')">
        <span>Ação Corretiva</span><i class="clipboard check icon"></i>
        </a>
        </div>
        `;
        $("#permissaoesMenu").append(administrativo);
    }
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
