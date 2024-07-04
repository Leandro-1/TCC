<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['logado']) || $_SESSION['logado'] != true) {
    header('location:acessoNegado.php');
    die();
}

if (!isset($_SESSION['privilegio']) || $_SESSION['privilegio'] != 'administrador') {
    header('location:acessoNegado.php');
    die();
}
?>
