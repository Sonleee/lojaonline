<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';
include '../includes/autenticacao.php';

$produtos = mysqli_query($conn, "
    SELECT produtos.*, categorias.nome AS categoria_nome 
    FROM produtos 
    LEFT JOIN categorias ON produtos.categoria_id = categorias.id
");
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
    

<h2>Produtos</h2>

<a class="btn btn-primary btn-sm"href="criar.php">Novo Produto</a>
<table class="table table-striped-columns">
    <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Categoria</th><th>Ações</th></tr>
    <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nome'] ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= $p['categoria_nome'] ?></td>
            <td>
                <a class="btn btn-warning btn-sm" href="editar.php?id=<?= $p['id'] ?>">Editar</a>
                <a class="btn btn-danger btn-sm"href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
<a class="btn btn-primary btn-sm" href="../dashboard.php">Voltar</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>