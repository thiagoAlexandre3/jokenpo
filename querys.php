<?php
include_once('./api/conexao.php');

$sql_query1 = "delete from partida;";
$sql_query2 = "delete from load_partida;";
$sql_query3 = "delete from users;";
$sql_query4 = "ALTER TABLE partida AUTO_INCREMENT = 1;";
$sql_query5 = "ALTER TABLE load_partida AUTO_INCREMENT = 1;";
$sql_query6 = "ALTER TABLE users AUTO_INCREMENT = 1;";

$query1 = mysqli_query($conn, $sql_query1);
$query2 = mysqli_query($conn, $sql_query2);
$query3 = mysqli_query($conn, $sql_query3);
$query4 = mysqli_query($conn, $sql_query4);
$query5 = mysqli_query($conn, $sql_query5);
$query6 = mysqli_query($conn, $sql_query6);

?>