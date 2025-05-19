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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

<h2>Categoria: <?= $categoria['nome'] ?></h2>
<section class="container my-4">
    <div class="row">
        <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <?php if (!empty($p['imagem'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($p['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>">
                    <?php else: ?>
                        <img src="sem-imagem.jpg" class="card-img-top" alt="Sem imagem">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                        <p class="card-text">Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

                        <a href="produto.php?id=<?= $p['id'] ?>" class="btn btn-outline-primary mb-2">Ver Produto</a>

                        <form method="POST" action="carrinho.php">
                            <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="quantidade" value="1">
                            <button type="submit" class="btn btn-success w-100">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>



<a href="index.php">Voltar</a> | <a href="carrinho.php">Ver Carrinho</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>