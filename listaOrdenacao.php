<?php require_once('cabecalho.php'); ?>
<title>Consultar Propriedade</title>
</head>

<body>

    <div class="w3-padding w3-content w3-half w3-display-middle w3-margin w3-card" style="overflow-y:auto;">
        <form action="listaOrdenacao.php" method="post">
            <label for="ordenacao"><b>Ordem:</b></label>
            <select name="ordenacao">
                <option value="null"></option>
                <option value="num_propriedade">Número</option>
                <option value="bloco_quadra">Bloco</option>
                <option value="id_propriedade">Código</option>
            </select>
            <input type="submit" value="OK">
        </form>

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
            $ordem = $_POST['ordenacao'];
            $sql = "SELECT * FROM propriedade order by $ordem";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['id_propriedade'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                    echo '<td> <a href="editar_propriedade.php?id=' . $linha['id_propriedade'] . '&numero=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-pen-to-square w3-large w3-text-black""></i>
                                    </a></td>
                                </td>';
                    echo '</tr>';
                }

            ?>
        </table>
    </div>
    <?php require_once('rodape.php'); ?>