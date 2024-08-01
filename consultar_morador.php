<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>

<div class="formulario w3-display-flex">
    <div class="w3-padding w3-margin w3-card-4 w3-cell">
        <div class="w3-displey-top w3-padding">
            <form action="listaOrdem_morador.php" method="post">
                <label for="ordenacao"><b>Ordem:</b></label>
                <select name="ordenacao">
                    <option value="nome" select>Nome</option>
                    <option value="bloco_quadra">Bloco</option>
                    <option value="num_propriedade">Apartamento</option>
                </select>
                <input type="submit" value="OK">
            </form>
            <div>
                <a href="cadastro_morador.php"> <button class="w3-right w3-round-xlarge w3-blue w3-large w3-padding" type="submit">Novo Cadastro</button></a>
            </div>
        </div>

        <table class="w3-table-all w3-centered  w3-cell" style="overflow-y:auto;">
            <caption>
                <h1 class="w3-center w3-black w3-round-large">Moradores</h1>
            </caption>
            <tr class="w3-center w3-black">
                <th>CPF</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Apartamento</th>
                <th>Bloco/Quadra</th>
                <th>Excluir</th>
                <th>Editar</th>
            </tr>
            <?php
            require_once 'conexaoBD.php';


            $sql = "SELECT morador.cpf, morador.nome, morador.telefone, morador.email, propriedade.num_propriedade, propriedade.bloco_quadra FROM morador, propriedade WHERE morador.id_propriedade = propriedade.id_propriedade order by nome";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['cpf'] . '</td>';
                    echo '<td>' . $linha['nome'] . '</td>';
                    echo '<td>' . $linha['telefone'] . '</td>';
                    echo '<td>' . $linha['email'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                    echo '<td><a href="excluir_morador.php?cpf=' . $linha['cpf'] . '&nome=' . $linha['nome'] . '&tel=' . $linha['telefone'] .  '&email=' . $linha['email'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-user-times w3-large w3-text-black"></i> 
                                    </a></td>
                            </td>';
                    echo '<td> <a href="editar_morador.php?cpf=' . $linha['cpf'] . '&nome=' . $linha['nome'] . '&tel=' . $linha['telefone'] .  '&email=' . $linha['email'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
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