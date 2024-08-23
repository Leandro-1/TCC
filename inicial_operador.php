<?php
//2 primeiras linhas: verificaçaõ unica de acesso para todos os usuario, chamando somente a funcao e colocando o tipo de usuario
//podendo assim excluir o arquivos 'verificar acesso adm e todos'
require_once('verificar_permissaoAcesso.php');
verificar_permissao('operador');
require_once('cabecalho.php');
require_once('conexaoBD.php');
?>

<div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">

    <div class="w3-bar aba_menu">
        <div class="abas w3-blue-grey">
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'propriedades')"><b>Propriedades</b></button>
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'usuarios')"><b>Usuários</b></button>
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'moradores')"><b>Moradores</b></button>
            <button class="w3-bar-item w3-button tablink  w3-right w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
        </div>
    </div>

    <!--Aba de entregas -->
    <div id="entregas" class="w3-container w3-border w3-white menu">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

            <!--Cadastro de entregas com caixa Modal -->
            <button onclick="document.getElementById('cad_entrega').style.display='block'" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

            <div id="cad_entrega" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('cad_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container w3-padding">
                            <h2 class="w3-center w3-padding"><b>Cadastrar Encomenda</b></h2>
                            <form action="cadastro_encomendaAction.php" method="post" class="w3-padding">
                                <div class="w3-cell-row">
                                    <div class="w3-cell" style=" padding-right: 15px;">
                                        <label for="data_recebimento"><b>Data de Recebimento</b></label><br>
                                        <input type="text" name="data_recebimento" value="<?php echo date('d/m/Y'); ?>" readonly>
                                    </div>
                                    <div class="w3-cell" style="padding-right: 15px;">
                                        <label for="tipo"><b>Tipo</b> </label><br>
                                        <select name="tipo" required>
                                            <option value="e-commerce">E-COMMERCE</option>
                                            <option value="carta">CARTA</option>
                                            <option value="sedex">SEDEX</option>
                                        </select>
                                    </div>
                                    <div class="w3-cell">
                                        <label for="recebido_por"><b>Recebido por</b> </label><br>
                                        <input type="text" name="recebido_por" readonly value="<?php echo ucwords($_SESSION['nome']) ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="w3-cell-row">
                                    <div class="w3-cell">
                                        <label for="propriedade"><b>Propriedade</b></label><br>
                                        <select name="propriedade" required>
                                            <option value="" disabled selected>Selecione a propriedade</option>
                                            <?php

                                            $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                                            $result = $conexao->query($query);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row["id_propriedade"]) . '">' . htmlspecialchars($row["bloco_quadra"] . ' - ' . $row["num_propriedade"]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">Nenhuma opção disponível</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="w3-cell" style="padding-right: 15px;">
                                        <label for="morador"><b>Destinatário</b></label><br>
                                        <input type="text" name="destinatario">
                                    </div>
                                </div>
                                <br>
                                <div class="w3-cell-row w3-center">
                                    <div class="w3-cell" style="padding-right: 15px;">
                                        <label for="remetente"><b>Remetente</b></label><br>
                                        <input type="text" name="remetente">
                                    </div>
                                    <div class="w3-cell">
                                        <label for="num_registro"><b>Número de Registro</b></label><br>
                                        <input type="text" name="num_registro">
                                    </div>
                                </div>
                                <br>
                                <div class="w3-cell-row">
                                    <div class="w3-cell">
                                        <label for="status"><b>Status</b></label><br>
                                        <select name="status" required>
                                            <option value="entregue">Entregue</option>
                                            <option value="a retirar" selected>A Retirar</option>
                                        </select>
                                    </div>
                                    <div class="w3-cell" style="padding-right: 15px;">
                                        <label for="retirado_por"><b>Retirado por</b></label><br>
                                        <input type="text" name="retirado_por">
                                    </div>
                                    <div class="w3-cell">
                                        <label for="data_retirada"><b>Data de Retirada</b></label><br>
                                        <input type="date" name="data_retirada">
                                    </div>

                                </div>
                                <br>

                                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                            </form><br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Consulta de Entregas -->
        <table class="w3-table-all w3-centered w3-hoverable" style="overflow-y:auto; ">
            <tr class="w3-center w3-blue-grey">
                <th>Data Recebimento</th>
                <th>Destinatário</th>
                <th>Apartamento</th>
                <th>bloco</th>
                <th>Status</th>
                <th>Relatório</th>
                <th>Excluir</th>
                <th>Editar</th>
            </tr>
            <?php

            // fazer a consulta ainda
            $sql = "SELECT entrega.data_recebimento, entrega.nome_morador, propriedade.num_propriedade, propriedade.bloco_quadra, entrega.status FROM entrega, propriedade WHERE entrega.id_residencia = propriedade.id_propriedade order by data_recebimento";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['data_recebimento'] . '</td>';
                    echo '<td>' . $linha['nome_morador'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                    echo '<td>' . $linha['status'] . '</td>';

                    // criar um modal para relatório com muito mais dados e detalhado
                    echo '<td><a href="relatorio_entrega.php?dt_recebimento=' . $linha['data_recebimento'] . '&nome=' . $linha['nome_morador'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '&status=' . $linha['status'] . '" class="w3-text-blue">Detalhes</a></td>';

                    echo '<td><button onclick="excluirEntrega(\'' . $linha['data_recebimento'] . '\',\'' . $linha['nome_morador'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\',\'' . $linha['status'] . '\')"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                    echo '<td><button onclick="editarEntrega(\'' . $linha['data_recebimento'] . '\',\'' . $linha['nome_morador'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\',\'' . $linha['status'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                    echo '</tr>';
                }

            ?>
        </table><br>
        <!--Editar entregas -->
        <div id="editar_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('editar_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">

                    </div>
                </div>
            </div>
        </div>
        <!--Excluir entregas -->
        <div id="excluir_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('excluir_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Aba de MORADORES -->
    <div id="moradores" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Moradores</b></h2>
        </div><br>
        <!-- Consulta de Moradores -->
        <table class="w3-table-all w3-centered w3-hoverable w3-mobile" style="overflow-y:auto;">
            <tr class="w3-center w3-blue-grey">
                <th>CPF</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Apartamento</th>
                <th>Bloco/Quadra</th>
            </tr>
            <?php

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
                }

            ?>
        </table><br>

    </div>


    <!--Aba de usuários -->
    <div id="usuarios" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Usuários</b></h2>
        </div>
        <br>
        <!-- Consulta de usuarios -->
        <table class="w3-table-all w3-centered w3-hoverable">
            <tr class="w3-center w3-blue-grey">
                <th>Código</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Privilégio</th>
            </tr>

            <?php

            try {
                $sql = "SELECT * FROM usuario";
                $resultado = $conexao->query($sql);

                if ($resultado != null) {
                    foreach ($resultado as $linha) {
                        echo '<tr class="w3-text-black">';
                        echo '<td>' . htmlspecialchars($linha['id_user'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($linha['login'], ENT_QUOTES, 'UTF-8') . '</td>';
                        echo '<td>' . htmlspecialchars($linha['privilegio'], ENT_QUOTES, 'UTF-8') . '</td>';
                    }
                } else {
                    echo '<tr><td colspan="5" class="w3-center">Nenhum usuário encontrado.</td></tr>';
                }
            } catch (PDOException $e) {
                echo '<tr><td colspan="5" class="w3-center">Erro ao consultar usuários: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
            }
            ?>
        </table><br>
    </div>


    <!--Aba de Propriedade -->
    <div id="propriedades" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Propriedades</b></h2>
        </div>
        <br>
        <!-- Consulta de propriedade -->
        <table class="w3-table-all w3-centered w3-hoverable">
            <tr class="w3-center w3-blue-grey">
                <th>Código</th>
                <th>Número</th>
                <th>Bloco/Quadra</th>
            </tr>
            <?php

            $sql = "SELECT * FROM propriedade order by num_propriedade";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['id_propriedade'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                }
            ?>
        </table><br>

    </div>
</div><br><br>

<?php require_once('rodape.php'); ?>