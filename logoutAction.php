<!-- criar a pagina de "verificarAcesso.php"
<?php require_once('verificarAcesso.php'); ?> 
<?php
unset($_SESSION['logado']);
header("location:index.php");
?>
