<?php

// cria conexão com o bd
include_once("./conexao.php");


// insere as infos no bd
$ip = $_SERVER['REMOTE_ADDR'];
$nick = filter_input(INPUT_POST, 'nickname');
$banco = 1;

$sql_verifica_usuarios = "SELECT ip FROM users";
$verifica_usuarios = mysqli_query($conn, $sql_verifica_usuarios);
$guarda_ip_user = array();
$count_guarda_ip = 1;
$count_verifica_ip = 1;
$comparador_ip = 0;

while(($row = mysqli_fetch_assoc($verifica_usuarios))) {
    $guarda_ip_user[$count_guarda_ip] = $row['ip'];
    $count_guarda_ip++;
}
while($count_verifica_ip <= count($guarda_ip_user)){
    if($guarda_ip_user[$count_verifica_ip] != $ip){
        $comparador_ip = 0;
    }else{
        $comparador_ip = 1;
        break;
    }
    $count_verifica_ip++;
}

if($comparador_ip == 0){
    $dados = "INSERT INTO users (ip, nickname, banco) VALUES ('$ip', '$nick', '$banco')";
    $registra_dados = mysqli_query($conn, $dados);
}


//insert load
$sql_insere_jogadores = "INSERT INTO load_partida (jogador, aceita) VALUES ('$ip', 'N')";
$insere_jogadores = mysqli_query($conn, $sql_insere_jogadores);

//busca partida
header('Location: ./fila/selecao.php');