<?php
require_once('conexaoBD.php');

$data_recebimento = $_POST['data_recebimento'];
$recebido_por = $_POST['recebido_por'];
$tipo = $_POST['tipo'];
$apartamento = $_POST['apartamento'];
$bloco = $_POST['bloco'];
$destinatario = $_POST['destinatario'];
$remetente = $_POST['remetente'];
$status = $_POST['status'];
$num_registro = $_POST['num_registro'];
$retirado_por = $_POST['retirado_por'];
$data_retirada = $_POST['data_retirada'];

// Obtendo id_propriedade
$id_propriedade = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = $apartamento AND bloco_quadra = '$bloco'";
$result = $conexao->query($id_propriedade);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_propriedade = $row['id_propriedade'];

    // Inserir entrega
    $sql = "INSERT INTO entrega (tipo, data_recebimento, data_retirada, nome_destinatario, status, id_residencia, remetente, retirado_por, recebido_por, num_registro) VALUES ('$tipo','$data_recebimento','$data_retirada','$destinatario','$status',$id_propriedade,'$remetente','$retirado_por','$recebido_por','$num_registro');";

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