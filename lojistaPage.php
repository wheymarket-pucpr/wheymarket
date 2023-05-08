<?php
session_start();
require('conexao.php');

$idLojista = $_SESSION['id'];

$sql = "select * from lojista where ID = '$idLojista'";
if ($result = $conn->query($sql)) {
$lojista = mysqli_fetch_assoc($result);
$sql2 = "SELECT * from produto where fk_Lojista_ID=$idLojista";
$result2 = $conn->query($sql2);


} else {
    // criar mensagem caso falhe o sql
}
?>
<!DOCTYPE html>
<html lang="Pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>WheyMarket</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="navigation ">
            <div class="flex-center-logo">
                <a href="lojistaPage.php"><img src="src/img/logo.png" width="100px" height="100px"></a>
                <a href="lojistaPage.php" class="logo">Whey <span>Market</span>
                    <h6>Area do vendedor</h6>
                </a>

            </div>
            <div>
                <ul class="nav-menu">
                    <i class='bx bx-search'></i>
                    <li class="nav-item"><a href="index.php">Inicio</a></li>
                    <li class="nav-item"><a href="#">Minhas vendas</a></li>
                    <li class="nav-item"><a href="listarProdutos.php">Meus produtos</a></li>
                    <li class="nav-item"><a href="cadastroProduto.php">Cadastrar produto</a></li>
                    <?php
                    ?>
                    <li class="nav-item"><span class='text-red'>Ola, <?php echo $_SESSION['Nome'] ?></span></li>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                    <?php
                    ?>
                </ul>
            </div>
            <div class="menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col p-5">
                <table class="table table-hover table-striped">
                    <thead> <h2>Dados do Lojista</h2>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Qtd Produtos cadastrados</th>
                            <th scope="col">Editar/Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?php echo $lojista['Nome'] ?></td>
                                <td><?php echo $lojista['email'] ?></td>
                                <td><?php echo $lojista['CNPJ'] ?></td>
                                <td><?php echo mysqli_num_rows($result2) ?></td>
                                <td>
                                    <a class='btn btn-sm btn-primary' href='editLojista.php?&id=<?php echo $lojista['ID'] ?>' title='Editar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z' />
                                        </svg>
                                    </a>
                                    <a class='btn btn-sm btn-danger' href='editLojista.php?id=<?php echo $lojista['ID'] ?>' title='Deletar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>