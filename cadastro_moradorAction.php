<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
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

    echo '<h2 class="w3-panel w3-pale-green w3-center">Cadastro Realizado com Sucesso!</h2>';
} else {
    echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
}


$stmt->close();
$conexao->close();
?>
