<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>
<div class="formulario w3-padding w3-content w3-text-grey w3-third w3-display-middle">
  <?php
  require_once 'conexaoBD.php';
  // dando erro no id cpf de novo
  $cpf = $_POST['cpf'];
  $tel = $_POST['tel'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $numero_apart = $_POST['num_apart'];
  $bloco = $_POST['bloco_quadra'];

  $id_propriedade_stmt = $conexao->prepare("SELECT id_propriedade FROM propriedade WHERE num_propriedade = ? AND bloco_quadra = ?");
  $id_propriedade_stmt->bind_param("ss", $numero_apart, $bloco);
  $id_propriedade_stmt->execute();
  $id_propriedade_result = $id_propriedade_stmt->get_result();
  $id_propriedade_row = $id_propriedade_result->fetch_assoc();
  $id_propriedade_value = $id_propriedade_row['id_propriedade'];

  // Atualização do Morador
  $stmt = $conexao->prepare("UPDATE morador SET nome = ?, telefone = ?, email = ?, id_propriedade = ? WHERE cpf = ?");
  $stmt->bind_param("sssis", $nome, $tel, $email, $id_propriedade_value, $cpf);
  if ($stmt->execute()) {
    echo '<a href="inicial_adm.php">
                <h1 class="w3-button w3-black w3-center">Morador Atualizado com Sucesso! </h1>
              </a>';
  } else {
    echo '<a href="inicial_adm.php">
                <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente! </h1>
              </a>';
  }

  $stmt->close();
  $conexao->close();
  ?>
</div>
<?php require_once("rodape.php"); ?>