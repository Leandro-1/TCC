<?php
    require_once('verificar_permissaoAcesso.php');
    verificar_permissao('administrador');
require_once 'conexaoBD.php';
?>


    <?php
    $id_entrega = $_POST['cod_entrega'];
    $sql = "DELETE FROM entrega WHERE id_entrega = $id_entrega;";

    if ($conexao->query($sql) === TRUE) {
        echo '<h2 class="w3-panel w3-pale-green w3-center">Excluído com Sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }

    $conexao->close();
    ?>


