<?php
global $servername ;
global $username;
global $password;
global $database;

$servername = "localhost";
$username = "root";
$password = "";
$database = "bdwheymarket";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
}

?>