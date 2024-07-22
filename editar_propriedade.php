<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Propriedade</title>
</head>

<body>
    <div class="w3-container w3-card w3-round">
        <h1 class="w3-center"><b>Editar Propriedade</b></h1>
        <form action="editar_propriedadeAction.php" method='post'>
            <input name="txtCodigo" class="w3-input w3-grey w3-border" type="" value="<?php echo $_GET['id'] ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Número</label>
            <input name="txtNumero" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['numero'] ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
            <input name="txtBloco" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['bloco'] ?>">
            <br>
            <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
        </form><br>
        <div class=" w3-center">
            <a href="consultar_propriedade.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="propriedade.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>

           
            <a href="logoutAction.php" class="w3-display-top-center">
                <i class="fa fa-sign-out w3-xxlarge w3-button" style="color: red;"></i>
            </a>
        </div>
    </div>
<?php require_once("rodape.php"); ?>