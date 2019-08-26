<!DOCTYPE html>
<html>
<?php include("header.php") ?>
<body>
    <div class="tela">
        <div class="bloco-principal fixaX">
            <div class="topbar fixaX">
                <?php include "fixtopbar.php"; ?>
            </div>
            <div class="sidebar fixaX">
                <?php include "sidebar.php"; ?>
            </div>
            <div class="content">
                <div class="muda">
                    <?php include('pages/old/cadastroEmpresa.php') ?>
                </div>
                <div class="carregando">
                    <img src="img/loading.gif">
                </div>
            </div>
        </div>
    </div>
    <?php include "alertas.php"; ?>
</body>
</html>
