<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Editar Propriedade</title>
</head>
<body>
<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle w3-card">
        <?php
         $conexao = new mysqli("localhost:3307","root","usbw","conpac");
         if ($conexao->connect_error) {
            die("Erro de Conexão". $conexao->connect_error);
         }

         // CCORRIGIR ERRO! NÃO ESTÁ FAZENDO O UPDATE!!!
         $sql = "UPDATE propriedade SET num_propriedade = '" .$_POST['txtNumero'] . "', bloco_quadra='" . $_POST['txtBloco'] . "' WHERE id_propriedade =" . $_POST['txtCodigo'] . ";";


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
</body>
</html>
