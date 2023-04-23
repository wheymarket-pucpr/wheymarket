<header>
    <nav class="navigation">
        <a href="index.php" class="logo">Whey <span>Market</span></a>
        <ul class="nav-menu">
            <i class='bx bx-search'></i>
            <li class="nav-item"><a href="index.php">Home</a></li>
            <li class="nav-item"><a href="#">Produtos</a></li>
            <li class="nav-item"><a href="#">Carrinho</a></li>
            <li class="nav-item"><a href="#">Contato</a></li>
            <?php
            if(!$islogged):
            ?>
            <li class="nav-item"><a href="login.php">Login/Cadastro</a></li>
            <?php
            else:
            ?>
            <li class="nav-item"><a href="logout.php">Sair</a></li>
            <?php
            endif;
            ?>
        </ul>
        <div class="menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</header>