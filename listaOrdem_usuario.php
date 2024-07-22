<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<div class="formulario w3-display-flex">
    <div class="w3-padding w3-content w3-half w3-display-middle w3-margin w3-card" style="overflow-y:auto;">
        <form action="listaOrdem_usuario.php" method="post">
            <label for="ordenacao"><b>Ordem:</b></label>
            <select name="ordenacao">
                <option value="id_user">ID</option>
                <option value="nome">Nome</option>
                <option value="login">Login</option>
                <option value="privilegio">Privilégio</option>
            </select>
            <input type="submit" value="OK">
        </form>

        <table class="w3-table-all w3-centered">
            <caption>
                <h1 class="w3-center w3-black w3-round-large">Usuários</h1>
            </caption>
            <tr class="w3-center w3-black">
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Privilégio</th>
                <th>Editar</th>
            </tr>
            <?php
            require_once 'conexaoBD.php';


            $ordem = $_POST['ordenacao'];
            $sql = "SELECT id_user, nome, login, privilegio FROM usuario WHERE id_user order by $ordem";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['id_user'] . '</td>';
                    echo '<td>' . $linha['nome'] . '</td>';
                    echo '<td>' . $linha['login'] . '</td>';
                    echo '<td>' . $linha['privilegio'] . '</td>';

                    echo '<td> <a href="editar_usuario.php?id_user=' . $linha['id_user'] . '&nome=' . $linha['nome'] . '&login=' . $linha['login'] .  '&privilegio=' . $linha['privilegio'] . '">
                                        <i class="fa fa-pen-to-square w3-large w3-text-black""></i>
                                    </a></td>
                                </td>';
                    echo '</tr>';
                }

            ?>
        </table>
    </div>
</div>
<?php require_once('rodape.php'); ?>