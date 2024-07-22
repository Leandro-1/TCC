<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("cabecalho.php"); ?>
<title>Excluir Usuário</title>
</head>
<a href="consultar_usuario.php" class="w3-display-topmiddle w3-red w3-center w3-padding w3-button" style="text-decoration:none; ">
<i class="fa fa-ban" style="font-size:5em"></i>
<p style="font-weight:bold;">CANCELAR EXCLUSÃO</p>
</a>

<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-middle">
    <h1 class="w3-center w3-black w3-round-large w3-margin">EXCLUIR - ID: <?php echo " " . htmlspecialchars($_GET['id_user'], ENT_QUOTES, 'UTF-8'); ?> </h1>
    <form action="excluir_usuarioAction.php" class="w3-container" method='post'>
        <input name="id_user" class="w3-input w3-grey w3-border" type="hidden" value="<?php echo htmlspecialchars($_GET['id_user'], ENT_QUOTES, 'UTF-8'); ?>">
        <br>
        <label class="w3-text-black" style="font-weight: bold;">Nome</label>
        <input name="nome" class="w3-input w3-light-grey w3-border" value="<?php echo htmlspecialchars($_GET['nome'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
        <br>
        <label class="w3-text-black" style="font-weight: bold;">Login</label>
        <input name="login" class="w3-input w3-light-grey w3-border" value="<?php echo htmlspecialchars($_GET['login'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
        <br>
        <button name="btnExcluir" class="w3-button w3-black w3-cell w3-round-large w3-right">
            <i class="w3-xxlarge fa fa-check"></i> Confirmar Exclusão
        </button>
    </form>
</div>
<?php require_once("rodape.php"); ?>
