<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php'); ?>

<div class="w3-padding w3-content w3-display-middle">
    <?php
    require_once('conexaoBD.php');
    $cpf = $_POST['cpf'];
    $sql = "DELETE FROM morador WHERE cpf = $cpf;";
    if ($conexao->query($sql) === TRUE) {
        echo '<a href="inicial_adm.php">
                        <h1 class="w3-button w3-black w3-center">Morador Excluído com Sucesso!</h1>
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