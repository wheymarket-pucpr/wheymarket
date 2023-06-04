<?php
include('conexao.php');
?>
<?php //include('header.php') ?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg gp-3 mb-5 bg-white rounded">
        <div class="container-fluid">
        <a href=""><img src="src/img/logo.png" alt="Logo" width="100" height="100"></a>
        <a href="" class="fs-2 text"><span class="text-danger">Whey </span>Market</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link .hover-zoom" href="index.php">Home</a>
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