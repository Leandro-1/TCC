<div id="entregas" class="w3-container w3-border w3-white menu">
    <div class="w3-container w3-display-top">
        <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

        <button onclick="document.getElementById('cad_entrega').style.display='block'" id="botao_cad" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

        <div id="cad_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('cad_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>

                    <div class="feedbackMessage w3-padding"></div>
                    <div class="w3-container w3-padding">
                        <h2 class="w3-center w3-padding"><b>Cadastrar Encomenda</b></h2>

                        <form id="myForm_entrega" action="cadastro_encomendaAction.php" method="post" class="w3-padding">
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
                                    <option value="" selected></option>
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
                                        <option value="Entregue">Entregue</option>
                                        <option value="A retirar" selected>A Retirar</option>
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

    <!--Editar entregas -->
    <div id="editar_entrega" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('editar_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container">
                    <h1 class="w3-center"><b>Editar Entrega</b></h1>
                    <form id="form_editar_entrega" action="editar_entregaAction.php" method='post' class="w3-padding">
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
                            </div>
                            <div class="w3-cell">
                                <label for="destinatario"><b>Destinatário</b></label><br>
                                <input type="text" id="destinatario" name="destinatario" required>
                            </div>
                        </div>
                        <br>
                        <div class="w3-cell-row">
                            <div class="w3-cell">
                                <label for="propriedade">Propriedade</label>
                                <select id="propriedade" class="w3-input w3-border" name="propriedade" required>
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
                            <div class="w3-cell">
                                <label for="status"><b>Status</b></label><br>
                                <select id="status" name="status" required>
                                    <option value="entregue">Entregue</option>
                                    <option value="a retirar">A Retirar</option>
                                </select>
                            </div>
                            <div class="w3-cell" style="padding-right: 15px;">
                                <label for="retirado_por"><b>Retirado por</b></label><br>
                                <input type="text" name="retirado_por">
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
                        <div class="w3-cell-row w3-center">
                            <div class="w3-cell" style="padding-right: 15px;">
                                <label for="data_retirada"><b>Data de Retirada</b></label><br>
                                <input type="date" id="data_retirada" name="data_retirada">
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

    <!--Excluir entregas -->
    <div id="excluir_entrega" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('excluir_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container w3-padding">
                    <h1 class="w3-center"><b>Excluir Entrega</b></h1>
                    <form id="form_excluir_entrega" action="excluir_entregaAction.php" method='post' class="w3-padding">
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
</div>