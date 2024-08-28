<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
   
   $sql = "UPDATE propriedade SET num_propriedade = '" . $_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


    if ($conexao->query($sql) === TRUE) {

        echo '<a href="inicial_adm.php">
                    <h1 class="w3-button w3-black w3-center">Propriedade Atualizada com Sucesso! </h1>
              </a> ';

        $id = mysqli_insert_id($conexao);
    } else {
        echo '<a href="inicial_adm.php">
                    <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente! </h1>
                </a>';
    }

    $conexao->close();
    ?>
</div>
<?php require_once("rodape.php"); ?>