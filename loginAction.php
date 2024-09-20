<?php

session_start();
require_once 'conexaoBD.php';


$login = $_POST['login'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE login = '$login';";
$resultado = $conexao->query($sql);

$linha = mysqli_fetch_array($resultado);

if ($linha && $linha['senha'] == $senha) {
    $_SESSION['logado'] = true;
    $_SESSION['id_user'] = $linha['id_user'];
    $_SESSION['nome'] = $linha['nome'];
    $_SESSION['login'] = $linha['login'];
    $_SESSION['privilegio'] = $linha['privilegio'];

    // Redirecionamento baseado no privilegio do usuário
    if ($_SESSION['privilegio'] == 'administrador') {
        header('Location: inicial_adm.php');
    } elseif ($_SESSION['privilegio'] == 'operador') {
        header('Location: inicial_operador.php');
    } elseif ($_SESSION['privilegio'] == 'morador') {
        header('Location: inicial_morador.php');
    } else {
        header('Location: acessonegado.php');
    }
} else {
    header('Location: acessonegado.php');
}

?>

