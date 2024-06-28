<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Editar Propriedade</title>
</head>
<body>
<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-middle w3-card">
    <h1 class="w3-center w3-black w3-round-large w3-margin">Editar - Código: <?php echo " " . $_GET['id'] ?> </h1>
    <form action="editarAction.php" class="w3-container" method='post'>
        <input name="txtCodigo" class="w3-input w3-grey w3-border" type="hidden" value="<?php echo $_GET['id'] ?>">
        <br>
        <label class="w3-text-black" style="font-weight: bold;">Número</label>
        <input name="txtNumero" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['numero'] ?>">
        <br>
        <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
        <input name="txtBloco" class="w3-input w3-light-grey w3-border" value="<?php echo $_GET['bloco'] ?>">
        <br>
        <button name="btnAtualizar" class="w3-button w3-black w3-cell w3-round-large w3-right">
            <i class="w3-xxlarge fa fa-refresh"></i> Atualizar
        </button>
    </form><br>
</div>
</body>
</html>
