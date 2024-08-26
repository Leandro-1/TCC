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
$id_propriedade = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = $apartamento AND bloco_quadra = '$bloco';";


    // Inserindo dados na tabela entrega
    $sql = "INSERT INTO entrega (tipo, data_recebimento, data_retirada, nome_morador, status, id_residencia, remetente, retirado_por, recebido_por, num_registro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sssssissss', $tipo, $data_recebimento, $data_retirada, $destinatario, $status, $id_propriedade, $remetente, $retirado_por, $recebido_por, $num_registro);

    if ($stmt->execute()) {
        echo '<a href="inicial_adm.php"><h1 class="w3-button w3-green w3-center">Realizado com Sucesso! </h1></a>';
    } else {
        echo '<a href="inicial_adm.php"><h1 class="w3-button w3-red w3-center">ERRO... Tente novamente!</h1></a>';
    }
 
$stmt->close();
$conexao->close();


?>