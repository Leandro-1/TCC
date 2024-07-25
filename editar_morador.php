<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<title>Editar Morador</title>
</head>

<body>
    <div class="w3-container w3-card w3-round" style="width: 450px;">
        <h1 class="w3-center"><b>Editar Morador</b></h1>
        <form action="editar_moradorAction.php" method='post'>
            <p class="w3-left">
                <label class="w3-text-black" style="font-weight: bold;">CPF</label>
                <input name="id" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['id'] ?>">
            </p>
            <p class="w3-right">
                <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                <input name="txtTel" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['tel'] ?>">
            </p>
            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
            <input name="txtNome" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['nome'] ?>">
            <br>
            <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
            <input name="txtEmail" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['email'] ?>">
            <br>
            <label for="propriedade">Propriedade</label>
            <select class="w3-input w3-border" name="propriedade">
                <?php
                require_once('conexaoBD.php');
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
            <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
        </form><br>
        <div class=" w3-center">
            <a href="consultar_morador.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="morador.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>


            <a href="logoutAction.php" class="w3-display-top-center">
                <i class="fa fa-sign-out w3-xxlarge w3-button" style="color: red;"></i>
            </a>
        </div>
    </div>
    <?php require_once("rodape.php"); ?>