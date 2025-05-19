<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

$id = intval($_GET['id']);
$produto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id"));
$categorias = mysqli_query($conn, "SELECT * FROM categorias");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = floatval($_POST['preco']);
    $categoria_id = intval($_POST['categoria_id']);

    mysqli_query($conn, "UPDATE produtos SET nome='$nome', preco=$preco, categoria_id=$categoria_id WHERE id=$id");
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
<h2>Editar Produto</h2>

<form method="POST">
    <div class="mb-3">
    Nome: <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>
    </div>
    <div class="mb-3">
    Preço: <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br>
    </div>
    <div class="mb-3">
    Categoria:
    <select name="categoria_id" required>
        <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $c['id'] ?>" <?= ($c['id'] == $produto['categoria_id']) ? 'selected' : '' ?>>
                <?= $c['nome'] ?>
            </option>
        <?php } ?>
    </select><br>
    </div>
    <div class="mb-3">
    <button type="submit" class="btn btn-success btn-sm">Atualizar</button>
    </div>
</form>
<a class="btn btn-primary btn-sm" href="index.php">Voltar</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>