<?php
require_once('permissaoAcesso_adm_e_operador.php');
require_once('conexaoBD.php');

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

if (empty($data_recebimento)) {
    $data_recebimento = date('Y-m-d');
}

$query = "SELECT id_propriedade FROM propriedade WHERE id_propriedade = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $propriedade);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_propriedade = $row['id_propriedade'];

    // Inserindo a entrega
    $sql = "INSERT INTO entrega (tipo, data_recebimento, data_retirada, nome_destinatario, status, id_residencia, remetente, retirado_por, recebido_por, num_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $data_retirada = !empty($_POST['data_retirada']) ? $_POST['data_retirada'] : NULL;
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssisiss", $tipo, $data_recebimento, $data_retirada, $destinatario, $status, $id_propriedade, $remetente, $retirado_por, $recebido_por, $num_registro);

    if ($stmt->execute()) {
        echo '<h2 class="w3-panel w3-pale-green w3-center">Cadastro Realizado com Sucesso!</h2>';

        // Capturar o telefone do morador relacionado à propriedade
        $sql_telefone = "SELECT m.telefone
                         FROM morador m
                         INNER JOIN entrega e ON m.id_propriedade = e.id_residencia
                         WHERE e.id_residencia = ?";
        $stmt_telefone = $conexao->prepare($sql_telefone);
        $stmt_telefone->bind_param("i", $id_propriedade);
        $stmt_telefone->execute();
        $result_telefone = $stmt_telefone->get_result();

        if ($result_telefone->num_rows > 0) {
            $row_telefone = $result_telefone->fetch_assoc();
            $telefone = $row_telefone['telefone'];

            // Adiciona o código de país ao telefone
            $telefone = "+55" . ltrim($telefone, '0'); // Remove o zero à esquerda, se houver

            // Parâmetros de envio da mensagem UltraMsg
            $params = array(
                'token' => 'ptp03f45bypg9v80',
                'to' => $telefone,
                'body' => "Olá $destinatario, chegou uma encomenda na portaria!"
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance96194/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response; // Exibir resposta da API
            }
        } else {
            echo "<h2 class='w3-panel w3-pale-red w3-center'>Nenhum telefone encontrado para essa residência.</h2>";
        }
    } else {
        echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
    }
}

$stmt->close();
$conexao->close();
