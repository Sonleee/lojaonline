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

    // Processa a imagem como BLOB
    $imagem_blob = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem_blob = file_get_contents($_FILES['imagem']['tmp_name']);
        $imagem_blob = mysqli_real_escape_string($conn, $imagem_blob);
    }

    $insert_query = "INSERT INTO produtos (nome, preco, categoria_id, imagem) VALUES ('$nome', $preco, $categoria_id, '$imagem_blob')";

    if (mysqli_query($conn, $insert_query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao adicionar produto: " . mysqli_error($conn);
    }
}

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
    
<h2>Novo Produto</h2>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
    Nome: <input type="text" name="nome" required><br>
    </div>
    <div class="mb-3">
    Preço: <input type="number" step="0.01" name="preco" required><br>
    </div>
    <div class="mb-3">
    Imagem: <input type="file" name="imagem" accept="image/*"required><br>
    </div>
    <div class="mb-3">
    Categoria: 
    <select name="categoria_id" required>
        <option value="">Selecione</option>
        
        <?php while ($c = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
        <?php } ?>
    </select><br>
    </div>
    <div class="mb-3">
    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
    </div>
</form>
<a class="btn btn-primary btn-sm" href="index.php">Voltar</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>