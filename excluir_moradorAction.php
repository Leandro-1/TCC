<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once('conexaoBD.php');
?>

<!--Pagina action do formulario -->
<div class="w3-display-middle">
    <?php

    $cpf = $_POST['cpf'];
    $sql = "DELETE FROM morador WHERE cpf = $cpf;";
    if ($conexao->query($sql) === TRUE) {

        echo '<h2 class="w3-panel w3-pale-green w3-center">Excluído com Sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }

    $conexao->close();
    ?>
</div>

<?php require_once('rodape.php'); ?>