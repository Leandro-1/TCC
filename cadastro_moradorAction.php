<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Morador</title>
</head>

<?php require_once 'conexaoBD.php';

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$id_propriedade = $_POST['propriedade'];


$stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $id_propriedade);


if ($stmt->execute()) {
    echo '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-black">Morador salvo com êxito! </h1>
            </a>
            ';
} else {
    echo '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-black">ERRO... Tente Novamente! </h1>
            </a>
            ';
}

$stmt->close();
$conexao->close();
?>
<?php require_once('rodape.php'); ?>