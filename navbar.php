<?php
include('conexao.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
            integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
            integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
            crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>WheyMarket</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png"
          type="image/x-icon">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg gp-3 mb-5 bg-white rounded">
        <div class="container-fluid">
        <a href=""><img src="src/img/logo.png" alt="Logo" width="100" height="100"></a>
        <a href="" class="fs-2 text"><span class="text-danger">Whey </span>Market</a>
        <?php
            include('mensagemSessao.php')
            ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex" action="produtos.php" method="POST">
                            <input class="form-control me-2 inputRounded" type="text" name="busca" placeholder="Pesquisar...">
                            <button class="btn btn-link buttonHover" type="submit">
                            <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="produtos.php"><i class="fa-solid fa-list"></i> Produtos</a>
                    </li>
                    <?php
                    if(isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] = "2"):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="meusPedidos.php"></i><i class="fa-solid fa-clipboard"></i> Meus pedidos</a>
                    </li>

                    <?php elseif(isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] = "1"): ?>
                        <li class="nav-item">
                        <a class="nav-link" href="produtosListar.php"><i class="fa-solid fa-cart-shopping"></i> Meus produtos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"></i><i class="fa-solid fa-clipboard"></i> Minhas vendas</a>
                    </li>




                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="lojistaLogin.php"><i class="fa-solid fa-user-tag"></i> Área do Lojista</a>
                    </li>
                    <?php endif;?>
                    <?php if (!empty($_SESSION) && isset($_SESSION['Nome'])) : ?>
                        <li class="nav-item">
                            <span class="nav-link text-danger">Olá, <?php echo $_SESSION['Nome'] ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="consumidorLogin.php"><i class="fa-solid fa-user"></i> Login/Cadastro</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>