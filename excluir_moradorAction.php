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

        echo '
        <a href="inicial_adm.php">
            <h1 class="w3-button w3-green w3-center">Morador Excluído com Sucesso!</h1>
        </a>';
        
    } else {
        
        echo '
        <a href="inicial_adm.php">
            <h1 class="w3-button w3-red w3-center">ERRO... Tente Novamente!</h1>
        </a>';
    }
    $conexao->close();
    ?>
</div>

<?php require_once('rodape.php'); ?>