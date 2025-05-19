<?php
session_start();
include '../includes/conexao.php';

// Check if the cart is empty
if (empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}

// Insert a new sale into the vendas table
mysqli_query($conn, "INSERT INTO vendas (data_venda) VALUES (NOW())");
$venda_id = mysqli_insert_id($conn);

// Insert each item in the cart into the vendas_itens table
foreach ($_SESSION['carrinho'] as $produto_id => $qtd) {
    mysqli_query($conn, "INSERT INTO vendas_itens (venda_id, produto_id, quantidade) VALUES ($venda_id, $produto_id, $qtd)");
}

// Clear the cart
unset($_SESSION['carrinho']);

// Redirect to the thank you page
header("Location: obrigado.php?venda=$venda_id");
exit;

