<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<?php

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$propriedade = $_POST['propriedade'];

$stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $propriedade);

if ($stmt->execute()) {

    echo '
            <a href="inicial_adm.php">
                <h1 class="w3-button w3-green w3-center w3-display-center" style="width: 50%;">Realizado com Sucesso! </h1>
            </a>
            ';
} else {
    echo '
            <a href="inicial_adm.php">
                <h1 class="w3-button w3-red w3-center" style="width: 50%;">ERRO... Tente novamente!</h1>
            </a>
            ';
}

$stmt->close();
$conexao->close();
?>
<?php require_once('rodape.php'); ?>