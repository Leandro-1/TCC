<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php

    $sql = "UPDATE usuario SET nome = '" . $_POST['nome'] . "', login='" . $_POST['login_user'] . "', privilegio = '" . $_POST['privilegio'] . "' WHERE id_user =" . $_POST['id_user'] . ";";


    if ($conexao->query($sql) === TRUE) {
        echo '<h2 class="w3-panel w3-pale-green w3-center">Atualizado com Sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }

    $conexao->close();
    ?>
</div>
<?php require_once("rodape.php"); ?>