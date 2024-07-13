<?php
// BD para testes PC Leandro
/*
$servername = "localhost";
$username = "root";
$password = "conpac@1";
$dbname = "conpac";
$conexao = new mysqli($servername, $username, $password, $dbname);
if ($conexao->connect_error) {
die("Connection failed: " . $conexao->connect_error);
*/

 //BD temporario teste Jéssie
 $servername = "localhost:3307";
 $username = "root";
$password = "usbw";
$dbname = "conpac";
$conexao = new mysqli($servername, $username, $password, $dbname);
if ($conexao->connect_error) {
    die("Erro de Conexão: " . $conexao->connect_error);
}
?>