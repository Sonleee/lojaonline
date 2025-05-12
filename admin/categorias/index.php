<?php
session_start(); // Certifique-se de iniciar a sessão
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}

include '../includes/conexao.php';
include '../includes/autenticacao.php';

// Consulta para obter categorias
$categorias = mysqli_query($conn, "SELECT * FROM categorias");

// Verifica se a consulta foi bem-sucedida
if (!$categorias) {
    die("Erro na consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
    <link rel="stylesheet" href="../assets/stylec.css"> <!-- Inclua seu CSS aqui -->
</head>
<body>

<h2>Categorias</h2>
<a href="criar.php">Nova Categoria</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php while ($cat = mysqli_fetch_assoc($categorias)) { ?>
        <tr>
            <td><?= htmlspecialchars($cat['id']) ?></td>
            <td><?= htmlspecialchars($cat['nome']) ?></td>
            <td>
                <a href="editar.php?id=<?= $cat['id'] ?>">Editar</a>
                <a href="excluir.php?id=<?= $cat['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>

