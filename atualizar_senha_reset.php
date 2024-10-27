<?php
require_once 'conexaoBD.php';

$id_user = $_POST['id_user'];
$nova_senha = $_POST['senhanova'];
$confirmar_senha = $_POST['senhanova_confirmar'];

if ($nova_senha === $confirmar_senha) {
    
    $stmt = $conexao->prepare("UPDATE usuario SET senha = ?, token = NULL, expirar_token = NULL WHERE id_user = ?");
    $stmt->bind_param("si", $nova_senha, $id_user);

    if ($stmt->execute()) {
        echo '<h2 class="w3-panel w3-pale-green w3-center">Senha atualizada com sucesso!</h2>';
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro ao atualizar senha. Tente novamente!</h2>';
    }

    $stmt->close();
} else {
    echo '<h2 class="w3-panel w3-pale-yellow w3-center">Senhas não coincidem.</h2>';
}

$conexao->close();
