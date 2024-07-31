<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Morador</title>
</head>
<script src="script.js"></script>
<?php require_once 'conexaoBD.php';

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$id_propriedade = $_POST['propriedade'];


$stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $id_propriedade);

//Teste de implementar pop-up modal
if ($stmt->execute()) {
    echo '<script>exibirModal("Morador cadastrado com êxito! 🎉");</script>';
} else {
    echo '<script>exibirModal("Erro ao cadastrar. Por favor, tente novamente! 😢");</script>';
}

$stmt->close();
$conexao->close();
?>
<?php require_once('rodape.php'); ?>