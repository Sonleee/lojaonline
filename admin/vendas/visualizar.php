<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../../includes/conexao.php';

$venda_id = intval($_GET['id']);

// Buscar informações da venda
$venda = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vendas WHERE id = $venda_id"));

if (!$venda) {
    echo "Venda não encontrada.";
    exit;
}

// Buscar itens da venda
$itens = mysqli_query($conn, "
    SELECT vi.*, p.nome, p.preco 
    FROM vendas_itens vi
    LEFT JOIN produtos p ON vi.produto_id = p.id
    WHERE vi.venda_id = $venda_id
");
?>

<h2>Detalhes da Venda #<?= $venda['id'] ?></h2>
<p>Data da Venda: <?= date('d/m/Y H:i', strtotime($venda['data_venda'])) ?></p>

<table border="1">
    <tr><th>Produto</th><th>Qtd</th><th>Preço Unitário</th><th>Total</th></tr>
    <?php 
    $total_geral = 0;
    while ($item = mysqli_fetch_assoc($itens)) {
        $subtotal = $item['preco'] * $item['quantidade'];
        $total_geral += $subtotal;
    ?>
        <tr>
            <td><?= $item['nome'] ?></td>
            <td><?= $item['quantidade'] ?></td>
            <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3"><strong>Total Geral:</strong></td>
        <td><strong>R$ <?= number_format($total_geral, 2, ',', '.') ?></strong></td>
    </tr>
</table>

<a href="index.php">Voltar</a>
