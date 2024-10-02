<?php


require_once('conexaoBD.php');


$id_residencia = $_POST['id_residencia'];


$sql = "SELECT m.telefone
        FROM morador m
        INNER JOIN entrega e ON m.id_propriedade = e.id_residencia
        WHERE e.id_residencia = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar a consulta: " . $conn->error);
}


$stmt->bind_param("i", $id_residencia);

$stmt->execute();


$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $telefone = $row['telefone'];
} else {
    die("Nenhum telefone encontrado para essa residência.");
}


$stmt->close();
$conn->close();

// Defina os parâmetros de envio da mensagem UltraMsg
$instanceID = 'instance96194';  // Substitua pela sua instance ID do UltraMsg
$token = 'ptp03f45bypg9v80';   // Substitua pelo seu token da UltraMsg
$whatsappUrl = "https://api.ultramsg.com/$instanceID/messages/chat";


$nome = $_POST['destinatario'];


$mensagem = "Olá $nome, chegou uma encomenda na portaria!";


$data = [
    'token' => $token,
    'to' => $telefone, 
    'body' => $mensagem
];


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $whatsappUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
    ),
));

$response = curl_exec($curl);
curl_close($curl);


if ($response) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar mensagem.";
}
?>
