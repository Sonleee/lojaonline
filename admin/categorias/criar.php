<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    mysqli_query($conn, "INSERT INTO categorias (nome) VALUES ('$nome')");
    header('Location: index.php');
    exit;
}
?>

<h2>Nova Categoria</h2>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php">Voltar</a>
