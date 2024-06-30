<?php require_once("cabecalho.php"); ?>
<title>Editar Propriedade</title>
</head>

<body>

    <!-- centralizar -->
    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        // require_once 'conexaoBD.php';

        //BD temporario teste Jéssie
        $servername = "localhost:3307";
        $username = "root";
        $password = "usbw";
        $dbname = "conpac";
        $conexao = new mysqli($servername, $username, $password, $dbname);
        if ($conexao->connect_error) {
            die("Connection failed: " . $conexao->connect_error);
        }


        $sql = "UPDATE propriedade SET num_propriedade = '" . $_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


        if ($conexao->query($sql) === TRUE) {
            echo '<a href="consultar_propriedade.php">
                    <h1 class="w3-button w3-black w3-center">Propriedade Atualizada com Sucesso! </h1>
                </a>';
            $id = mysqli_insert_id($conexao);
        } else {
            echo '<a href="consultar_propriedade.php">
                    <h1 class="w3-button w3-black w3-center">ERRO! </h1>
                </a>';
        }
        $conexao->close();
        ?>
    </div>
    <?php require_once("rodape.php"); ?>