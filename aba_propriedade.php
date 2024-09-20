<div id="propriedades" class="w3-container w3-border menu" style="display:none">
    <div class="w3-container w3-display-top">
        <h2 class="w3-center"><b>Consulta de Propriedades</b></h2>

        <!--Cadastro de propriedade com caixa Modal -->
        <button onclick="document.getElementById('cad_propriedade').style.display='block'" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

        <div id="cad_propriedade" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('cad_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="feedbackMessage w3-padding"></div>
                    <div class="w3-container w3-padding">
                        <h1 class="w3-center w3-padding"><b>Cadastrar Propriedade</b></h1>
                        <form id="myForm_propriedade" action="cadastro_propriedadeAction.php" method="post" class="w3-padding">
                            <div class="w3-container w3-margin-bottom">
                                <div class="cod" style="width:35%;">
                                    <label for="codigo"><b>Código</b> </label>
                                    <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" readonly>
                                </div>
                                <br>
                                <div class="w3-cell-row">
                                    <div class="w3-cell" style="width: 50%; padding-right: 15px;">
                                        <label for="numero"><b>Número</b> </label>
                                        <input class="w3-input w3-border" type="number" name="numero" required>
                                    </div>
                                    <div class="w3-cell" style="width: 50%;">
                                        <label for="bloco"><b>Bloco ou Quadra</b></label>
                                        <input class="w3-input w3-border" type="text" name="bloco" required>
                                    </div>
                                </div>
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
    <!-- Consulta de propriedade -->
    <table class="w3-table-all w3-centered w3-hoverable">
        <tr class="w3-center w3-blue-grey">
            <th>Código</th>
            <th>Número</th>
            <th>Bloco/Quadra</th>
            <th>Editar</th>
        </tr>
        <?php
        require_once('conexaoBD.php');
        $sql = "SELECT * FROM propriedade order by num_propriedade";
        $resultado = $conexao->query($sql);
        if ($resultado != null)
            foreach ($resultado as $linha) {
                echo '<tr class=w3-text-black>';
                echo '<td>' . $linha['id_propriedade'] . '</td>';
                echo '<td>' . $linha['num_propriedade'] . '</td>';
                echo '<td>' . $linha['bloco_quadra'] . '</td>';
                echo '<td><button onclick="editarPropriedade(\'' . $linha['id_propriedade'] . '\', \'' . $linha['num_propriedade'] . '\', \'' . $linha['bloco_quadra'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                echo '</tr>';
            }
        ?>
    </table><br>

    <!--Editar propriedade -->
    <div id="editar_propriedade" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('editar_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container w3-padding">
                    <h1 class="w3-center w3-padding"><b>Editar Propriedade</b></h1>
                    <form id="form_editar_propriedade" action="editar_propriedadeAction.php" method='post' class="w3-padding">
                        <input id="txtCodigo" name="txtCodigo" class="w3-input w3-grey w3-border">
                        <br>
                        <label class="w3-text-black" style="font-weight: bold;">Número</label>
                        <input id="txtNumero" name="txtNumero" class="w3-input w3-light-grey w3-border">
                        <br>
                        <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                        <input id="txtBloco" name="txtBloco" class="w3-input w3-light-grey w3-border">
                        <br>
                        <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>