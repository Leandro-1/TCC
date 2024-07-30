<?php require_once("verificaacesso_todos.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Encomenda</title>
</head>
<div class="formulario">
    <div class="w3-container w3-content w3-card w3-round" style="width: 450px;">
        <h2 class="w3-center"><b>Cadastrar Encomenda</b></h2>

        <form action="cadastro_encomendaAction.php" method="post">
            <div class="w3-margin-bottom">
                <p class="w3-left">
                    <label for="tipo">Tipo</label>
                    <input class="w3-input w3-border" type="text" name="tipo" required>
                </p>

                <p class="w3-right">
                    <label for="data_recebimento">Data de Recebimento</label>
                    <input class="w3-input w3-border" type="date" name="data_recebimento" required>
                </p>

                <p class="w3-left">
                    <label for="data_retirada">Data de Retirada</label>
                    <input class="w3-input w3-border" type="date" name="data_retirada">
                </p>

                <p class="w3-right">
                    <label for="status">Status</label>
                    <select class="w3-input w3-border" name="status" required>
                        <option value="entregue">Entregue</option>
                        <option value="a retirar">A Retirar</option>
                    </select>
                </p>
                
                <label for="morador">Morador</label>
                <select class="w3-input w3-border" name="morador" required>
                    <?php 
                    $query = "SELECT cpf, nome FROM morador";
                    $result = $conexao->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row["id_morador"]) . '">' . htmlspecialchars($row["nome"]) . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhuma opção disponível</option>';
                    }
                    ?>
                </select>
                <br>

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
                <br>

                <label for="recebido_por">Recebido por</label>
                <input class="w3-input w3-border" type="text" name="recebido_por" required>
                <br>

                <label for="retirado_por">Retirado por</label>
                <input class="w3-input w3-border" type="text" name="retirado_por">
                <br>

                <label for="num_registro">Número de Registro</label>
                <input class="w3-input w3-border" type="text" name="num_registro" required>
                <br>

                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                <br><br>
            </div>
        </form>
        
        <div class="w3-center">
            <a href="encomenda.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="menu.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>
            <a href="consultar_encomenda.php" class="w3-display-top-center">
                <i class="fa-solid fa-list w3-xxlarge w3-button"></i>
            </a>
        </div>
    </div>
</div>

<?php require_once('rodape.php'); ?>
