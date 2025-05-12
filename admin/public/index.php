<?php
session_start();
include '../includes/conexao.php';

$categorias = mysqli_query($conn, "SELECT * FROM categorias");
$produtos = mysqli_query($conn, "SELECT * FROM produtos LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="/assets/style.css">

</head>
<body>
<h2>Bem-vindo à nossa Loja!</h2>
<section>
    <h3>Categorias</h3>
    <ul class="categorias">
        <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <li>
                <a href="categoria.php?id=<?= $c['id'] ?>" class="categoria-link"><?= $c['nome'] ?></a>
            </li>
        <?php } ?>
    </ul>
</section>
<section>
    <h3>Produtos em Destaque</h3>
    <ul class="produtos">
        <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
            <li class="produto-item">
                <a href="produto.php?id=<?= $p['id'] ?>" class="produto-link"><?= $p['nome'] ?></a> - 
                <span class="produto-preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                <form method="POST" action="carrinho.php" class="comprar-form" style="display:inline;">
                    <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                    <input type="hidden" name="quantidade" value="1">
                    <button type="submit" class="comprar-button">Comprar</button>
                </form>
            </li>
        <?php } ?>
    </ul>
</section>
<nav>
    <a href="carrinho.php" class="carrinho-link">Ver Carrinho</a>
</nav>
</body>
</html>