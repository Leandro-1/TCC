<?php
session_start();
require_once 'conexaoBD.php';

$usuario = $_SESSION['id_user'];
$login = $_POST['login_alterarSenha'];
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Proteção contra SQL Injection
$login = mysqli_real_escape_string($conexao, $login);
$senha_atual = mysqli_real_escape_string($conexao, $senha_atual);


$pesquisaUser = "SELECT * FROM usuario WHERE login = '$login' and senha = '$senha_atual';";
$resultado = $conexao->query($pesquisaUser);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $user = $row['id_user'];

    if ($user === $usuario) {
        if ($nova_senha === $confirmar_senha) {

            $alteraSenha = "UPDATE usuario SET senha = '$nova_senha' WHERE id_user = $user;";
            
            if ($conexao->query($alteraSenha) === TRUE) {

                echo '<h2 class="w3-panel w3-pale-green w3-center w3-text-green">Senha Atualizada!</h2>';
            } 
        } else {
            echo '<h2 class="w3-painel w3-pale-yellow w3-center w3-text-yellow">Nova Senha não confere com a Confirmada!</h2>';
        }
    } else {
        echo '<h2 class="w3-painel w3-pale-red w3-center w3-text-red">Usuário Incorreto!</h2>';
    }
} else {
    echo '<h2 class="w3-painel w3-pale-red w3-center w3-text-red">Login e/ou Senha incorreto!</h2>';
}


$conexao->close();
?>