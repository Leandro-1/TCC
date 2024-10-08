<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Recuperar Senha</title>
</head>
<style>
    html {
        height: 100%;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(to top, black, #101031, midnightblue);
        background-repeat: no-repeat;
    }
</style>

<body>

    <?php
    require_once 'conexaoBD.php';

    $email = $_POST['email'];
    $token = $_POST['token'];

    $stmt = $conexao->prepare("SELECT id_user FROM usuario WHERE login = ? AND token = ? AND expirar_token > NOW()");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user);
        $stmt->fetch();

        echo '<div class="w3-container w3-card-4 w3-round-xxlarge w3-display-middle w3-quarter w3-padding w3-black" style="opacity: 0.7;">
            <h2 class="w3-center">Conpac</h2><br>
            <form id="form_novaSenha" action="atualizar_senha_reset.php" method="post">
                <div class="w3-container">
                <input type="hidden" name="id_user" value="' . htmlspecialchars($id_user) . '">
                    <label><b>Nova Senha:</b></label>
                    <input class="w3-input w3-round-xlarge" type="password" id="senhanova" name="senhanova" required><br>
                    <label><b>Confirmar Senha:</b></label>
                    <input class="w3-input w3-round-xlarge" type="password" id="senhanova_confirmar" name="senhanova_confirmar" required>
                    <br>
                    <button class="w3-button w3-block w3-round-xlarge" type="submit" style="background-color: midnightblue;">Redefinir Senha</button>
                </div><br>
                <div class="feedbackMessage w3-padding"></div>
            </form>
            </div>';
        
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Código de verificação inválido ou expirado.</h2>';
    }

    $stmt->close();
    $conexao->close();
    ?>
</body>
</html>