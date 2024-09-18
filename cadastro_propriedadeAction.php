<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php

    if (empty($_POST["numero"]) || empty($_POST["bloco"])) {
        echo "Por favor, preencha todos os campos!";
        return;
    }

    $sql = "INSERT INTO propriedade (num_propriedade, bloco_quadra) VALUES ('" . $_POST['numero'] . "', '" . $_POST['bloco'] . "')";
    if ($conexao->query($sql) === TRUE) {
        echo '<h2 class="w3-panel w3-pale-green w3-center">Cadastro Realizado com Sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }

    $conexao->close();
    ?>
</div>
<?php require_once('rodape.php'); ?>