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
                    <form action="produtoBusca.php" method="POST" style="display:flex;height:25px;gap:10px;align-items:center">
                        <input type="text" name="busca" placeholder="Pesquisar..." style="padding: 5px;border-radius: 15px">
                        <button class = "btn btn-primary"type="submit"  style="border:none;background-color: grey;align-items: center;display:flex;border-radius: 10px;height:30px"><i class='bx bx-search'></i></button>
                    </form>
                <li class="nav-item"><a href="index.php">Home</a></li>
                <li class="nav-item"><a href="produtos.php">Produtos</a></li>
                <li class="nav-item"><a href="#">Carrinho</a></li>
                <li class="nav-item"><a href="loginLojista.php">Área do Lojista</a></li>
                <?php if (!empty($_SESSION) && isset($_SESSION['Nome'])) : ?>
                    <li class="nav-item"><span class='text-red'>Ola, <?php echo $_SESSION['Nome'] ?></span></li>
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