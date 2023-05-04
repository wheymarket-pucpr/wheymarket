<?php
// Conecte-se ao Banco de Dados
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "bdwheymarket";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if($conn->connect_error){
    die("Conexão Falhou: " . $conn->connect_error);
}

// Receba o termo de pesquisa do formulário
$busca = $_POST['busca'];

// Executa a consulta SQL
$sql = "SELECT * FROM produto WHERE nome LIKE '%$busca%'";
$result = $conn->querry($sql);

// Exiba os resultados da pesquisa
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Produto: " .$row['nome'] . '<br>';
    }
} else{
    echo "Não foram encontrados resultados.";
}

//Feche a conexão com o Banco de Dados
$conn->close();
?>