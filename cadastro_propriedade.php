<?php require_once("verificaacesso_admin.php") ?>
<?php require_once('cabecalho.php') ?>

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
          
        </form>
        <div class=" w3-center">
            <a href="propriedade.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="menu.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>

            <a href="consultar_propriedade.php" class="w3-display-top-center">
                <i class="fa-solid fa-list w3-xxlarge w3-button"></i>
            </a>
        </div>
    </div>
    <?php require_once('rodape.php'); ?>