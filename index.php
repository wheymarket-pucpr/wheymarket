<?php
    session_start();
    $islogged = false;
    if(session_status() === PHP_SESSION_ACTIVE){
        $islogged = $_SESSION['logado'];
    }
?>
<!DOCTYPE html>
<html lang="Pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>WheyMarket</title>
    <link rel = "icon" href ="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type = "image/x-icon">
</head>
<body>
    <header>
        <nav class="navigation">
            <a href="#" class="logo">Whey <span>Market</span></a>
            <img src="/src/img/logo.jpg"alt="" width="30px">
            <ul class="nav-menu">
                <i class='bx bx-search'></i>
                <li class="nav-item"><a href="#">Home</a></li>
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
    <main>
        <section class="home">
            <div class="home-text">
                <h4 class="text-h4">Bem vindo ao Whey Market</h4>
                <h1 class="text-h1">Seu marketplace segmentado para suplementos</h1>
                <p>Homepage do projeto de Experiencia Crativa</p>
                <a href="#" class="home-btn">Veja nosso catalogo</a>
            </div>
            <div><img src="src/img/fundohome.png" alt="" width="500"></div>
        </section>
    </main>
</body>
</html>