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
        <div class="w3-container w3-display-top">
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
                                        <input type="text" name="data_recebimento" value="<?php echo date('Y/m/d') ?> " readonly>
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
                                        <label for="morador"><b>Destinatário</b></label><br>
                                        <input type="text" name="destinatario" required>
                                    </div>
                                    <label for="propriedade">Propriedade</label>
                                    <select class="w3-input w3-border" name="propriedade" required>
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
                                        <select id="status" name="status" required>
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

            $sql = "SELECT entrega.*, propriedade.* FROM entrega, propriedade WHERE entrega.id_residencia = propriedade.id_propriedade order by data_recebimento";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['data_recebimento'] . '</td>';
                    echo '<td>' . $linha['nome_destinatario'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                    echo '<td>' . $linha['status'] . '</td>';

                    // criar um modal para relatório com muito mais dados e detalhado
                    // criar um modal para relatório com muito mais dados e detalhado
                    echo '<td><button onclick="detalhesEntrega(\'' . $linha['id_entrega'] . '\',\'' . $linha['data_recebimento'] . '\',\'' . $linha['recebido_por'] . '\',\'' . $linha['nome_destinatario'] . '\',\'' . $linha['status'] . '\')" class="w3-text-blue">Detalhes</button></td>';
                    echo '<td><button onclick="excluirEntrega(\'' . $linha['id_entrega'] . '\',\'' . $linha['data_recebimento'] . '\',\'' . $linha['tipo'] . '\',\'' . $linha['nome_destinatario'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\',\'' . $linha['status'] . '\')"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                    echo '<td><button onclick="editarEntrega(\'' . $linha['id_entrega'] . '\',\'' . $linha['data_recebimento'] . '\',\'' . $linha['tipo'] . '\',\'' . $linha['nome_destinatario'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\',\'' . $linha['status'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                    echo '</tr>';
                }

            ?>
        </table><br>

        <!-- modal para detalhes da entrega -->
        <div id="detalhes_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('detalhes_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">
                        <h2>Detalhes da Entrega</h2>
                        <span>Data de Recebimento:</span>
                        <p id="dt_receb"></p>
                        <span>Recebido Por:</span>
                        <p id="recebido"></p>
                        <span>Destinatário:</span>
                        <p id="destin"></p>
                        <span>Status:</span>
                        <p id="status_atual"></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function detalhesEntrega(dt_recebido, recebido_por, destinatario, status) {
                document.getElementById('dt_receb').value = dt_recebido;
                document.getElementById('recebido').value = recebido_por;
                document.getElementById('destin').value = destinatario;
                document.getElementById('status_atual').value = status;
                document.getElementById('detalhes_entrega').style.display = 'block';

            }
        </script>
        <!--Editar entregas -->
        <div id="editar_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('editar_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">
                        <h1 class="w3-center"><b>Editar Entrega</b></h1>
                        <form action="editar_entregaAction.php" method='post' class="w3-padding">
                            <div class="w3-cell-row">
                                <input type="text" id="id_entrega" name="id_entrega" hidden>
                                <div class="w3-cell" style=" padding-right: 15px;">
                                    <label for="data_recebimento"><b>Data de Recebimento</b></label><br>
                                    <input type="text" id="data_recebimento" name="data_recebimento" class="w3-light-grey" readonly>
                                </div>
                                <div class="w3-cell" style="padding-right: 15px;">
                                    <label for="tipo"><b>Tipo</b> </label><br>
                                    <select id="tipo" name="tipo" required>
                                        <option value="e-commerce">E-COMMERCE</option>
                                        <option value="carta">CARTA</option>
                                        <option value="sedex">SEDEX</option>
                                    </select>
                                    <div class="w3-cell">
                                        <label for="destinatario"><b>Destinatário</b></label><br>
                                        <input type="text" id="destinatario" name="destinatario" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="w3-cell-row">
                                <div class="w3-cell">
                                    <label for="apartamento"><b>Apartamento</b></label><br>
                                    <input id="apartamento_entrega" name="apartamento" required>
                                </div>
                                <div class="w3-cell">
                                    <label for="bloco"><b>Bloco</b></label><br>
                                    <input id="bloco_entrega" name="bloco" required>
                                </div>

                                <div class="w3-cell">
                                    <label for="status"><b>Status</b></label><br>
                                    <select id="status" name="status" required>
                                        <option value="entregue">Entregue</option>
                                        <option value="a retirar" selected>A Retirar</option>
                                    </select>
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
                            <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function editarEntrega(id, data, tipo, nome, numero, bloco, status) {
                document.getElementById('id_entrega').value = id;
                document.getElementById('data_recebimento').value = data;
                document.getElementById('tipo').value = tipo;
                document.getElementById('destinatario').value = nome;
                document.getElementById('apartamento_entrega').value = numero;
                document.getElementById('bloco_entrega').value = bloco;
                document.getElementById('status').value = status;
                document.getElementById('editar_entrega').style.display = 'block';

            }
        </script>
        <!--Excluir entregas -->
        <div id="excluir_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('excluir_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">
                        <h1 class="w3-center"><b>Excluir Entrega</b></h1>
                        <form action="excluir_entregaAction.php" method='post' class="w3-padding">
                            <div class="w3-cell-row">
                                <input type="text" id="cod_entrega" name="cod_entrega" hidden>
                                <div class="w3-cell" style=" padding-right: 15px;">
                                    <label for="data_recebimento"><b>Data de Recebimento</b></label><br>
                                    <input type="text" id="data_receb" name="data_recebimento " class="w3-grey" readonly>
                                </div>
                                <div class="w3-cell" style="padding-right: 15px;">
                                    <label for="tipo"><b>Tipo</b> </label><br>
                                    <select id="tipo_entrega" name="tipo" class="w3-grey" readonly>
                                        <option value="e-commerce">E-COMMERCE</option>
                                        <option value="carta">CARTA</option>
                                        <option value="sedex">SEDEX</option>
                                    </select>
                                </div>
                                <div class="w3-cell">
                                    <label for="destinatario_entrega"><b>Destinatário</b></label><br>
                                    <input type="text" id="destinatario_entrega" name="destinatario" class="w3-grey" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="w3-cell-row">
                                <div class="w3-cell">
                                    <label for="apartamento"><b>Apartamento</b></label><br>
                                    <input id="apartamento_" name="apartamento" class="w3-grey" readonly>
                                </div>
                                <div class="w3-cell">
                                    <label for="bloco"><b>Bloco</b></label><br>
                                    <input id="bloco_" name="bloco" class="w3-grey" readonly>
                                </div>

                                <div class="w3-cell">
                                    <label for="status"><b>Status</b></label><br>
                                    <select id="status_entrega" name="status" class="w3-grey" readonly>
                                        <option value="entregue">Entregue</option>
                                        <option value="a retirar" selected>A Retirar</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="w3-cell-row w3-center">
                                <div class="w3-cell" style="padding-right: 15px;">
                                    <label for="remetente"><b>Remetente</b></label><br>
                                    <input type="text" name="remetente" class="w3-grey" readonly>
                                </div>
                                <div class="w3-cell">
                                    <label for="num_registro"><b>Número de Registro</b></label><br>
                                    <input type="text" name="num_registro" class="w3-grey" readonly>
                                </div>
                            </div>
                            <br>
                            <button class="w3-btn w3-black" type="submit">CONFIRMAR EXCLUSÃO</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function excluirEntrega(id, data, tipo, nome, numero, bloco, status) {
                document.getElementById('cod_entrega').value = id;
                document.getElementById('data_receb').value = data;
                document.getElementById('tipo_entrega').value = tipo;
                document.getElementById('destinatario_entrega').value = nome;
                document.getElementById('apartamento_').value = numero;
                document.getElementById('bloco_').value = bloco;
                document.getElementById('status_entrega').value = status;
                document.getElementById('excluir_entrega').style.display = 'block';

            }
        </script>
    </div>
    <!--Aba de MORADORES -->
    <div id="moradores" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Moradores</b></h2>
        </div><br>
        <!-- Consulta de Moradores -->
        <table class="w3-table-all w3-centered w3-hoverable w3-mobile" style="overflow-y:auto;">
            <tr class="w3-center w3-blue-grey">

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