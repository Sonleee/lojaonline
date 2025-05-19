<?php
session_start();
include '../includes/conexao.php';

$id = intval($_GET['id']);
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id"));
/*if (!empty($p['imagem'])) {
    echo '<h4>Imagem carregada com sucesso</h4>';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($p['imagem']) . '" style="max-width:300px;">';
} else {
    echo '<h4>Nenhuma imagem encontrada</h4>';
}
exit;
*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($p['nome']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <?php if (!empty($p['imagem'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($p['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>">
                <?php else: ?>
                    <img src="sem-imagem.jpg" class="card-img-top" alt="Sem imagem">
                <?php endif; ?>

                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($p['nome']) ?></h4>
                    <p class="card-text">Preço: <strong>R$ <?= number_format($p['preco'], 2, ',', '.') ?></strong></p>

                    <form method="POST" action="carrinho.php">
                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade:</label>
                            <input type="number" name="quantidade" id="quantidade" class="form-control" value="1" min="1" required>
                        </div>
                        <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                        <button type="submit" class="btn btn-success w-100">Adicionar ao Carrinho</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="index.php" class="btn btn-outline-secondary me-2">Voltar</a>
                        <a href="carrinho.php" class="btn btn-outline-primary">Ver Carrinho</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
