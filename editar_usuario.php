<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Usuário</title>
</head>

<body>
    <div class="w3-container w3-card w3-round">
        <h1 class="w3-center"><b>Editar Usuário</b></h1>
        <form action="editar_usuarioAction.php" method='post'>
            <input name="id_user" class="w3-input w3-grey w3-border" type="hidden" value="<?php echo $_GET['id_user']; ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
            <input name="nome" class="w3-input  w3-border" value="<?php echo $_GET['nome']; ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Login</label>
            <input name="login" class="w3-input  w3-border" value="<?php echo $_GET['login']; ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Privilégio</label>
            <select name="privilegio" class="w3-input  w3-border">
                <option value="administrador" <?php if ($_GET['privilegio'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                <option value="operador" <?php if ($_GET['privilegio'] == 'operador') echo 'selected'; ?>>Operador</option>
                <option value="morador" <?php if ($_GET['privilegio'] == 'morador') echo 'selected'; ?>>Morador</option>
            </select>
            <br>
            <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
        </form>
        <br>
        <div class="w3-center">
            <a href="consultar_usuario.php" class="w3-button w3-black">
                <i class="fa fa-arrow-circle-left w3-xxlarge"></i>
            </a>
        </div>
    </div>
    <?php require_once('rodape.php'); ?>
</body>

</html>