<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once 'conexaoBD.php';
?>

<div class="w3-display-middle">
    <?php
    $id_entrega = $_POST['id_entrega'];  // Receber o ID da entrega
    $data_recebimento = $_POST['data_recebimento'];
    $tipo = $_POST['tipo'];
    $propriedade = $_POST['propriedade'];  // Já contém o id_propriedade
    $destinatario = $_POST['destinatario']; 
    $remetente = $_POST['remetente'];
    $status = $_POST['status'];
    $num_registro = $_POST['num_registro'];
    $retirado_por = $_POST['retirado_por'];
    $data_retirada = !empty($_POST['data_retirada']) ? $_POST['data_retirada'] : NULL;

    // Proteção contra SQL Injection
    $data_recebimento = mysqli_real_escape_string($conexao, $data_recebimento);
    $id_entrega = mysqli_real_escape_string($conexao, $id_entrega);
    $tipo = mysqli_real_escape_string($conexao, $tipo);
    $destinatario = mysqli_real_escape_string($conexao, $destinatario);
    $propriedade = mysqli_real_escape_string($conexao, $propriedade);  // id_propriedade diretamente
    $status = mysqli_real_escape_string($conexao, $status);
    $remetente = mysqli_real_escape_string($conexao, $remetente);
    $num_registro = mysqli_real_escape_string($conexao, $num_registro);

    // Atualizar entrega
    $sql = "UPDATE entrega 
            SET tipo = '$tipo', data_recebimento = '$data_recebimento', nome_destinatario = '$destinatario', 
                status = '$status', id_residencia = $propriedade, remetente = '$remetente', num_registro = '$num_registro' 
            WHERE id_entrega = $id_entrega";
 
    if ($conexao->query($sql) === TRUE) {
        echo '<a href="inicial_adm.php">
            <h1 class="w3-button w3-black w3-center">Entrega Atualizada com Sucesso!</h1>
          </a>';
    } else {
        echo '<a href="inicial_adm.php">
            <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente!</h1>
          </a>';
    }

    $conexao->close();
    ?>
</div>

<?php require_once("rodape.php"); ?>
