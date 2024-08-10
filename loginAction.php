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
        session_start();

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        require_once 'conexaoBD.php';

        $sql = "SELECT * FROM usuario WHERE login = '$login';";
        $resultado = $conexao->query($sql);

        $linha = mysqli_fetch_array($resultado);

        if ($linha && $linha['senha'] == $senha) {
            $_SESSION['logado'] = true;
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['privilegio'] = $linha['privilegio'];
            $bemVindoMensagem = $linha['nome'] . ', Seja Bem-Vindo!';
            $link = 'inicial_adm.php';
        } else {
            $link = 'login.html';
            $bemVindoMensagem = 'Login Inválido!';
        }

        echo "<a href=\"$link\"><h1 class=\"w3-button w3-black\">$bemVindoMensagem</h1></a>";

        $conexao->close();
        ?>
    </div>
</body>

</html>
