<?php require_once("verificaacesso_admin.php") ?>
<?php require_once "cabecalho.php"; ?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
    require_once 'conexaoBD.php';

    // dados temporarios, até o front ficar pronto.

    if (empty($_POST["login"]) || empty($_POST["senha"]) || empty($_POST["nome"]) || empty($_POST["privilegio"])) {
        echo "Por favor, preencha todos os campos!";
        return;
    }

    $sql = "INSERT INTO usuario (login, senha, nome, privilegio) VALUES ('" . $_POST['login'] . "', '" . $_POST['senha'] . "','" . $_POST['nome'] . "', '" . $_POST['privilegio'] . "')";

    if ($conexao->query($sql) === TRUE) {

        // criar e inserir pagina de cadastro de usuario
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
    $conexao->close();
    ?>
</div>
<?php require_once('rodape.php'); ?>