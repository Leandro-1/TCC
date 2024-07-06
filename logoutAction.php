
<?php require_once('verificaacesso_todos.php'); ?> 
<?php
unset($_SESSION['logado']);
header("location:login.html");
?>
