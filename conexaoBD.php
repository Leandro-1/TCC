<?php
$servername = "localhost";
$username = "root";
$password = "conpac@1";
$dbname = "conpac";
$conexao = new mysqli($servername, $username, $password, $dbname);
if ($conexao->connect_error) {
die("Connection failed: " . $conexao->connect_error);
}
?>