<?php
$host = '127.0.0.1';
$user = 'root';
$senha = '';
$banco = 'lojaonline'; // Nome do seu banco de dados

$conn = mysqli_connect($host, $user, $senha, $banco);

if (!$conn) {
    die('Erro ao conectar com o banco de dados: ' . mysqli_connect_error());
}
?>
