<?php
session_start();
include 'includes/conexao.php';

$id = intval($_GET['id']);
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id"));
?>

<h2><?= $p['nome'] ?></h2>
<p>Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

<form method="POST" action="carrinho.php">
    Quantidade: <input type="number" name="quantidade" value="1" min="1" required>
    <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
    <button type="submit">Adicionar ao Carrinho</button>
</form>

<a href="index.php">Voltar</a> | <a href="carrinho.php">Ver Carrinho</a>
