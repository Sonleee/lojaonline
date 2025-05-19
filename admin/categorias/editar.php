<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

$id = intval($_GET['id']);
$consulta = mysqli_query($conn, "SELECT * FROM categorias WHERE id = $id");
$categoria = mysqli_fetch_assoc($consulta);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    mysqli_query($conn, "UPDATE categorias SET nome = '$nome' WHERE id = $id");
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    

<h2>Editar Categoria</h2>
<form method="POST">
    <div class="mb-3">
    Nome: <input type="text" name="nome" value="<?= $categoria['nome'] ?>" required><br>
    </div>
    <div class="mb-3">
    <button type="submit" class="btn btn-success btn-sm">Atualizar</button>
    </div>
</form>
<a class="btn btn-primary btn-sm" href="index.php">Voltar</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
