<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

$id = intval($_GET['id']);
$consulta = mysqli_query($conn, "SELECT * FROM categorias WHERE id = $id");
$categoria = mysqli_fetch_assoc($consulta);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    mysqli_query($conn, "UPDATE categorias SET nome = '$nome' WHERE id = $id");
    header('Location: index.php');
    exit;
}
?>

<h2>Editar Categoria</h2>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $categoria['nome'] ?>" required><br>
    <button type="submit">Atualizar</button>
</form>
<a href="index.php">Voltar</a>
