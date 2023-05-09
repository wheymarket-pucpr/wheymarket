<?php
if (!empty($_GET['id'])) {
    include_once('conexao.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT *  FROM lojista WHERE ID=$id";

    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM lojista WHERE ID=$id";
        $resultDelete = $conn->query($sqlDelete);
    }
}
require('logout.php');
header('location: index.php');

?>