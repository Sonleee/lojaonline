<?php
session_start();
include '../includes/conexao.php';

if (empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}

mysqli_query($conn, "INSERT INTO vendas (data_venda) VALUES (NOW())");
$venda_id = mysqli_insert_id($conn);

foreach ($_SESSION['carrinho'] as $produto_id => $qtd) {
    mysqli_query($conn, "INSERT INTO vendas_itens (venda_id, produto_id, quantidade) VALUES ($venda_id, $produto_id, $qtd)");
}

// Limpa o carrinho
unset($_SESSION['carrinho']);

header("Location: obrigado.php?venda=$venda_id");
exit;
