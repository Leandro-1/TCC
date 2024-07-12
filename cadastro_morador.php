<?php require_once("verificaacesso_admin.php") ?>
<?php require_once('cabecalho.php') ?>

<div class="formulario">
    <div class=" w3-container w3-content w3-card w3-round" style="width: 450px;">
        <h2 class="w3-center"><b>Cadastrar Morador</b></h2>

        <form action="cadastro_moradorAction.php" method="post">
            <div class="w3-margin-bottom">
                <p class="w3-left">
                    <label for="cpf">CPF</label>
                    <input class="w3-input w3-border" type="text" name="cpf" required>
                </p>

                <p class="w3-right">
                    <label for="tel">Telefone</label>
                    <input class="w3-input w3-border" type="tel" name="tel" required>
                </p>

                <label for="nome">Nome</label>
                <input class="w3-input w3-border " type="text" name="nome" required>
                <br>

                <label for="email">E-mail</label>
                <input class="w3-input w3-border" type="email" name="email" required>

                <p class="w3-left">
                    <label for="num_ap">Número Apart</label>
                    <input class="w3-input w3-border" type="text" name="num_apart" required>
                    <br>
                </p>
                <p class="w3-right">
                    <label for="bloco">Bloco ou Quadra</label>
                    <input class="w3-input w3-border" type="text" name="bloco" required>
                    <br>
                </p>


                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                <br><br>
            </div>

        </form>
        <div class=" w3-center">
            <a href="morador.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="menu.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>
            <a href="consultar_morador.php" class="w3-display-top-center">
                <i class="fa-solid fa-list w3-xxlarge w3-button"></i>
            </a>

        </div>
    </div>
</div>
<?php require_once('rodape.php'); ?>