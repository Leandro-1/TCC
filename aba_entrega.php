<div id="entregas" class="w3-container w3-border w3-white menu style="display: block;">
    <div class="w3-container w3-display-top">
        <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

        <button onclick="document.getElementById('cad_').style.display='block'" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>
        <!-- Modal de Cadastro -->
        <div id="cad_entrega" class="w3-modal">
            <div class="w3-modal-content w3-card-4 custom-modal">
                <div class="w3-container">
                    <span onclick="document.getElementById('cad_entrega').style.display='none'" 
                          class="w3-button w3-display-topright w3-hover-red w3-large">
                        <b>&times;</b>
                    </span>

                    <div id="feedbackMessage" class="w3-padding"></div>
                    <h2 class="w3-center w3-padding"><b>Cadastrar Encomenda</b></h2>

                    <form id="form_entrega" action="cadastro_encomendaAction.php" method="post" class="custom-form w3-padding">

                        <!-- Primeira Linha: Data de Recebimento, Tipo, Recebido por -->
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <label for="data_recebimento"><b>Data de Recebimento</b></label>
                                <input class="w3-input w3-border" type="text" id="data_recebimento" 
                                       name="data_recebimento" value="<?php echo date('Y/m/d'); ?>" readonly>
                            </div>
                            <div class="w3-third">
                                <label for="tipo"><b>Tipo</b></label>
                                <select class="w3-input w3-border" id="tipo" name="tipo" required>
                                    <option value="e-commerce">E-COMMERCE</option>
                                    <option value="carta">CARTA</option>
                                    <option value="sedex">SEDEX</option>
                                </select>
                            </div>
                            <div class="w3-third">
                                <label for="recebido_por"><b>Recebido por</b></label>
                                <input class="w3-input w3-border" type="text" id="recebido_por" 
                                       name="recebido_por" readonly value="<?php echo ucwords($_SESSION['nome']); ?>">
                            </div>
                        </div>

                        <br>

                        <!-- Segunda Linha: Destinatário, Propriedade -->
                        <div class="w3-row-padding">
                            <div class="w3-half">
                                <label for="destinatario"><b>Destinatário</b></label>
                                <input class="w3-input w3-border" type="text" id="destinatario" name="destinatario" required>
                            </div>
                            <div class="w3-half">
                                <label for="propriedade"><b>Propriedade</b></label>
                                <select class="w3-input w3-border" id="propriedade" name="propriedade" required>
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
                        </div>

                        <br>

                        <!-- Terceira Linha: Remetente, Número de Registro -->
                        <div class="w3-row-padding">
                            <div class="w3-half">
                                <label for="remetente"><b>Remetente</b></label>
                                <input class="w3-input w3-border" type="text" id="remetente" name="remetente">
                            </div>
                            <div class="w3-half">
                                <label for="num_registro"><b>Número de Registro</b></label>
                                <input class="w3-input w3-border" type="text" id="num_registro" name="num_registro">
                            </div>
                        </div>

                        <br>

                        <!-- Quarta Linha: Status, Retirado por, Data de Retirada -->
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <label for="status"><b>Status</b></label>
                                <select class="w3-input w3-border" id="status" name="status" required>
                                    <option value="Entregue">Entregue</option>
                                    <option value="A retirar" selected>A Retirar</option>
                                </select>
                            </div>
                            <div class="w3-third">
                                <label for="retirado_por"><b>Retirado por</b></label>
                                <input class="w3-input w3-border" type="text" id="retirado_por" name="retirado_por">
                            </div>
                            <div class="w3-third">
                                <label for="data_retirada"><b>Data de Retirada</b></label>
                                <input class="w3-input w3-border" type="date" id="data_retirada" name="data_retirada">
                            </div>
                        </div>

                        <br>

                        <!-- Botão de Cadastrar -->
                        <div class="w3-center">
                            <button id="submit" class="w3-btn w3-black" type="submit">CADASTRAR</button>
                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>



    <!-- Consulta de Entregas -->
    <table class="w3-table-all w3-centered w3-hoverable" style="padding-top:100px;margin-top: 20px;">
    <tr class="w3-center w3-blue-grey">
        <th>Data Recebimento</th>
        <th>Destinatário</th>
        <th>Apartamento</th>
        <th>Bloco</th>
        <th>Status</th>
        <th>Relatório</th>
        <th>Excluir</th>
        <th>Editar</th>
    </tr>
    <?php
    $sql = "SELECT entrega.*, propriedade.* FROM entrega JOIN propriedade ON entrega.id_residencia = propriedade.id_propriedade ORDER BY data_recebimento";
    if ($resultado = $conexao->query($sql)) {
        foreach ($resultado as $linha) {
            echo '<tr class="w3-text-black">';
            echo '<td>' . htmlspecialchars($linha['data_recebimento']) . '</td>';
            echo '<td>' . htmlspecialchars($linha['nome_destinatario']) . '</td>';
            echo '<td>' . htmlspecialchars($linha['num_propriedade']) . '</td>';
            echo '<td>' . htmlspecialchars($linha['bloco_quadra']) . '</td>';
            echo '<td>' . htmlspecialchars($linha['status']) . '</td>';

            // Botão de detalhes
            echo '<td><button onclick="detalhesEntrega(\'' . htmlspecialchars($linha['id_entrega']) . '\',\'' . htmlspecialchars($linha['data_recebimento']) . '\',\'' . htmlspecialchars($linha['recebido_por']) . '\',\'' . htmlspecialchars($linha['nome_destinatario']) . '\',\'' . htmlspecialchars($linha['status']) . '\')" class="w3-text-blue" aria-label="Ver detalhes da entrega">Detalhes</button></td>';
            
            // Botão de exclusão
            echo '<td><button onclick="excluirEntrega(\'' . htmlspecialchars($linha['id_entrega']) . '\',\'' . htmlspecialchars($linha['data_recebimento']) . '\',\'' . htmlspecialchars($linha['tipo']) . '\',\'' . htmlspecialchars($linha['nome_destinatario']) . '\',\'' . htmlspecialchars($linha['num_propriedade']) . '\',\'' . htmlspecialchars($linha['bloco_quadra']) . '\',\'' . htmlspecialchars($linha['status']) . '\')" aria-label="Excluir entrega"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
            
            // Botão de edição
            echo '<td><button onclick="editarEntrega(\'' . htmlspecialchars($linha['id_entrega']) . '\',\'' . htmlspecialchars($linha['data_recebimento']) . '\',\'' . htmlspecialchars($linha['tipo']) . '\',\'' . htmlspecialchars($linha['nome_destinatario']) . '\',\'' . htmlspecialchars($linha['num_propriedade']) . '\',\'' . htmlspecialchars($linha['bloco_quadra']) . '\',\'' . htmlspecialchars($linha['status']) . '\')" aria-label="Editar entrega"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
            
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="8" class="w3-text-red">Erro ao carregar as entregas.</td></tr>';
    }
    ?>
</table>


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
            <span onclick="document.getElementById('editar_entrega').style.display='none'" 
                  class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <div class="feedbackMessage w3-padding"></div>
            <div class="w3-container">
                <h1 class="w3-center"><b>Editar Entrega</b></h1>
                
                <form id="form_editar_entrega" action="editar_entregaAction.php" method="post" class="w3-padding">
                    <input type="hidden" id="id_entrega" name="id_entrega">

                    <!-- Primeira Linha: Data de Recebimento, Tipo e Destinatário -->
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="data_recebimento"><b>Data de Recebimento</b></label>
                            <input type="text" id="data_recebimento" name="data_recebimento" class="w3-input w3-light-grey" readonly>
                        </div>
                        <div class="w3-third">
                            <label for="tipo"><b>Tipo</b></label>
                            <select id="tipo" name="tipo" class="w3-select" required>
                                <option value="e-commerce">E-COMMERCE</option>
                                <option value="carta">CARTA</option>
                                <option value="sedex">SEDEX</option>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="destinatario"><b>Destinatário</b></label>
                            <input type="text" id="destinatario" name="destinatario" class="w3-input" required>
                        </div>
                    </div>
                    
                    <!-- Segunda Linha: Propriedade, Status e Retirado por -->
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="propriedade"><b>Propriedade</b></label>
                            <select id="propriedade" name="propriedade" class="w3-select w3-border" required>
                                <?php
                                    $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                                    $result = $conexao->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row["id_propriedade"]) . '">' 
                                                . htmlspecialchars($row["bloco_quadra"] . ' - ' . $row["num_propriedade"]) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Nenhuma opção disponível</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="status"><b>Status</b></label>
                            <select id="status" name="status" class="w3-select" required>
                                <option value="entregue">Entregue</option>
                                <option value="a retirar">A Retirar</option>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="retirado_por"><b>Retirado por</b></label>
                            <input type="text" id="retirado_por" name="retirado_por" class="w3-input">
                        </div>
                    </div>

                    <!-- Terceira Linha: Remetente e Número de Registro -->
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="remetente"><b>Remetente</b></label>
                            <input type="text" id="remetente" name="remetente" class="w3-input">
                        </div>
                        <div class="w3-half">
                            <label for="num_registro"><b>Número de Registro</b></label>
                            <input type="text" id="num_registro" name="num_registro" class="w3-input">
                        </div>
                    </div>

                    <!-- Quarta Linha: Data de Retirada -->
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="data_retirada"><b>Data de Retirada</b></label>
                            <input type="date" id="data_retirada" name="data_retirada" class="w3-input">
                        </div>
                    </div>
                    
                    <!-- Botão de Atualizar -->
                    <div class="w3-center w3-padding">
                        <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Excluir Entregas -->
