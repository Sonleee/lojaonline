<?php
session_start(); // Inicia a sessão
include 'includes/autenticacao.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

    <div class="top-bar">
        <strong>Administração - Loja Virtual</strong> |
        <a href="dashboard.php">Dashboard</a>
        <a href="categorias/index.php">Categorias</a>
        <a href="produtos/index.php">Produtos</a>
        <a href="vendas/index.php">Vendas</a>
        <a href="logout.php">Sair</a>
    </div>

    <div class="container">
        <h1>Bem-vindo ao Painel Administrativo</h1>
        <p>Utilize o menu acima para gerenciar sua loja virtual.</p>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>

