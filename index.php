<?php
session_start();
if(isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] == 1 ){
    header('Location: lojistaPage.php');;
}
?>
<!DOCTYPE html>
<html lang="Pt-br">

<?php 
include('htmlhead.php');

?>

<body>
    <?php
    require('navbar.php');
    ?>
    <main class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <?php
            include('mensagemSessao.php')
            ?>
            </div>
        </div>
        <section class="home">
            <div class="home-text">
                <h4 class="text-h4">Bem vindo ao Whey Market</h4>
                <h1 class="text-h1">Seu marketplace segmentado para suplementos</h1>
                <p>Homepage do projeto de Experiencia Crativa</p>
                <a href="produtos.php" class="home-btn">Veja nosso catalogo</a>
            </div>
            <div><img src="src/img/fundohome.png" alt="" width="500"></div>
        </section>
    </main>
</body>

</html>