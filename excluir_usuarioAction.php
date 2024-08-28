<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-display-middle">
    <?php
    
    $sql = "DELETE FROM usuario WHERE id_user = '" . $_POST['user'] . "';";
    if ($conexao->query($sql) === TRUE) {
        echo '<a href="inicial_adm.php">
                        <h1 class="w3-button w3-black w3-center">Usuário Excluído com Sucesso!</h1>
                    </a>';
    } else {
        echo '<a href="inicial_adm.php">
                        <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente!</h1>
                    </a>';
    }
    $conexao->close();
    ?>
</div>

<?php require_once('rodape.php'); ?>