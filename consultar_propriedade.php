<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Consultar Propriedade</title>
</head>

<body>

    <div class="w3-padding w3-content w3-half w3-display-middle w3-margin w3-card" style="overflow-y:auto;">
        <table class="w3-table-all w3-centered">
            <caption>
                <h1 class="w3-center w3-black w3-round-large">Propriedades</h1>
            </caption>
            <tr class="w3-center w3-black">
                <th>Código</th>
                <th>Número</th>
                <th>Bloco/Quadra</th>
                <th>Editar</th>
            </tr>
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

            $sql = "SELECT * FROM propriedade";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['id_propriedade'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                    echo '<td> <a href="editar_propriedade.php?id=' . $linha['id_propriedade'] . '&numero=' . $linha['num_propriedade'] .'&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-pencil-square-o w3-large w3-text-black""></i>
                                    </a></td>
                                </td>';
                    echo '</tr>';
                }
            echo '</table><br>
        </div>';
            ?>
</body>

</html>