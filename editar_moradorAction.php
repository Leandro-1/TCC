<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Morador</title>
</head>

    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        require_once 'conexaoBD.php';


        $sql = "UPDATE propriedade SET num_propriedade = '" . $_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


        if ($conexao->query($sql) === TRUE) {
            echo '<a href="consultar_morador.php">
                    <h1 class="w3-button w3-black w3-center">Morador Atualizado com Sucesso! </h1>
                </a>';
            $id = mysqli_insert_id($conexao);
        } else {
            echo '<a href="consultar_morador.php">
                    <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente! </h1>
                </a>';
        }
        $conexao->close();
        ?>
    </div>
    <?php require_once("rodape.php"); ?>