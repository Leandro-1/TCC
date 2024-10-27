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
    <div class="w3-container w3-card-4 w3-round-xxlarge w3-display-middle w3-quarter w3-padding w3-black" style="opacity: 0.7;">

        <h2 class="w3-center">Conpac</h2><br>
        <form id="esqueceu_senha" action="esqueceu_senhaAction.php" method="post">
            <div class="w3-container">
               
                <label ><b>Email:</b></label>
                <input class="w3-input w3-round-xlarge" type="email" name="login" required>
                <br>

                <button class="w3-button w3-block w3-round-xlarge" type="submit" style="background-color: midnightblue;">Enviar</button>

            </div><br>
        </form>

    </div>
</body>

</html>