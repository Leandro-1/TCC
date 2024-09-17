<?php
session_start();
require_once('conexaoBD.php');
require_once 'functions.php';

$data_recebimento = $_POST['data_recebimento'];
$recebido_por = $_POST['recebido_por'];
$tipo = $_POST['tipo'];
$propriedade = $_POST['propriedade'];
$destinatario = $_POST['destinatario'];
$remetente = $_POST['remetente'];
$status = $_POST['status'];
$num_registro = $_POST['num_registro'];
$retirado_por = $_POST['retirado_por'];
$data_retirada = isset($_POST['data_retirada']) ? $_POST['data_retirada'] : NULL;



$query = "SELECT id_propriedade FROM propriedade WHERE id_propriedade = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $propriedade);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $id_propriedade = $row['id_propriedade'];

  // Inserindo entrega
  $sql = "INSERT INTO entrega (tipo, data_recebimento, data_retirada, nome_destinatario, status, id_residencia, remetente, retirado_por, recebido_por, num_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("sssssisiss", $tipo, $data_recebimento, $data_retirada, $destinatario, $status, $id_propriedade, $remetente, $retirado_por, $recebido_por, $num_registro);

  if ($stmt->execute()) {
    $_SESSION['mensagem_feedback'] = ['mensagem'=>'Cadastro realizado com sucesso!','type'=> 'success'];
   
  } else {
    $_SESSION['mensagem_feedback'] = ['mensagem' => 'Erro ao cadastrar. Tente novamente.', 'type'=>'error'];
  
  }
} else {
  echo '<a href="inicial_adm.php">
            <h1 class="w3-button w3-black w3-center">Propriedade não encontrada!</h1>
          </a>';
}

$stmt->close();
$conexao->close();
header('Location: inicial_adm.php#cad_entrega');
exit;
?>
