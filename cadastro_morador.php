<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("conexaoBD.php"); ?>
<?php require_once('cabecalho.php'); ?>
<title>Cadastro Morador</title>
</head>
<style>
   
    
    .alert {
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        margin-left: 60px;
        margin-right: 0;
        position: absolute;

    }
</style>

<div class="formulario">
    <?php


    // Verifica se há mensagem de sucesso ou erro
    if (isset($_SESSION['mensagem'])) {
        echo '<div class="alert">' . $_SESSION['mensagem'] . '</div>';
        unset($_SESSION['mensagem']); // Limpa a mensagem após exibição
    }
    ?>
    <div class="w3-container w3-content w3-card w3-round" style="width: 450px;">

        <h2 class="w3-center"><b>Cadastrar Morador</b></h2>

        <form action="cadastro_moradorAction.php" method="post">
            <div class="w3-margin-bottom">
                <p class="w3-left">
                    <label for="cpf">CPF</label>
                    <input class="w3-input w3-border" name="cpf" required pattern="\d{11}" title="O CPF deve conter 11 dígitos.">
                </p>

                <p class="w3-right">
                    <label for="tel">Telefone</label>
                    <input class="w3-input w3-border" type="tel" name="tel" required pattern="\d{10,11}" title="O telefone deve conter 10 ou 11 dígitos.">
                </p>


                <label for="nome">Nome</label>
                <input class="w3-input w3-border" type="text" name="nome" required>
                <br>

                <label for="email">E-mail</label>
                <input class="w3-input w3-border" type="email" name="email" required>
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

                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                <br><br>
            </div>
        </form>

        <div class="w3-center">
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