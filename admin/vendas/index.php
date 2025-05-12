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

<h2>Vendas Realizadas</h2>
<table border="1">
    <tr><th>ID</th><th>Data</th><th>Ações</th></tr>
    <?php while ($v = mysqli_fetch_assoc($vendas)) { ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($v['data_venda'])) ?></td>
            <td><a href="visualizar.php?id=<?= $v['id'] ?>">Visualizar</a></td>
        </tr>
    <?php } ?>
</table>
