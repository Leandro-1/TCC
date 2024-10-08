<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once 'conexaoBD.php';

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$propriedade = $_POST['propriedade'];

$stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $propriedade);

if ($stmt->execute()) {
    // Obter o id_morador inserido
    $moradorId = $stmt->insert_id;

    // criar senha automaticamente para usuario
    $tres_letras_nome = strtoupper(substr($nome, 0, 3));
    $tres_numeros_cpf = substr($cpf, 0, 3);
    $senha_gerada = $tres_letras_nome . '@' . $tres_numeros_cpf;

    //criar um usuario automaticamente assim que o morador for criado
    $stmt_usuario = $conexao->prepare("INSERT INTO usuario (login, senha, nome, privilegio) VALUES (?, ?, ?, 'morador')");
    $stmt_usuario->bind_param("sss", $email, $senha_gerada, $nome);

    if ($stmt_usuario->execute()) {
        // Obter o id_user inserido
        $usuarioId = $stmt_usuario->insert_id;

        // Atualizar o "id_usuario" no morador
        $stmt_update = $conexao->prepare("UPDATE morador SET id_usuario = ? WHERE cpf = ?");
        $stmt_update->bind_param("ii", $usuarioId, $moradorId);

        if ($stmt_update->execute()) {
            echo '<h2 class="w3-panel w3-pale-green w3-center">Cadastro Realizado com Sucesso!</h2>';
        } else {
            echo '<h2 class="w3-panel w3-pale-red w3-center">Erro ao atualizar id_usuario no morador. Tente novamente!</h2>';
        }
        $stmt_update->close();
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro ao criar usuário. Tente novamente!</h2>';
    }
    $stmt_usuario->close();
} else {
    echo '<h2 class="w3-panel w3-pale-red w3-center">Erro ao criar morador. Tente novamente!</h2>';
}

$stmt->close();
$conexao->close();
