<?php require_once("verificaacesso_todos.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Encomenda</title>
<style>
    .formulario {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
    }
    .form-container h2 {
        margin-bottom: 20px;
    }
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        flex: 1;
        min-width: 200px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-group button {
        width: 100%;
        padding: 10px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .form-group button:hover {
        background-color: #444;
    }
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }
    .form-actions a {
        color: #000;
        text-decoration: none;
        padding: 10px;
        border-radius: 4px;
        background-color: #f0f0f0;
        transition: background-color 0.3s;
    }
    .form-actions a:hover {
        background-color: #ddd;
    }
    .icon-button {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>
</head>
<body>
<div class="formulario">
    <div class="form-container">
        <h2 class="w3-center"><b>Cadastrar Encomenda</b></h2>
        <form action="cadastro_encomendaAction.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" required>
                        <option value="" disabled selected>Selecione o tipo</option>
                        <option value="e-commerce">E-COMMERCE</option>
                        <option value="carta">CARTA</option>
                        <option value="sedex">SEDEX</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="" disabled selected>Selecione o status</option>
                        <option value="entregue">Entregue</option>
                        <option value="a retirar">A Retirar</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="data_recebimento">Data de Recebimento</label>
                    <input type="date" name="data_recebimento" required>
                </div>
                <div class="form-group">
                    <label for="data_retirada">Data de Retirada</label>
                    <input type="date" name="data_retirada">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="morador">Morador</label>
                    <select name="morador" required>
                        <option value="" disabled selected>Selecione o morador</option>
                        <?php 
                        $query = "SELECT cpf, nome FROM morador";
                        $result = $conexao->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($row["cpf"]) . '">' . htmlspecialchars($row["nome"]) . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhuma opção disponível</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="propriedade">Propriedade</label>
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
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="remetente">Remetente</label>
                    <input type="text" name="remetente" required>
                </div>
                <div class="form-group">
                    <label for="recebido_por">Recebido por</label>
                    <input type="text" name="recebido_por" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="retirado_por">Retirado por</label>
                    <input type="text" name="retirado_por">
                </div>
                <div class="form-group">
                    <label for="num_registro">Número de Registro</label>
                    <input type="text" name="num_registro" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">CADASTRAR</button>
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
</body>
