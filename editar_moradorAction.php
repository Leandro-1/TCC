<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>


<div class="w3-display-middle">
  <?php
  
  $cpf = $_POST['cpf'];
  $tel = $_POST['tel'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $numero_apart = $_POST['num_apart'];
  $bloco = $_POST['bloco_quadra'];

  // Proteção contra SQL Injection
  $cpf = mysqli_real_escape_string($conexao, $cpf);
  $tel = mysqli_real_escape_string($conexao, $tel);
  $nome = mysqli_real_escape_string($conexao, $nome);
  $email = mysqli_real_escape_string($conexao, $email);
  $numero_apart = mysqli_real_escape_string($conexao, $numero_apart);
  $bloco = mysqli_real_escape_string($conexao, $bloco);

  // Obter o id_propriedade
  $id_propriedade_sql = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = $numero_apart AND bloco_quadra = '$bloco'";
  $result = $conexao->query($id_propriedade_sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_propriedade = $row['id_propriedade'];

    // Atualizar o morador
    $sql = "UPDATE morador SET nome = '$nome', telefone = '$tel', email = '$email', id_propriedade = $id_propriedade WHERE cpf = $cpf";

    if ($conexao->query($sql) === TRUE) {
      echo '<a href="inicial_adm.php">
                <h1 class="w3-button w3-black w3-center">Morador Atualizado com Sucesso!</h1>
              </a>';
    } else {
      echo '<a href="inicial_adm.php">
                <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente!</h1>
              </a>';
    }
  } else {
    echo '<a href="inicial_adm.php">
            <h1 class="w3-button w3-black w3-center">Propriedade não encontrada!</h1>
          </a>';
  }

  $conexao->close();
  ?>
</div>
<?php require_once("rodape.php"); ?>