<?php
require_once('permissaoAcesso_adm_e_operador.php');
require_once 'conexaoBD.php';
?>

<?php
$id_entrega = $_POST['id_entrega'];
$status = $_POST['status'];
$retirado_por = $_POST['retirado_por'];
$data_retirada = $_POST['data_retirada'];

if (empty($data_recebimento)) {
    $data_retirada= date('Y-m-d H:i:s');
}

// Proteção contra SQL Injection
$id_entrega = mysqli_real_escape_string($conexao, $id_entrega);
$status = mysqli_real_escape_string($conexao, $status);
$retirado_por = mysqli_real_escape_string($conexao, $retirado_por);
$data_retirada = mysqli_real_escape_string($conexao, $data_retirada);


$sql = "UPDATE entrega 
        SET  status = 'entregue', data_retirada = '$data_retirada', retirado_por = '$retirado_por' 
        WHERE id_entrega = $id_entrega";

// Executar a query e verificar o resultado
if ($conexao->query($sql) === TRUE) {
    echo '<h2 class="w3-panel w3-pale-green w3-center">Entrega Retirada!</h2>';
} else {
    echo '<h2 class="w3-panel w3-pale-red w3-center">Erro... Tente Novamente!</h2>';
}


// Fechar a conexão com o banco de dados
$conexao->close();
?>
