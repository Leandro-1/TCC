<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Morador</title>
</head>

<?php 
session_start();
require_once 'conexaoBD.php';

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$id_propriedade = $_POST['propriedade'];


$stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $id_propriedade);


//Teste de implementar pop-up modal
if ($stmt->execute()) {

   $_SESSION['mensagem'] =  '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-green">Realizado com Sucesso! </h1>
            </a>
            ';
    
} else {
    $_SESSION['mensagem'] =  '
            <a href="cadastro_morador.php">
                <h1 class="w3-button w3-red">ERRO... Tente novamente!</h1>
            </a>
            ';
    
}
header('Location: cadastro_morador.php');

$stmt->close();
$conexao->close();
?>
<?php require_once('rodape.php'); ?>