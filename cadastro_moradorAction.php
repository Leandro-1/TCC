<?php
require_once("verificaacesso_admin.php");
require_once "cabecalho.php"; ?>

<div class="w3-formulario w3-text-grey w3-display-middle">
    <?php
    require_once 'conexaoBD.php';

    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $num_ap = $_POST['num_apart'];
    $bloco = $_POST['bloco'];

    $sql = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = '$num_ap' AND bloco_quadra = '$bloco'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $id_propriedade = $row["id_propriedade"];

        $sql_insert = "INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES ('$cpf','$nome','$tel','$email','$id_propriedade');";

        if ($conexao->query($sql_insert) === TRUE) {
            echo '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-black">Propriedade salva com êxito! </h1>
            </a>
            ';
        } else {
            echo '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-black">ERRO... Tente Novamente! </h1>
            </a>
            ';
        }
    } else {
        echo '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-black">Número do Apartamento e/ou Bloco não encontrado! </h1>
            </a>
            ';
    }

    $conexao->close();

    ?>
</div>
<?php require_once('rodape.php'); ?>