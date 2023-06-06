<?php
session_start();
require('conexao.php');
if(isset($_SESSION['id'])){

$idLojista = $_SESSION['id'];

$sql = "select * from lojista where ID = '$idLojista'";
if ($result = $conn->query($sql)) {
    $lojista = mysqli_fetch_assoc($result);
    $sql2 = "SELECT * from produto where fk_Lojista_ID=$idLojista";
    $result2 = $conn->query($sql2);
} else {
    // criar mensagem caso falhe o sql
}
}
?>
<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php');?>

<body>
<?php
    require('navbar.php');
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col p-5">
            <table class="table table-hover table-striped">
                <thead>
                <h3>Dados do Lojista</h3>
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

                        <!-- botao editar -->
                        <a class='btn btn-sm btn-primary' href='lojistaEdit.php?&id=<?php echo $lojista['ID'] ?>'
                           title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                 class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path
                                    d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                        </a>
                        <!-- botao deletar -->
                        <button type="button" class="btn btn-sm btn-danger" id="btn-confirm" data-bs-toggle="modal"
                                data-bs-target="#JanelaModal">
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                 class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path
                                    d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </button>
                        </a>
                        <div id="JanelaModal" class="modal fade">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tem certeza que deseja excluir seu cadastro?</h4>
                                    </div>

                                    <div class="modal-body">
                                        <p>Ao excluir seu cadastro não será mais possível recuperar a conta.</p>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger">
                                            <a href='lojistaDelete.php?id=<?php echo $lojista['ID'] ?>'>Excluir</a>
                                        </button>

                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar
                                        </button>

                                    </div>
                                </div>

</body>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

<!-- modal -->


</html>

<script>
    var modalConfirm = function (callback) {

        $("#btn-confirm").on("click", function () {
            $("#mi-modal").modal('show');
        });

        $("#modal-btn-si").on("click", function () {
            callback(true);
            $("#mi-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function () {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };

    modalConfirm(function (confirm) {
        if (confirm) {
            //Acciones si el usuario confirma
            $("#result").html("Deletado!");
        }

    });
</script>