<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once("cabecalho.php"); ?>
<title>Exclusão</title>
</head>
<body>
<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
<?php
require_once 'conexaoBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_user'])) {
    $id_user = intval($_POST['id_user']);
    
    $sql = $conexao->prepare("DELETE FROM usuario WHERE id_user = ?");
    if ($sql) {
        $sql->bind_param("i", $id_user);
        $sql->execute();
        
        if ($sql->affected_rows > 0) {
            echo '
            <a href="consultar_usuario.php">
            <h1 class="w3-button w3-red">Usuário Excluído com sucesso! </h1>
            </a>
            ';
        } else {
            echo '
            <a href="consultar_usuario.php">
            <h1 class="w3-button w3-red">ERRO! Usuário não encontrado. </h1>
            </a>
            ';
        }
        $sql->close();
    } else {
        echo '
        <a href="consultar_usuario.php">
        <h1 class="w3-button w3-red">ERRO! </h1>
        </a>
        ';
    }
    $conexao->close();
} else {
    echo '
    <a href="consultar_usuario.php">
    <h1 class="w3-button w3-red">ERRO! Requisição inválida. </h1>
    </a>
    ';
}
?>
</div>
<?php require_once("rodape.php"); ?>
</body>
</html>
