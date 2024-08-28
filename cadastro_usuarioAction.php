<?php require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php

    // Verificação de campos vazios
    if (empty($_POST["login"]) || empty($_POST["senha"]) || empty($_POST["nome"]) || empty($_POST["privilegio"])) {
        echo "Por favor, preencha todos os campos!";
        return;
    }

    // Preparar e vincular
    $stmt = $conexao->prepare("INSERT INTO usuario (login, senha, nome, privilegio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $login, $senha, $nome, $privilegio);

    // Definir os parâmetros e executar
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $privilegio = $_POST['privilegio'];

    if ($stmt->execute()) {
        echo '
            <a href="cadastro_usuario.php">
                <h1 class="w3-button w3-black">Usuário salvo com êxito! </h1>
            </a>
            ';
    } else {
        echo '
            <a href="cadastro_usuario.php">
                <h1 class="w3-button w3-black">ERRO... Tente Novamente! </h1>
            </a>
            ';
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conexao->close();
    ?>
</div>
<?php require_once('rodape.php'); ?>