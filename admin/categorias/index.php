<?php
session_start(); // Certifique-se de iniciar a sessão
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

include '../includes/conexao.php';
include '../includes/autenticacao.php';

// Consulta para obter categorias
$categorias = mysqli_query($conn, "SELECT * FROM categorias");

// Verifica se a consulta foi bem-sucedida
if (!$categorias) {
    die("Erro na consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link rel="stylesheet" href="../assets/stylec.css"> <!-- Inclua seu CSS aqui -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

<h2>Categorias</h2>
<div class="mb-3">
    <a class="btn btn-primary btn-sm" href="criar.php">Nova Categoria</a>
</div>
<table class="table table-striped-columns">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php while ($cat = mysqli_fetch_assoc($categorias)) { ?>
        <tr>
            <td><?= htmlspecialchars($cat['id']) ?></td>
            <td><?= htmlspecialchars($cat['nome']) ?></td>
            <td>
                <a class="btn btn-warning btn-sm" href="editar.php?id=<?= $cat['id'] ?>">Editar</a>
                <a class="btn btn-danger btn-sm" href="excluir.php?id=<?= $cat['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
<a class="btn btn-primary btn-sm" href="../dashboard.php">Voltar</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>

