<?php
session_start();
include '../includes/conexao.php';

$cart_count = 0;
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
    // If each cart item has 'quantity' field, sum it; otherwise count number of items
    foreach ($_SESSION['carrinho'] as $id) {
        if (isset($id['quantidade'])) {
            $cart_count += $id['quantidade'];
        } else {
            $cart_count++;
        }
    }
}


$categorias = mysqli_query($conn, "SELECT * FROM categorias");
$produtos = mysqli_query($conn, "SELECT * FROM produtos LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <?php while ($categoria = mysqli_fetch_assoc($categorias)) { ?>
          <li class="nav-item">
            <a class="nav-link" href="categoria.php?id=<?= $categoria['id'] ?>">
              <?= htmlspecialchars($categoria['nome']) ?>
            </a>
          </li>
        <?php } ?>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item position-relative">
          <a class="nav-link d-flex align-items-center" href="carrinho.php" style="position: relative;">
            <!-- Bootstrap cart icon SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart" viewBox="0 0 16 16" >
              <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 6H14.5a.5.5 0 0 1 
                       .49.598l-1.5 7A.5.5 0 0 1 13 14H4a.5.5 0 0 1-.491-.408L1.01 2H.5a.5.5 
                       0 0 1-.5-.5zM3.14 7l1.25 5h7.22l1.25-5H3.14z"/>
              <path d="M5.5 15a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm7 0a1.5 1.5 0 
                       1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
            </svg>
            <?php if ($cart_count > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                style="font-size: 0.75rem;">
                <?= $cart_count ?>
                <span class="visually-hidden">itens no carrinho</span>
            </span>
            <?php endif; ?>
            <span class="ms-2">Ver Carrinho</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h2>Bem-vindo à nossa Loja!</h2>
<section class="container my-4">
    <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/Loja-Virtual/assets/img/Banner3.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/Loja-Virtual/assets/img/Banner2.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/Loja-Virtual/assets/img/Banner1.webp" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</section>
<section class="container my-4">
    <h3>Produtos em Destaque</h3>
    <div class="row">
        <?php while ($p = mysqli_fetch_assoc($produtos)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <?php if (!empty($p['imagem'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($p['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>">
                    <?php else: ?>
                        <img src="sem-imagem.jpg" class="card-img-top" alt="Sem imagem">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                        <p class="card-text">Preço: R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

                        <a href="produto.php?id=<?= $p['id'] ?>" class="btn btn-outline-primary mb-2">Ver Produto</a>

                        <form method="POST" action="carrinho.php">
                            <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="quantidade" value="1">
                            <button type="submit" class="btn btn-success w-100">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>


<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>