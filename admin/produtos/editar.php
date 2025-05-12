<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../../includes/conexao.php';

$id = intval($_GET['id']);
$produto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id"));
$categorias = mysqli_query($conn, "SELECT * FROM categorias");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = floatval($_POST['preco']);
    $categoria_id = intval($_POST['categoria_id']);

    mysqli_query($conn, "UPDATE produtos SET nome='$nome', preco=$preco, categoria_id=$categoria_id WHERE id=$id");
    header('Location: index.php');
    exit;
}
?>

<h2>Editar Produto</h2>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>
    Preço: <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br>
    Categoria:
    <select name="categoria_id" required>
        <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $c['id'] ?>" <?= ($c['id'] == $produto['categoria_id']) ? 'selected' : '' ?>>
                <?= $c['nome'] ?>
            </option>
        <?php } ?>
    </select><br>
    <button type="submit">Atualizar</button>
</form>
<a href="index.php">Voltar</a>
