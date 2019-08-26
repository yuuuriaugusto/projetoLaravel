<!DOCTYPE html>
<html>
<?php include("header.php") ?>
<body>
	<div class="login">
		<div class="bloco">
			<img class="logo" src="img/logo-black.png">
			<form class="formulario" id="login">
				<div class="input">
					<i class="user icon"></i>
					<input type="text" required placeholder="Usuario" id="loginEmail">
				</div>
				<div class="input">
					<i class="lock icon"></i>
					<input type="password" required placeholder="Senha" id="loginSenha">
				</div>
				<input class="buttonlogin" type="submit" value="Entrar"></input>
			</form>
			<div class="erro" id="erro">
				Usuário ou senha incorretos!
			</div>
		</div>
	</div>
</body>
</html>
