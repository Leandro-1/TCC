<?php
session_start();
if (!isset($_SESSION['id_user'])) {
header('Location: login.php');
exit;
}
if($_SESSION['privilegio'] !== 'administrador' && $_SESSION['privilegio'] !== 'operador' ){
header('Location: acessonegado.php');
exit;
}
?>