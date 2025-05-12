<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';
include '../includes/autenticacao.php';

$produtos = mysqli_query($conn, "
    SELECT produtos.*, categorias.nome AS categoria_nome 
    FROM produtos 
    LEFT JOIN categorias ON produtos.categoria_id = categorias.id
");
?>

<h2>Produtos</h2>
<a href="../dashboard.php">Voltar</a>
<a href="criar.php">Novo Produto</a>
<table border="1">
    <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Categoria</th><th>Ações</th></tr>
    <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nome'] ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= $p['categoria_nome'] ?></td>
            <td>
                <a href="editar.php?id=<?= $p['id'] ?>">Editar</a>
                <a href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