<div id="excluir_entrega" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('excluir_entrega').style.display='none'" 
                  class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <div class="feedbackMessage w3-padding"></div>
            <div class="w3-container w3-padding">
                <h1 class="w3-center"><b>Excluir Entrega</b></h1>
                
                <form id="form_excluir_entrega" action="excluir_entregaAction.php" method="post" class="w3-padding">
                    <input type="hidden" id="cod_entrega" name="cod_entrega">
                    
                    <!-- Primeira Linha: Data de Recebimento, Tipo e Destinatário -->
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="data_recebimento"><b>Data de Recebimento</b></label>
                            <input type="text" id="data_receb" name="data_recebimento" class="w3-input w3-grey" readonly>
                        </div>
                        <div class="w3-third">
                            <label for="tipo"><b>Tipo</b></label>
                            <select id="tipo_entrega" name="tipo" class="w3-select w3-grey" readonly>
                                <option value="e-commerce">E-COMMERCE</option>
                                <option value="carta">CARTA</option>
                                <option value="sedex">SEDEX</option>
                            </select>
                        </div>
                        <div class="w3-third">
                            <label for="destinatario_entrega"><b>Destinatário</b></label>
                            <input type="text" id="destinatario_entrega" name="destinatario" class="w3-input w3-grey" readonly>
                        </div>
                    </div>
                    
                    <!-- Segunda Linha: Apartamento, Bloco e Status -->
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <label for="apartamento"><b>Apartamento</b></label>
                            <input type="text" id="apartamento_" name="apartamento" class="w3-input w3-grey" readonly>
                        </div>
                        <div class="w3-third">
                            <label for="bloco"><b>Bloco</b></label>
                            <input type="text" id="bloco_" name="bloco" class="w3-input w3-grey" readonly>
                        </div>
                        <div class="w3-third">
                            <label for="status"><b>Status</b></label>
                            <select id="status_entrega" name="status" class="w3-select w3-grey" readonly>
                                <option value="entregue">Entregue</option>
                                <option value="a retirar" selected>A Retirar</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Terceira Linha: Remetente e Número de Registro -->
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <label for="remetente"><b>Remetente</b></label>
                            <input type="text" id="remetente" name="remetente" class="w3-input w3-grey" readonly>
                        </div>
                        <div class="w3-half">
                            <label for="num_registro"><b>Número de Registro</b></label>
                            <input type="text" id="num_registro" name="num_registro" class="w3-input w3-grey" readonly>
                        </div>
                    </div>
                    
                    <!-- Botão de confirmação -->
                    <div class="w3-center w3-padding">
                        <button class="w3-btn w3-black" type="submit">CONFIRMAR EXCLUSÃO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
