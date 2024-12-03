<?php
//cria conexão com o banco
include_once("../conexao.php");


//consulta ip
$ip = $_SERVER['REMOTE_ADDR'];


//verifica como está a fila
$sql_verifica_usuarios_load = "SELECT jogador FROM load_partida WHERE aceita = 'N';";
$verifica_usuarios_load = mysqli_query($conn, $sql_verifica_usuarios_load);
$guarda_ip_load = array();
$count_guarda_ip_load = 1;

while(($row = mysqli_fetch_assoc($verifica_usuarios_load))){
    $guarda_ip_load[$count_guarda_ip_load] = $row['jogador'];
    $count_guarda_ip_load++;
}


//localiza posição desse jogador
$count_identifica_user_load = 1;
while($guarda_ip_load[$count_identifica_user_load] != $ip){
    $count_identifica_user_load++;
    if($count_identifica_user_load > 20){
        break;
    }
}

if($count_identifica_user_load > 20){
    header('Location: ../../index.php');
    //LOG
}


// se for impar e tem um na casa posterior, insere na fila
$sql_confere_insercao = "SELECT id FROM partida WHERE (id_jogador1 = '$ip' AND sessao = 'Aberta') OR (id_jogador2 = '$ip' AND sessao = 'Aberta');";
$confere_insercao  = mysqli_query($conn, $sql_confere_insercao);
$guarda_insercao = array();
while($row = mysqli_fetch_assoc($confere_insercao)){
    $guarda_insercao[1] = $row['id'];
}

if((($count_identifica_user_load % 2) != 0) && (count($guarda_ip_load) > $count_identifica_user_load)){
    $sql_limpa_fila = "UPDATE load_partida SET aceita = 'Y' WHERE jogador = '{$guarda_ip_load[$count_identifica_user_load]}' OR jogador = '{$guarda_ip_load[$count_identifica_user_load + 1]}';";
    if(count($guarda_insercao) >= 1){
        $limpa_fila = mysqli_query($conn, $sql_limpa_fila);
        header('Location: ../../partida.php');
    }else{
        sleep(2);
        if(count($guarda_insercao) >= 1){
            $limpa_fila = mysqli_query($conn, $sql_limpa_fila);
            header('Location: ../../partida.php');
        }else{
            header('Location: ../../index.php');
            //só depois melhorar! não tira isso, é importante, o esperar é uma contingencia apenas. pode muito bem ocorrer esse cenário
        }
    }
} elseif (($count_identifica_user_load % 2) == 0) {
    $sql_cria_partida = "INSERT INTO partida (id_jogador1, id_jogador2, sessao) VALUES ('{$guarda_ip_load[$count_identifica_user_load - 1]}', '{$guarda_ip_load[$count_identifica_user_load]}', 'Aberta');";
    $cria_partida = mysqli_query($conn, $sql_cria_partida);
    header('Location: ../../partida.php');
} else{
    $count_timeout_fila = 1;
    $count_atualiza_ip_load = 1;
    $count_identifica_user_load = 1;
    $sql_verifica_usuarios_load = "SELECT jogador FROM load_partida WHERE aceita = 'N';";
    $verifica_usuarios_load = mysqli_query($conn, $sql_verifica_usuarios_load);
    $guarda_ip_load = array();

    sleep(2);
    while($row = mysqli_fetch_assoc($verifica_usuarios_load)){
        $guarda_ip_load[$count_atualiza_ip_load] = $row['jogador'];
        $count_atualiza_ip_load++;
    }

    while($guarda_ip_load[$count_identifica_user_load] != $ip){
        $count_identifica_user_load++;
        if($count_identifica_user_load > 20){
            break;
        }
    }
    if($count_identifica_user_load > 20){
        header('Location: ../../index.php');
        //LOG
    }

    while(count($guarda_ip_load) <= $count_identifica_user_load){
        $count_atualiza_ip_load = 1;
        $count_identifica_user_load = 1;
        $sql_verifica_usuarios_load = "SELECT jogador FROM load_partida WHERE aceita = 'N';";
        $verifica_usuarios_load = mysqli_query($conn, $sql_verifica_usuarios_load);
        $guarda_ip_load = array();

        sleep(2);
        while($row = mysqli_fetch_assoc($verifica_usuarios_load)){
            $guarda_ip_load[$count_atualiza_ip_load] = $row['jogador'];
            $count_atualiza_ip_load++;
        }

        while($guarda_ip_load[$count_identifica_user_load] != $ip){
            $count_identifica_user_load++;
            if($count_identifica_user_load > 20){
                break;
            }
        }
        if($count_identifica_user_load > 20){
            header('Location: ../../index.php');
            //LOG
        }

        $count_timeout_fila++;
        if($count_timeout_fila > 10) {
            $sql_limpa_fila = "UPDATE load_partida SET aceita = 'Y' WHERE jogador = '{$guarda_ip_load[$count_identifica_user_load]}';";
            $limpa_fila = mysqli_query($conn, $sql_limpa_fila);
            break;
        }
    }
    if($count_timeout_fila > 10){
        header('Location: ../../index.php');
    }else{
        sleep(1);
        $sql_limpa_fila = "UPDATE load_partida SET aceita = 'Y' WHERE jogador = '{$guarda_ip_load[$count_identifica_user_load]}' OR jogador = '{$guarda_ip_load[$count_identifica_user_load + 1]}';";
        $limpa_fila = mysqli_query($conn, $sql_limpa_fila);
        header('Location: ../../partida.php');
    }
}

?>