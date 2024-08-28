<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>


<div class="w3-display-middle">
    <?php
$id_entrega = $_POST['id_entrega'];
$data_recebimento = $_POST['data_recebimento'];
$tipo = $_POST['tipo'];
$destinatario = $_POST['destinatario'];
$apartamento = $_POST['apartamento'];
$bloco = $_POST['bloco'];
$status = $_POST['status'];
$remetente = $_POST['remetente'];
$num_registro = $_POST['num_registro'];


    // Proteção contra SQL Injection
    $data_recebimento = mysqli_real_escape_string($conexao, $data_recebimento);
    $id_entrega = mysqli_real_escape_string($conexao, $id_entrega);
    $tipo = mysqli_real_escape_string($conexao, $tipo);
    $destinatario = mysqli_real_escape_string($conexao, $destinatario);
    $apartamento = mysqli_real_escape_string($conexao, $apartamento);
    $bloco = mysqli_real_escape_string($conexao, $bloco);
$status = mysqli_real_escape_string($conexao, $status);
$remetente = mysqli_real_escape_string($conexao, $remetente);
$num_registro = mysqli_real_escape_string($conexao, $num_registro);
    
// Obter o id_propriedade
    $id_propriedade_sql = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = $apartamento AND bloco_quadra = '$bloco'";
    $result = $conexao->query($id_propriedade_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_propriedade = $row['id_propriedade'];

        // Atualizar entrega
        $sql = "UPDATE entrega SET tipo = '$tipo', data_rebebimento = '$data_recebimento', nome_destinatario = '$destinatario', status = '$status', id_residencia = $id_propriedade, remetente = '$remetente', num_registro = '$num_registro' WHERE id_entrega = $id_entrega";
 
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
