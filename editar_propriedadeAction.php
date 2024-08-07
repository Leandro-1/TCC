<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Propriedade</title>
</head>

<body>

    <!-- centralizar -->
    <div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
        <?php
        require_once 'conexaoBD.php';

        


        $sql = "UPDATE propriedade SET num_propriedade = '" . $_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


        if ($conexao->query($sql) === TRUE) {
            $_SESSION['mensagem'] = "Propriedade Atualizada com Sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar: ". $conexao->error;
        }
        $conexao->close();
        header("Location: inicial.adm.php")
        ?>
    </div>
    <?php require_once("rodape.php"); ?>