<?php
session_start();
include '../../admin/includes/conexao.php';

$id = intval($_GET['id']);
$categoria = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categorias WHERE id = $id"));
$produtos = mysqli_query($conn, "SELECT * FROM produtos WHERE categoria_id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    
</body>
</html>
<h2>Categoria: <?= $categoria['nome'] ?></h2>

<ul>
    <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
        <li>
            <a href="produto.php?id=<?= $p['id'] ?>"><?= $p['nome'] ?></a> -
            R$ <?= number_format($p['preco'], 2, ',', '.') ?>
            <form method="POST" action="carrinho.php" style="display:inline;">
                <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                <input type="hidden" name="quantidade" value="1">
                <button type="submit">Comprar</button>
            </form>
        </li>
    <?php } ?>
</ul>

<a href="index.php">Voltar</a> | <a href="carrinho.php">Ver Carrinho</a>
