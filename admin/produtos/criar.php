<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

// Lista de categorias
$categorias = mysqli_query($conn, "SELECT * FROM categorias");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $preco = floatval($_POST['preco']);
    $categoria_id = intval($_POST['categoria_id']);

    // Verifica se a categoria existe
    $categoria_check = mysqli_query($conn, "SELECT * FROM categorias WHERE id = $categoria_id");
    if (mysqli_num_rows($categoria_check) == 0) {
        die("Erro: A categoria com ID $categoria_id não existe.");
    }

    // Insere o produto
    $insert_query = "INSERT INTO produtos (nome, preco, categoria_id) VALUES ('$nome', $preco, $categoria_id)";
    if (mysqli_query($conn, $insert_query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao adicionar produto: " . mysqli_error($conn);
    }
}
?>

<h2>Novo Produto</h2>
<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    Categoria: 
    <select name="categoria_id" required>
        <option value="">Selecione</option>
        
        <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
        <?php } ?>
    </select><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php">Voltar</a>
