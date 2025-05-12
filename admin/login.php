<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario == 'admin' && $senha == '1234') {
        $_SESSION['logado'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Administração</title>
    <link rel="stylesheet" href="/assets/css/estilo.css">
</head>
<body>

<div class="container">
    <h2>Login do Administrador</h2>

    <?php if (isset($_GET['erro'])) { ?>
        <div class="alert">Usuário ou senha inválidos.</div>
    <?php } ?>

    <form action="login.php" method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
