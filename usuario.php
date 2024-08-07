<?php require_once("verificaacesso_todos.php") ?>
<?php require_once("cabecalho.php"); ?>

<title>Usuário</title>
</head>

<body class="menu-body">
    <div class="menu-container">
        <a href="menu.php" class="menu-item w3-red">
            <span>Voltar Menu Principal</span><br>
            <i class="fas fa-arrow-circle-left w3-xxlarge"></i>
        </a>
      
        <a href="cadastro_usuario.php" class="menu-item">
            <span>Cadastrar Usuário</span><br>
            <i class="fas fa-edit w3-xxlarge"></i>
        </a>
        <!--Criar pagina de consulta de usuario (sem ver a senha do usuario)-->
        <a href="consultar_usuario.php" class="menu-item">
            <span>Consultar Usuário</span><br>
            <i class="fas fa-search w3-xxlarge"></i>
        </a>
    </div>

    <?php require_once("rodape.php"); ?>