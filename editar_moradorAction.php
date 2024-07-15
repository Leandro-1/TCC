<?php require_once("verificaacesso_admin.php") ?>
<?php require_once("cabecalho.php"); ?>


<div class="formulario w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
    require_once 'conexaoBD.php';
$cpf = $_POST['txtCpf'];
$tel = $_POST['txtTel'];
$nome = $_POST['txtNome'];
$email = $_POST['txtEmail'];
$num_ap = $_POST['txtApart'];
$bloco = $_POST['txtBloco'];

$sql = "SELECT id_propriedade FROM propriedade WHERE num_propriedade = '$num_ap' AND bloco_quadra = '$bloco'";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $id_propriedade = $row["id_propriedade"];

    $sql_up = "UPDATE morador SET nome = '$nome', telefone = '$tel', email = '$email', id_propriedade = '$id_propriedade' WHERE cpf = '$cpf'";


    if ($conexao->query($sql_up) === TRUE) {
        echo '<a href="consultar_morador.php">
                    <h1 class="w3-button w3-black w3-center">Morador Atualizado com Sucesso!</h1>
                </a>';
        $id = mysqli_insert_id($conexao);
    } else {
        echo '<a href="consultar_morador.php">
                    <h1 class="w3-button w3-black w3-center">ERRO... Tente Novamente!</h1>
                </a>';
    }
} else {
        echo '<a href="consultar_morador.php">
                    <h1 class="w3-button w3-black w3-center">Propriedade não encontrada!</h1>
                </a>';
}
    $conexao->close();
    ?>
</div>
<?php require_once("rodape.php"); ?>