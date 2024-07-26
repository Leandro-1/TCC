<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<div class="formulario w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
    require_once 'conexaoBD.php';
    
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id_propriedade = $_POST['propriedade'];

    $stmt = $conexao->prepare("UPDATE morador SET nome = ?, telefone = ?, email = ?, id_propriedade = ? WHERE cpf = ?");
    $stmt->bind_param("sssis", $nome, $tel, $email, $id_propriedade, $cpf);

    if ($stmt->execute()) {
        echo '<a href="consultar_morador.php">
                <h1 class="w3-button w3-black w3-center">Morador Atualizado com Sucesso! </h1>
              </a>';
    } else {
        echo '<a href="consultar_morador.php">
                <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente! </h1>
              </a>';
    }

    $stmt->close();
    $conexao->close();
    ?>
</div>
<?php require_once("rodape.php"); ?>
