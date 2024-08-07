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
            echo '
            <a href="cadastro_propriedade.php">
                <h1 class="w3-button w3-black">Propriedade salva com êxito! </h1>
            </a>
            ';
        } else {
            echo '
            <a href="cadastro_propriedade.php">
                <h1 class="w3-button w3-black">ERRO! </h1>
            </a>
            ';
        }
        $conexao->close();
        ?>
    </div>
<?php require_once('rodape.php'); ?>