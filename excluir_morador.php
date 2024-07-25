<?php require_once("verificaacesso_admin.php") ?>
<?php require_once('cabecalho.php'); ?>

<div class="formulario">
    <div class="w3-container w3-content w3-card w3-round" style="width:450px;">
        <h2 class="w3-center"><b>Excluir Morador</b></h2>
        <form action="excluir_moradorAction.php" method="post">
        <p class="w3-left">
        <label class="w3-text-black" style="font-weight: bold;">CPF</label>
        <input name="cpf" class="w3-input w3-grey w3-border" readonly value="<?php echo htmlspecialchars($_GET['id']); ?>">
    </p>
            <p class="w3-right">
                <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                <input name="txtTel" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['tel'] ?>">
            </p>
            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
            <input name="txtNome" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['nome'] ?>">
    <br>
            <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
            <input name="txtEmail" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['email'] ?>">

            <p class="w3-left">
                <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                <input name="txtApart" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['num_apart'] ?>">
            </p>
            <p class="w3-right">
                <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                <input name="txtBloco" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['bloco'] ?>">
            </p>
            <button class="w3-btn w3-black" type="submit">Confirmar Exclusão!</button>

        </form><br>
        <div class=" w3-center">
            <a href="consultar_morador.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="morador.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>

            <a href="consultar_morador.php">
                <i class="fa fa-ban w3-xxlarge w3-button w3-text-red"></i>
            </a>
        </div>
    </div>

    <?php require_once('rodape.php'); ?>