<?php require_once "cabecalho.php"; ?>
<title>Cadastro de Propriedade</title>
</head>
<body>
    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        //require_once 'conexaoBD.php';
        
        //BD temporario teste Jéssie
        $servername = "localhost:3307";
        $username = "root";
        $password = "usbw";
        $dbname = "conpac";
        $conexao = new mysqli($servername, $username, $password, $dbname);
        if ($conexao->connect_error) {
        die("Connection failed: " . $conexao->connect_error);
        }
        
        
        if (empty($_POST["numero"]) || empty($_POST["bloco"])) {
            echo "Por favor, preencha todos os campos!";
            return;
        }

        $sql = "INSERT INTO propriedade (num_propriedade, bloco_quadra) VALUES ('" . $_POST['numero'] . "', '" . $_POST['bloco'] . "')";
        if ($conexao->query($sql) === TRUE) {
            echo '
            <a href="cadastro_propriedade.html">
                <h1 class="w3-button w3-black">Propriedade salva com êxito! </h1>
            </a>
            ';
        } else {
            echo '
            <a href="index.php">
                <h1 class="w3-button w3-black">ERRO! </h1>
            </a>
            ';
        }
        $conexao->close();
        ?>
    </div>
</body>
</html>
