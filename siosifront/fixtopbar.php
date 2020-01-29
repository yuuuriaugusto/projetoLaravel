<div class="menu">
	<div class="item">
		<span>
			<?php
			$urlhome = "<a onclick='mudaContent('home')'>Home <i class='right chevron icon divider'></i></a>";
			$administrativo = "<a>Home <i class='right chevron icon divider'></i></a><a>Administrativo </a><i class='right chevron icon divider'></i>";
			$produtor = "<a>Home <i class='right chevron icon divider'></i></a><a>Produtor </a><i class='right chevron icon divider'></i>";
			?>
			<div class="url-topbar home active"><a class="last" onclick="mudaContent('home')">Home</a></div>
			<div class="url-topbar controle"><?= $urlhome?><a class="last">Controle</a></div>
			<div class="url-topbar inspecao"><?= $urlhome?><a class="last">Inspeção</a></div>
			<div class="url-topbar reauditoria"><?= $urlhome?><a class="last">Reauditoria</a></div>
			<div class="url-topbar relatorios"><?= $urlhome?><a class="last">Relatórios</a></div>
			<div class="url-topbar historico"><?= $urlhome?><a class="last">Histórico</a></div>
			<div class="url-topbar minhaConta"><?= $urlhome?><a class="last">Minha Conta</a></div>
			<div class="url-topbar cadastroEmpresa"><?= $urlhome?><a class="last">Empresas</a></div>
			<div class="url-topbar cadastroControle"><?= $administrativo?><a class="last">Cadastro controle</a></div>
			<div class="url-topbar usuarios"><?= $administrativo?><a class="last">Usuários</a></div>
			<div class="url-topbar funcionarios"><?= $administrativo?><a class="last">Funcionários</a></div>
			<div class="url-topbar papeis"><?= $administrativo?><a class="last">Papeis</a></div>
			<div class="url-topbar naoConformidades"><?= $administrativo?><a class="last">Não Conformidades</a></div>
			<div class="url-topbar acaoCorretiva"><?= $administrativo?><a class="last">Ação Corretiva</a></div>
			<div class="url-topbar produtorCadastroControle"><?= $produtor?><a class="last">Cadastro controle</a></div>
			<div class="url-topbar produtorControle"><?= $produtor?><a class="last">Controle</a></div>
			<div class="url-topbar produtorPrevisaoAbate"><?= $produtor?><a class="last">Previsão de abate</a></div>
		</span>
	</div>
	<div class="button-sair">
		<a onclick="logout()">Sair</a>
	</div>
</div>
