<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once 'conexaoBD.php';

$cpf = $_POST['cpf'];
$tel = $_POST['tel'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$propriedade = $_POST['propriedade'];

// Verificar se o CPF já está cadastrado
$stmt_check = $conexao->prepare("SELECT cpf FROM morador WHERE cpf = ?");
$stmt_check->bind_param("i", $cpf);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo '<h2 class="w3-panel w3-pale-red w3-center">Erro: Morador já cadastrado!</h2>';
} else {
    $stmt = $conexao->prepare("INSERT INTO morador (cpf, nome, telefone, email, id_propriedade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $cpf, $nome, $tel, $email, $propriedade);

    if ($stmt->execute()) {
    
        // criando senha e Inserir usuário
        $tres_letras_nome = strtoupper(substr($nome, 0, 3));
        $tres_numeros_cpf = substr($cpf, 0, 3);
        $senha_gerada = $tres_letras_nome . '@' . $tres_numeros_cpf;

        $stmt_usuario = $conexao->prepare("INSERT INTO usuario (login, senha, nome, privilegio) VALUES (?, ?, ?, 'morador')");
        $stmt_usuario->bind_param("sss", $email, $senha_gerada, $nome);

        if ($stmt_usuario->execute()) {
            // Obter o id_user inserido
            $usuarioId = $stmt_usuario->insert_id;

            // Atualizar o id_usuario no morador
            $stmt_update = $conexao->prepare("UPDATE morador SET id_usuario = ? WHERE cpf = ?");
            $stmt_update->bind_param("is", $usuarioId, $cpf);

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
}

$stmt_check->close();
$conexao->close();
