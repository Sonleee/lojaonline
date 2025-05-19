<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';
include '../includes/autenticacao.php';

$vendas = mysqli_query($conn, "SELECT * FROM vendas ORDER BY data_venda DESC");
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
    

<h2>Vendas Realizadas</h2>
<table class="table table-striped-columns">
    <tr><th>ID</th><th>Data</th><th>Ações</th></tr>
    <?php while ($v = mysqli_fetch_assoc($vendas)) { ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($v['data_venda'])) ?></td>
            <td><a class="btn btn-warning btn-sm" href="visualizar.php?id=<?= $v['id'] ?>">Visualizar</a></td>
        </tr>
    <?php } ?>
</table>

<a class="btn btn-primary btn-sm" href="../dashboard.php">Voltar</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>