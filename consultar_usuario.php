<?php 
require_once("verificaacesso_todos.php");
require_once("cabecalho.php"); 
?>
<title>Consultar Usuário</title>
</head>

<body>

<div class="w3-padding w3-content w3-half w3-display-middle w3-margin w3-card" style="overflow-y:auto;">
    <form action="listaOrdenacao.php" method="post">
        <label for="ordenacao"><b>Ordem:</b></label>
        <select name="ordenacao">
            <option value="id_user">ID</option>
            <option value="nome">Nome</option>
            <option value="privilegio">Privilégio</option>
        </select>
        <input type="submit" value="OK">
    </form>

    <table class="w3-table-all w3-centered">
        <caption>
            <h1 class="w3-center w3-black w3-round-large">Usuários</h1>
        </caption>
        <tr class="w3-center w3-black">
            <th>Código</th>
            <th>Nome</th>
            <th>Privilégio</th>
            <th>Editar</th>
            <th>Excluir</th> <!-- Nova coluna para exclusão -->
        </tr>
        <?php
        require_once 'conexaoBD.php';

        try {
            $sql = "SELECT * FROM usuario";
            $resultado = $conexao->query($sql);

            if ($resultado != null) {
                foreach ($resultado as $linha) {
                    echo '<tr class="w3-text-black">';
                    echo '<td>' . htmlspecialchars($linha['id_user'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($linha['privilegio'], ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td><a href="editar_usuario.php?id_user=' . $linha['id_user'] . '&nome=' . $linha['nome'] . '&login=' . $linha['login'] . '&senha=' . $linha['senha'] . '&privilegio=' . $linha['privilegio'] . '">
                            <i class="fa fa-pen-to-square w3-large w3-text-black"></i>
                          </a></td>';
                    echo '<td><a href="excluir_usuario.php?id_user=' . $linha['id_user'] . '&nome=' . $linha['nome'] . '&login=' . $linha['login'] . '&senha=' . $linha['senha'] . '&privilegio=' . $linha['privilegio'] . '">
                            <i class="fa fa-user-times w3-large w3-text-red"></i>
                          </a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5" class="w3-center">Nenhum usuário encontrado.</td></tr>';
            }
        } catch (PDOException $e) {
            echo '<tr><td colspan="5" class="w3-center">Erro ao consultar usuários: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
        }
        ?>
    </table>
</div>

<?php require_once('rodape.php'); ?>
</body>
</html>
