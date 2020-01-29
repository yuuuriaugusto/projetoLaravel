<!DOCTYPE html>
<html>
<?php include("header.php") ?>
<body>
    <div class="tela">
        <div class="bloco-principal fixa">
            <div class="topbar fixa">
                <?php include "fixtopbar.php"; ?>
            </div>
            <div class="sidebar fixa">
                <?php include "sidebar.php"; ?>
            </div>
            <div class="content">
                <div class="muda">
                    <?php include('pages/produtorPrevisaoAbate.php') ?>
                </div>
                <div class="carregando loading-gif">
                    <img src="img/loading.gif">
                </div>
            </div>
        </div>
    </div>
    <?php include "alertas.php"; ?>
</body>
</html>
