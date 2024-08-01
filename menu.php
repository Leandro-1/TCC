<?php require_once("verificaacesso_todos.php"); ?>
<?php require_once("cabecalho.php"); ?>
<title>Menu</title>
</head>

<body class="menu-body">
    <div class="menu-container">
        <a href="logoutAction.php" class="menu-item w3-red">
            <span>SAIR</span><br>
            <i class="fas fa-sign-out w3-xxlarge"></i>
        </a>
        <a href="encomenda.php" class="menu-item">
            <span>Encomenda</span><br>
            <i class="fas fa-box w3-xxlarge"></i>
        </a>
        <a href="morador.php" class="menu-item">
            <span>Morador</span><br>
            <i class="fas fa-user w3-xxlarge"></i>
        </a>
        <a href="propriedade.php" class="menu-item">
            <span>Propriedade</span><br>
            <i class="fas fa-home w3-xxlarge"></i>
        </a>
        <a href="usuario.php" class="menu-item">
            <span>Usuário</span><br>
            <i class="fas fa-user-cog w3-xxlarge"></i>
        </a>
    </div>
    <?php require_once("rodape.php"); ?>