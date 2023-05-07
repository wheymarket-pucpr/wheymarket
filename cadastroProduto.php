<?php
session_start();
require 'conexao.php';

// input e verificacao da imagem
$img = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($_FILES['imgProduto'])) {

    $img = $_FILES['imgProduto'];

    if ($img['type'] == "application/png" || "application/jpeg") {

        $imgBlob = addslashes(file_get_contents($img['tmp_name']));
        
    } else {
        echo "<p style='color: #f00;'>Erro: Extensão do arquivo inválido.";
    }

}   else{
        echo "campo nao preenchido";
    }


// input dos dados do produto 
if (!empty($_POST) && isset($_POST['Nome']) && isset($_POST['Preco']) && isset($_POST['Peso']) && isset($_POST['Quantidade']) && isset($_POST['Descricao'])) {
    $nome = $conn->real_escape_string($_POST['Nome']);
    $preco    = $conn->real_escape_string($_POST['Preco']);
    $quantidade    = $conn->real_escape_string($_POST['Quantidade']);
    $peso   = $conn->real_escape_string($_POST['Peso']);
    $categoria   = $conn->real_escape_string($_POST['fk_Categoria_Produto_ID']);
    $descricao   = $conn->real_escape_string($_POST['Descricao']);
    $id = $_SESSION['id'];
    $sql = "INSERT INTO Produto(fk_Lojista_ID, fk_Categoria_Produto_ID, Nome, Preco, Quantidade, Peso, Descricao, imagem) 
                VALUES ('$id','$categoria','$nome','$preco','$quantidade','$peso','$descricao', '$imgBlob')";

    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Cadastro efetuado com sucesso. Você já pode vender em nosso site! ";
        header('location: listarProdutos.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente novo cadastro.";
        header('location: index.php');
        exit();
    }
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
            <a href="lojistaPage.php" class="logo">Whey <span>Market</span><h6>Area do vendedor</h6></a>

        </div>
        <div>
            <ul class="nav-menu">
                <i class='bx bx-search'></i>
                <li class="nav-item"><a href="lojistaPage.php">Inicio</a></li>
                <li class="nav-item"><a href="#">Minhas vendas</a></li>
                <li class="nav-item"><a href="listarProdutos.php">Meus produtos</a></li>
                <li class="nav-item"><a href="cadastroProduto.php">Cadastrar produto</a></li>
                <?php
                ?>
                <li class="nav-item"><span class='text-red'>Ola, <?php echo $_SESSION['Nome']?></span></li>
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
    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-10'>
                <div class="card">
                    <h3 class="card-header text-dark">Cadastre um produto</h3>
                    <div class="card-body">
                        <div class='col'>
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome do produto</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder='Ex: Creatina Growth' required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <div class="mb-3" style="display:block">
                                    <label for="Preco" class="form-label">Preco</label><label>R$</label>
                                    <input type="text" name="Preco" class="form-control" id="Preco" placeholder='Ex: R$60,00' required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Quantidade" class="form-label">Quantidade</label>
                                    <input type="number" name="Quantidade" class="form-control" id="Quantidade" L placeholder='Ex: 50 produtos' required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Peso" class="form-label">Peso</label>
                                    <input type="number" name="Peso" class="form-control" id="Peso" placeholder="Ex: 900g" required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <!-- Categoria -->
                                <div class="mb-3">
                                    <select id='fk_Categoria_Produto_ID' class="form-select" name="fk_Categoria_Produto_ID" aria-label="Default select example" required>
                                        <option selected>Tipo produto</option>
                                        <option value="1">Termogênicos</option>
                                        <option value="2">Aminoácidos</option>
                                        <option value="3">Acessórios</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecione uma categoria.
                                    </div>
                                </div>
                                <!-- Descricao-->
                                <div class="mb-3">
                                    <label for="Descricao" class="form-label">Descrição do produto</label>
                                    <textarea name="Descricao" class="form-control" id="Descricao" rows="3"></textarea >
                                </div>
                                <!-- Selecao de foto -->
                                <div class="mb-3">
                                    <label for="imgProduto" class="form-label">Selecione uma foto do produto</label>
                                    <input class="form-control" type="file" id="imgProduto" name="imgProduto" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js">
    $('.Preco').mask('#.##0,00', {reverse: true});
</script> 

</html>