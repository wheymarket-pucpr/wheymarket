<?php
?>
<head>
    <link rel="stylesheet" href="css/buscar.css">
    <meta charset="utf-8">
</head>
<header>
    <nav class="navigation ">
        <div class="flex-center-logo">
            <a href="index.php"><img src="src/img/logo.png" width="100px" height="100px"></a>
            <a href="index.php" class="logo">Whey <span>Market</span></a>
        </div>
        <div>
            <ul class="nav-menu"> 
                    <form action="produtoBusca.php" method="POST" style="display:flex;height:25px">
                        <input type="text" name="busca" placeholder="Pesquisar...">
                        <button class = "btn btn-primary"type="submit"  style="align-items: center;"><i class='bx bx-search'style="display:flex"></button>
                    </form>
                </i>
                <li class="nav-item"><a href="index.php">Home</a></li>
                <li class="nav-item"><a href="produtos.php">Produtos</a></li>
                <li class="nav-item"><a href="#">Carrinho</a></li>
                <li class="nav-item"><a href="loginLojista.php">Área do Lojista</a></li>
                <?php if (!empty($_SESSION) && isset($_SESSION['Nome'])) : ?>
                    <li class="nav-item"><span class='text-red'>Ola, <?php echo $_SESSION['Nome'] ?></span></li>
                    <?php if ($_SESSION['tipoLogin']== 1): ?>
                    <li class="nav-item "><a href="lojistaPage.php"><span class='text-red'>Pag lojista</span></a></li>
                    <?php endif ?>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>


                <?php else : ?>
                    <li class="nav-item"><a href="loginConsumidor.php">Login/Cadastro</a></li>
                <?php endif; ?>
            </ul>


        </div>
        <div class="menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</header>