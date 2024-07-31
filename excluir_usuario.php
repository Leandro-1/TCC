<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("cabecalho.php"); ?>
<title>Excluir Usuário</title>
</head>

<div class="formulario">
    <div class="w3-container w3-content w3-card w3-round">
        <h2 class="w3-center"><b>Excluir Usuário</b></h2>
        <form action="excluir_usuarioAction.php"  method='post'>
            <label class="w3-text-black" style="font-weight: bold;">ID</label>
            <input name="id_user" class="w3-input w3-grey w3-border" disabled value="<?php echo htmlspecialchars($_GET['id_user']); ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
            <input name="nome" class="w3-input w3-grey w3-border" disabled value="<?php echo htmlspecialchars($_GET['nome']); ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">Login</label>
            <input name="login" class="w3-input w3-grey w3-border" disabled value="<?php echo htmlspecialchars($_GET['login']); ?>">
            <br>
            <button class="w3-btn w3-black" type="submit">Confirmar Exclusão!</button>

        </form><br>
        <div class=" w3-center">
            <a href="consultar_usuario.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="usuario.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>

            <a href="consultar_usuario.php">
                <i class="fa fa-ban w3-xxlarge w3-button w3-text-red"></i>
            </a>
        </div>
    </div>
</div>
<?php require_once("rodape.php"); ?>