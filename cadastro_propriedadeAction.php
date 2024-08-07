<?php require_once("verificaacesso_admin.php") ?>
<?php require_once "cabecalho.php"; ?>
<title>Cadastro de Propriedade</title>
</head>

<body>
    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        require_once 'conexaoBD.php';



        if (empty($_POST["numero"]) || empty($_POST["bloco"])) {
            echo "Por favor, preencha todos os campos!";
            return;
        }

        $sql = "INSERT INTO propriedade (num_propriedade, bloco_quadra) VALUES ('" . $_POST['numero'] . "', '" . $_POST['bloco'] . "')";
        if ($conexao->query($sql) === TRUE) {
            $_SESSION['mensagem'] = "Propriedade Atualizada com Sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar: ". $conexao->error;
        }
        $conexao->close();
        header("Location: inicial.adm.php")
               ?>
    </div>
<?php require_once('rodape.php'); ?>