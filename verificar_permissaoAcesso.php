<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header('Location: login.html');
    exit();
}

// Verificação de permissão
function verificar_permissao($privilegio)
{
    if ($_SESSION['privilegio'] != $privilegio) {
        header('Location: acessonegado.php');
        exit();
    }
}
