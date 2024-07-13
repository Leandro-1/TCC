<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--<link rel="stylesheet" href="reset.css">-->
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imagens_logo/logo.png">
    <title>CONPAC</title>
</head>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        width: 100%;
        color: white;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover:not(.active) {
        background-color: #111;
    }

    .active {
        background-color: #000000;
    }
</style>

<body>
    <div class="cabecalho" style="position: fixed; width: 100%; margin-top:0;">
        <header class=" w3-center w3-padding-16 w3-text-white" style="background-color: rgb(24, 23, 23);">
            <h1 class="w3-xxlarge"><img src="imagens_logo/logo.png" width="5%">
                CONPAC</h1>
        </header>

        <ul>
            <li class="w3-padding">Bem-vindo, <?php echo $_SESSION['nome']; ?></li>
            <!--Criar pagina de alterar senha-->
            <li class="w3-red" style="float: right;"><a href="logoutAction.php"><i class="fas fa-sign-out"></i> Sair</a></li>
            <li style="float: right;"><a href="">Alterar Senha</a></li>

        </ul>
    </div>