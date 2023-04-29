<?php
session_start()


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
    <link rel = "icon" href ="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type = "image/x-icon">
</head>
<body>
    <?php require('header.php')?>

    <div class='.container-fluid'>
    <div class="row justify-content-center pt-5">
        <div class='col-10'>
            <div class="card">
                <h3 class="card-header text-dark">Cadastre um produto</h3>
                <div class="card-body">
                    <div class='col'>
                        <form action="input" method="POST">
                        <div class="mb-1">
                            <label for="" class="form-label">Nome do produto</label> 
                            <input type="text" name="Nome" class="form-control" id="Nome" placeholder = 'Ex: Creatina Growht'>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Preco</label>
                            <input type="text" name="Preco" class="form-control" id="Preco"L placeholder='Ex: R$60,00'>
                        <div>
                        <div class="mb-3">
                            <label for="" class="form-label">Peso</label>
                            <input type="text" name="Peso" class="form-control" id="Peso" placeholder="Ex: 900g">
                        <div>
                        <div class="mb-3">
                            <p> </p>
                        </div>
                        <!-- Categoria -->
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example">
                            <option selected>Tipo produto</option>
                            <option value="1">Termogênicos</option>
                            <option value="2">Aminoácidos</option>
                            <option value="3">Acessórios</option>
                            </select>
                        </div>
                        <!-- Descricao-->
                        <div class="mb-3">
                            <p></p>
                            <label for="Descricao" class="form-label">Descrição do produto</label>
                            <textarea class="form-control" id="Descricao" rows="3"></textarea>
                        </div>
                        <!-- Selecao de foto -->
                        <div class="mb-3">
                        <p>Selecione uma foto do produto</p>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <input name = 'upload' type="file" class="form-control" id="Foto">
                            <label class="input-group-text" for="inputGroupFile02">Enviar</label>
                        </div>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>