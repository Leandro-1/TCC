<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once 'conexaoBD.php';
?>


    <?php
   
   $sql = "UPDATE propriedade SET num_propriedade = '" . $_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


    if ($conexao->query($sql) === TRUE) {
        
        echo '<h2 class="w3-panel w3-pale-green w3-center">Atualizado com Sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }

    $conexao->close();
    ?>

