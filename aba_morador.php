<div id="moradores" class="w3-container w3-border menu" style="display:none">
    <div class="w3-container w3-display-top">
        <h2 class="w3-center"><b>Consulta de Moradores</b></h2>

        <!--Cadastro de moradores com caixa Modal -->
        <button onclick="document.getElementById('cad_morador').style.display='block'" class="botao_cad w3-right w3-round-xlarge  w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

        <div id="cad_morador" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('cad_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="feedbackMessage w3-padding"></div>
                    <div class="w3-container w3-padding">
                        <h2 class="w3-center w3-padding"><b>Cadastrar Morador</b></h2><br>
                        <form id="myForm_morador" action="cadastro_moradorAction.php" method="post" class="w3-padding">
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
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container w3-padding">
                    <h1 class="w3-center w3-padding"><b>Editar Morador</b></h1>
                    <form id="form_editar_morador" action="editar_moradorAction.php" method='post' class="w3-padding">
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
    </div>

    <!--Excluir Morador -->
    <div id="excluir_morador" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('excluir_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container w3-padding">
                    <h2 class="w3-center w3-padding"><b>Excluir Morador</b></h2>
                    <form id="form_excluir_morador" action="excluir_moradorAction.php" method="post" class="w3-padding">
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