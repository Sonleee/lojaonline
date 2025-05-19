<?php
session_start();
include '../../admin/includes/conexao.php';

// Adicionar produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['produto_id']);
    $qtd = intval($_POST['quantidade']);
    if ($qtd > 0) {
        $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + $qtd;
    }
    header('Location: carrinho.php');
    exit;
}

// Remover item
if (isset($_GET['remover'])) {
    $id = intval($_GET['remover']);
    unset($_SESSION['carrinho'][$id]);
    header('Location: carrinho.php');
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
    

<h2>Seu Carrinho</h2>

<?php
$total = 0;
if (empty($_SESSION['carrinho'])) {
    echo "<p>O carrinho está vazio.</p>";
} else {
    echo "<ul>";
    foreach ($_SESSION['carrinho'] as $id => $qtd) {
        $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id"));
        $subtotal = $p['preco'] * $qtd;
        $total += $subtotal;
        echo "<li>{$p['nome']} - {$qtd} x R$ " . number_format($p['preco'], 2, ',', '.') . 
             " = R$ " . number_format($subtotal, 2, ',', '.') . 
             " <a href='?remover=$id' onclick='return confirm(\"Remover?\")'>[Remover]</a></li>";
    }
    echo "</ul>";
    echo "<p><strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
    echo "<a href='finalizar.php'>Finalizar Compra</a>";
}
?>

<a href="index.php">Continuar Comprando</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>