<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: ../login.php');
    exit;
}
include '../includes/conexao.php';

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM categorias WHERE id = $id");

header('Location: index.php');
exit;
