<?php require_once("verificaacesso_admin.php") ?>
<?php require_once('cabecalho.php'); ?>
<div class="w3-padding w3-content w3-display-middle">
    <?php
    require_once('conexaoBD.php');
    $sql = "DELETE FROM usuario WHERE id_user = '" . $_POST['id_user'] . "';";
    if ($conexao->query($sql) === TRUE) {
        echo '<a href="consultar_usuario.php">
                        <h1 class="w3-button w3-black w3-center">Usuário Excluído com Sucesso!</h1>
                    </a>';
    } else {
        echo '<a href="consultar_morador.php">
                        <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente!</h1>
                    </a>';
    }
    $conexao->close();
    ?>
</div>

<?php require_once('rodape.php'); ?>