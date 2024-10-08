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

    $email = $_POST['login'];
    $token = bin2hex(random_bytes(3));
    $expirar_token = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $verifica_email = $conexao->query("SELECT usuario.*, morador.* FROM usuario JOIN morador ON usuario.id_user = morador.id_usuario WHERE usuario.login = '$email'");

    if ($verifica_email->num_rows > 0) {
        $row = $verifica_email->fetch_assoc();
        $telefone = $row['telefone'];
        $nome_usuario = $row['nome'];

        $stmt = $conexao->prepare("UPDATE usuario SET token = ?, expirar_token = ? WHERE login = ?");
        $stmt->bind_param("sss", $token, $expirar_token, $email);

        if ($stmt->execute()) {

            // Adiciona o código de país ao telefone
            $telefone = "+55" . ltrim($telefone, '0'); // Remove o zero à esquerda, se houver

            // Parâmetros de envio da mensagem UltraMsg
            $params = array(
                'token' => 'ptp03f45bypg9v80',
                'to' => $telefone,
                'body' => "Olá $nome_usuario! Seu Código para redefinir senha é: $token"
            );

            // Configurando e executando o curl para cada número
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance96194/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo '<div class="w3-container w3-card-4 w3-round-xxlarge w3-display-middle w3-quarter w3-padding w3-black" style="opacity: 0.7;">
                <h2 class="w3-center">Conpac</h2><br>
                <form id="esqueceu_senha" action="verificar_token.php" method="post">
                    <div class="w3-container">
                        <h5 class="w3-center">Você receberá um código no seu WhatsApp</h5><br>
                        <label><b>Código:</b></label>
                        <input class="w3-input w3-round-xlarge" id="token" name="token" required>
                        <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                        <br>
                        <button class="w3-button w3-block w3-round-xlarge" type="submit" style="background-color: midnightblue;">Enviar</button>
                    </div><br>
                </form>
            </div>';
            }
        } else {
            echo '<h2 class="w3-panel w3-pale-red w3-center">Erro ao processar solicitação. Tente novamente!</h2>';
        }
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">E-mail não cadastrado. Tente novamente!</h2>';
    }

    $stmt->close();
    $conexao->close();
    ?>
</body>

</html>