<?php
?>
<header>
    <nav class="navigation ">
        <div class="flex-center-logo">
            <a href="index.php"><img src="src/img/logo.png" width="100px" height="100px"></a>
            <a href="index.php" class="logo">Whey <span>Market</span></a>
        </div>
        <div>
            <ul class="nav-menu">
                <i class='bx bx-search'></i>
                <li class="nav-item"><a href="index.php">Home</a></li>
                <li class="nav-item"><a href="produtos.php">Produtos</a></li>
                <li class="nav-item"><a href="#">Carrinho</a></li>
                <li class="nav-item"><a href="cadastroLojista.php">Quero vender</a></li>
                <?php if (!empty($_SESSION) && isset($_SESSION['Nome'])) : ?>
                    <li class="nav-item"><span class='text-red'>Ola, <?php echo $_SESSION['Nome'] ?></span></li>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                <?php else : ?>
                    <li class="nav-item"><a href="login.php">Login/Cadastro</a></li>
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