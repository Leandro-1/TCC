<?php
require_once('cabecalho.php');
session_start();
?>


<div class="w3-container w3-display-middle w3-card-4 w3-padding w3-round-xlarge">
    <h1>Alterar Senha</h1>
    <form id="myForm_alterar_senha" action="alterar_senhaAction.php" method="post">
        
        <label>Login:</label><br>
        <input type="text" id="login_antigo" required><br>

        <label>Senha Atual:</label><br>
        <input type="text" id="senha_antiga" required><br>

        <label>Nova Senha:</label><br>
        <input type="text" id="senha_nova" required><br>
        <label>Confirmar Senha:</label><br>
        <input type="text" id="confirma_senha" required><br>

        <button class="w3-button">Confirmar</button>

    </form>

</div>

<?php
require_once('rodape.php');
?>