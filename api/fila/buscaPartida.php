<?php

//cria conexão com o banco
include_once("../conexao.php");

//precisa importar a função que já montou o array guarda_ip_load
$sql_verifica_usuarios_load = "SELECT jogador FROM load_partida WHERE aceita = 'N';";
$verifica_usuarios_load = mysqli_query($conn, $sql_verifica_usuarios_load);
$guarda_ip_load = array();
$count_guarda_ip_load = 1;
$count_timeout_fila = 0;

while(($row = mysqli_fetch_assoc($verifica_usuarios_load))){
    $guarda_ip_load[$count_guarda_ip_load] = $row['jogador'];
    $count_guarda_ip_load++;
}

while((count($guarda_ip_load) % 2) != 0){
    sleep(2);
    $count_atualiza_ip_load = 1;
    while($row = mysqli_fetch_assoc($verifica_usuarios_load)){
        $guarda_ip_load[$count_atualiza_ip_load] = $row['jogador'];
        $count_atualiza_ip_load++;
    }
    $count_timeout_fila++;
    if ($count_timeout_fila > 12) {
        //precisa apagar a fila
        header('Location: ../../index.php');
    }
}
header('Location: montaDuplas.php');

?>