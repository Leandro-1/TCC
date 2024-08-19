<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Usuario</title>
</head>

<body>
    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        require_once 'conexaoBD.php';


        $sql = "UPDATE usuario SET nome = '" . $_POST['nome'] . "', login='" . $_POST['login'] . "', privilegio = '" . $_POST['privilegio'] . "' WHERE id_user =" . $_POST['id_user'] . ";";


        if ($conexao->query($sql) === TRUE) {
            echo '<a href="inicial_adm.php">
                    <h1 class="w3-button w3-black w3-center">Usuário Atualizado com Sucesso! </h1>
                </a>';
            $id = mysqli_insert_id($conexao);
        } else {
            echo '<a href="inicial_adm.php">
                    <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente! </h1>
                </a>';
        }
        $conexao->close();
        ?>
    </div>
    <?php require_once("rodape.php"); ?>