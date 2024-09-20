


<button onclick="document.getElementById('cad_entrega').style.display='block'" id="botao_cad" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

<div id="cad_entrega" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('cad_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <div class="feedbackMessage" style="display:none;"></div>
            <div class="w3-container w3-padding">
                <h2 class="w3-center w3-padding"><b>Cadastrar Encomenda</b></h2>

                <form id="myForm1" action="cadastro_encomendaAction.php" method="post" class="w3-padding">
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

<!--Excluir entregas -->
<div id="excluir_entrega" class="w3-modal">
<div class="w3-modal-content">
    <div class="w3-container">
        <span onclick="document.getElementById('excluir_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
        <div class="w3-container w3-padding">
            <h1 class="w3-center"><b>Excluir Entrega</b></h1>
            <form class="myForm" action="excluir_entregaAction.php" method='post' class="w3-padding">
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
                <div class="feedbackMessage" style="display:none;"></div>
                <br>
                <button class="w3-btn w3-black" type="submit">CONFIRMAR EXCLUSÃO</button>
                <br>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<!--Aba de MORADORES -->
<div id="moradores" class="w3-container w3-border menu" style="display:none">
<div class="w3-container w3-display-top">
<h2 class="w3-center"><b>Consulta de Moradores</b></h2>

<!--Cadastro de moradores com caixa Modal -->
<button onclick="document.getElementById('cad_morador').style.display='block'" class="botao_cad w3-right w3-round-xlarge  w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

<div id="cad_morador" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('cad_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <div class="feedbackMessage" style="display:none;"></div>
            <div class="w3-container w3-padding">
                <h2 class="w3-center w3-padding"><b>Cadastrar Morador</b></h2><br>
                <form id="myForm2" action="cadastro_moradorAction.php" method="post" class="w3-padding">
                    <div class="w3-margin-bottom">
                        <div class="w3-cell-row">
                            <div class="w3-cell " style="padding-right: 15px; width:30%;">
                                <label for="cpf"><b>CPF</b> </label>
                                <input class="w3-input w3-border" name="cpf" required pattern="\d{11}" title="O CPF deve conter 11 dígitos.">
                            </div>

                            <div class="w3-cell">
                                <label for="nome"><b>Nome</b> </label>
                                <input class="w3-input w3-border" type="text" name="nome" required>
                            </div>
                        </div><br>
                        <div class="w3-cell-row">
                            <div class="w3-cell " style="padding-right: 15px; width:30%;">
                                <label for="tel"><b>Telefone</b> </label>
                                <input class="w3-input w3-border" type="tel" name="tel" required pattern="\d{10,11}" title="O telefone deve conter 10 ou 11 dígitos.">
                            </div>
                            <div class="w3-cell ">
                                <label for="email"><b>E-mail</b></label>
                                <input class="w3-input w3-border" type="email" name="email" required>
                                <br>
                            </div>
                        </div><br>
                        <label for="propriedade"><b>Propriedade</b></label>
                        <select class="w3-input w3-border" name="propriedade" required style="width:30%;">
                            <option value=""></option>
                            <?php
                            $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                            $result = $conexao->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value=" ' . htmlspecialchars($row["id_propriedade"]) . '">' . htmlspecialchars($row["num_propriedade"] . ' - ' . $row["bloco_quadra"]) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br>

                        <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
<br>

<!-- Consulta de Moradores -->
<table class="w3-table-all w3-centered w3-hoverable w3-mobile" style="overflow-y:auto;">
    <tr class="w3-center w3-blue-grey">

        <th>Nome</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>Apartamento</th>
        <th>Bloco/Quadra</th>
        <th>Excluir</th>
        <th>Editar</th>
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
            echo '<td><button onclick="excluirMorador(\'' . $linha['cpf'] . '\',\'' . $linha['nome'] . '\',\'' . $linha['telefone'] . '\',\'' . $linha['email'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\')"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
            echo '<td><button onclick="editarMorador(\'' . $linha['cpf'] . '\',\'' . $linha['nome'] . '\',\'' . $linha['telefone'] . '\',\'' . $linha['email'] . '\',\'' . $linha['num_propriedade'] . '\',\'' . $linha['bloco_quadra'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
            echo '</tr>';
        }

    ?>
</table><br>
<!--Editar moradores -->
<div id="editar_morador" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('editar_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <h1 class="w3-center"><b>Editar Morador</b></h1>
            <form action="editar_moradorAction.php" method='post' class="w3-padding">
                <div class="w3-cell-row">
                    <input id="cpf" name="cpf" class="w3-input w3-grey w3-border" type="hidden">

                    <div class="w3-cell">
                        <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                        <input id="nome" name="nome" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
                <div class="w3-cell-row">
                    <div class="w3-cell" style="padding-right: 15px; width:30%;">
                        <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                        <input id="tel" name="tel" class="w3-input w3-light-grey w3-border">
                    </div>
                    <div>
                        <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                        <input id="email" name="email" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
                <div class="w3-cell-row">
                    <div class="w3-cell" style="padding-right: 15px;">
                        <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                        <input id="num_apart" name="num_apart" class="w3-input w3-light-grey w3-border">
                    </div>
                    <div class="w3-cell">
                        <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                        <input id="bloco_quadra" name="bloco_quadra" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
                <button class="w3-btn w3-black" type="submit">Alterar</button>
            </form><br>

        </div>
    </div>
</div>
<!--Excluir Morador -->
<div id="excluir_morador" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('excluir_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <div class="w3-container">
                <h2 class="w3-center"><b>Excluir Morador</b></h2>
                <form action="excluir_moradorAction.php" method="post" class="w3-padding">
                    <div class="w3-cell-row">
                        <input id="txtcpf" name="cpf" class="w3-input w3-grey w3-border" type="hidden" readonly>

                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                            <input id="txtnome" name="tel" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <div class="w3-cell-row">
                        <div class="w3-cell" style="padding-right: 15px; width:30%;">
                            <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                            <input id="txttel" name="nome" class="w3-input w3-grey w3-border" readonly>
                        </div>
                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                            <input id="txtemail" name="email" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <div class="w3-cell-row">
                        <div class="w3-cell" style="padding-right: 15px;">
                            <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                            <input id="numapart" name="numapart" class="w3-input w3-grey w3-border" readonly>
                        </div>
                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                            <input id="txtbloco" name="bloco" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <button class="w3-btn w3-black" type="submit">Confirmar Exclusão</button>

                </form><br>
            </div>
        </div>
    </div>
</div>
</div>

