<?php require_once('cabecalho.php') ?>
<?php require_once("verificaacesso_admin.php") ?>
<title>Cadastrar Propriedades</title>
</head>

<body>
    <div class="w3-container w3-card w3-round">
        <h1 class="w3-center"><b>Cadastrar Propriedade</b></h1>

        <form action="cadastro_propriedadeAction.php" method="post">
            <div class="w3-margin-bottom">
                <label for="codigo">Código</label>
                <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" disabled>
                <br>
                <label for="numero">Número</label>
                <input class="w3-input w3-border" type="number" name="numero" required>
                <br>
                <label for="bloco">Bloco ou Quadra</label>
                <input class="w3-input w3-border" type="text" name="bloco" required>
                <br>
                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                <br><br>
            </div>
            <!-- criar um botão para acessar o menu de consulta-->
       
        </form>
        <div class=" w3-center">
            <a href="propriedade.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="menu.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>

            <!--Criar logout-->
            <a href="logoutAction.php" class="w3-display-top-center">
                <i class="fa fa-sign-out w3-xxlarge w3-button" style="color: red;"></i>
            </a>
        </div>
    </div>
<?php require_once('rodape.php'); ?>