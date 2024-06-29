<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Login</title>
</head>
<body>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
<?php
$login = $_POST['login'];
$senha = $_POST['senha'];

require_once 'conexaoBD.php';


if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

$sql = "SELECT * FROM usuario WHERE login = '".$login."';";
$resultado = $conexao->query($sql);

$linha = mysqli_fetch_array($resultado);
if($linha != null) {
    if($linha['senha'] == $senha && $linha['privilegio'] == 'administrador') {
        echo '
        <a href="menu.html">
            <h1 class="w3-button w3-black">'. $linha['nome'] .', Seja Bem-Vindo!</h1>
        </a>'; }

        if($linha['senha'] == $senha && $linha['privilegio'] == 'operador') {
            echo '
            <a href="">
                <h1 class="w3-button w3-black">'. $linha['nome'] .', Seja Bem-Vindo!</h1>
            </a>';
} else {
        echo '
        <a href="index.php">
            <h1 class="w3-button w3-black">Login Inválido!</h1>
        </a>';
    }
} else {
    echo '
    <a href="index.php">
        <h1 class="w3-button w3-black">Login Inválido!</h1>
    </a>';
}

$conexao->close();
?>
</div>
</body>
</html>
