<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exemplo de Interface Responsiva com Bootstrap 5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="src/img/logo.png" alt="Logo" width="100" height="100">
                    Whey Market
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form class="d-flex" action="produtos.php" method="POST">
                                <input class="form-control me-2" type="text" name="busca" placeholder="Pesquisar...">
                                <button class="btn btn-primary" type="submit">
                                    <i class='bx bx-search'></i>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produtos.php">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="carrinho.php">Carrinho</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lojistaLogin.php">Área do Lojista</a>
                        </li>
                        <?php if (!empty($_SESSION) && isset($_SESSION['Nome'])) : ?>
                            <li class="nav-item">
                                <span class="nav-link text-danger">Olá, <?php echo $_SESSION['Nome'] ?></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Sair</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="consumidorLogin.php">Login/Cadastro</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
