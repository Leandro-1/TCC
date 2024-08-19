<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Conpac</title>
</head>


<body style="background-color:  #E8E8E8;">

    <nav class="w3-bar w3-mobile w3-top w3-center " style="height: 50px;">
        <img src="imagens_logo/logo_semFundo.png" alt="" class="w3-bar-item w3-left item_nav" style="width: 5%;">
        <span class="w3-left item_nav">
            <h4>Conpac</h4>
        </span>
        <a href="logoutAction.php" class="item_nav w3-bar-item w3-button w3-right w3-hover-red">Sair</a>
        <a href="#" class="item_nav w3-bar-item w3-button w3-right">Alterar Senha</a>
        <span class=" item_nav w3-bar-item w3-right">Olá, <?php echo ucwords($_SESSION['nome']) ?></span>
    </nav>