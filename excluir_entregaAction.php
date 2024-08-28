<?php
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-display-middle">
    <?php
$id_entrega = $_POST['cod_entrega'];
    $sql = "DELETE FROM entrega WHERE id_entrega = $id_entrega;";
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