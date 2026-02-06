<?php
//cria conexão com o bd
include_once('./conexao.php');

//identifica jogador
$ip = $_SERVER['REMOTE_ADDR'];
$player = 0;

//captura jogada
$jogada = $_POST['data'];
$dados = json_decode($jogada, true);

//armazenar jogada
$sql_localiza_sessao1 = "SELECT id from partida WHERE id_jogador1 = '$ip' AND sessao = 'Aberta';";
$localiza_sessao1 = mysqli_query($conn, $sql_localiza_sessao1);
$array_localiza_sessao = array();
$count_sessao = 1;

while($row = mysqli_fetch_assoc($localiza_sessao1)){
    $array_localiza_sessao[$count_sessao] = $row['id'];
    $count_sessao++;
}

if(count($array_localiza_sessao) > 0){
    $sql_armazena_jogada = "UPDATE partida SET jogada1 = '$dados' WHERE id = '{$array_localiza_sessao[$count_sessao - 1]}';";
    $armazena_jogada = mysqli_query($conn, $sql_armazena_jogada);
    $player = 1;
}else{
    $sql_localiza_sessao2 = "SELECT id from partida WHERE id_jogador2 = '$ip' AND sessao = 'Aberta';";
    $localiza_sessao2 = mysqli_query($conn, $sql_localiza_sessao2);
    $array_localiza_sessao = array();

    while($row = mysqli_fetch_assoc($localiza_sessao2)){
        $array_localiza_sessao[$count_sessao] = $row['id'];
        $count_sessao++;
    }

    $sql_armazena_jogada = "UPDATE partida SET jogada2 = '$dados' WHERE id = '{$array_localiza_sessao[$count_sessao - 1]}';";
    $armazena_jogada = mysqli_query($conn, $sql_armazena_jogada);
    $player = 2;
}

//aguarda prontidao

$sql_verifica_jogadas = "SELECT count(*) AS tt FROM partida WHERE id = '{$array_localiza_sessao[$count_sessao - 1]}' AND jogada1 > 0 AND jogada2 > 0;";
$verifica_jogadas = mysqli_query($conn, $sql_verifica_jogadas);
$array_verifica_jogadas = array();
$count_timeout = 0;
$jogou = false;

while($row = mysqli_fetch_assoc($verifica_jogadas)){
    $array_verifica_jogadas[1] = $row['tt'];
}

if($array_verifica_jogadas[1] == 1){
    $jogou = true;
} else{
    while($count_timeout < 9){
        sleep(3);
        $count_timeout++;
        $verifica_jogadas = mysqli_query($conn, $sql_verifica_jogadas);
        while($row = mysqli_fetch_assoc($verifica_jogadas)){
            $array_verifica_jogadas[1] = $row['tt'];
        }
        if($array_verifica_jogadas[1] == 1){
            $jogou = true;
            break;
            //caso break n funcione > $count_timeout = 10;
        }
    }
}

// compara jogadas
$vencedor = 4;
if($jogou){
    $sql_jogada1 = "SELECT jogada1 FROM partida WHERE id = $array_localiza_sessao[1]";
    $jogada1 = mysqli_query($conn, $sql_jogada1);
    $array_jogada1 = array();

    while($row = mysqli_fetch_assoc($jogada1)){
        $array_jogada1[1] = $row['jogada1'];
    }

    $sql_jogada2 = "SELECT jogada2 FROM partida WHERE id = $array_localiza_sessao[1]";
    $jogada2 = mysqli_query($conn, $sql_jogada2);
    $array_jogada2 = array();

    while($row = mysqli_fetch_assoc($jogada2)){
        $array_jogada2[1] = $row['jogada2'];
    }

    //empate
    if ($array_jogada1[1] == $array_jogada2[1]) {
        $vencedor = 0;
    }

    //pedra vence
    elseif (($array_jogada1[1] == 1 && $array_jogada2[1] == 3) || ($array_jogada1[1] == 3 && $array_jogada2[1] == 1)){
        $vencedor = 2;
        if ($array_jogada1[1] == 1) {
            $vencedor = 1;
        }
    }

    //papel vence
    elseif (($array_jogada1[1] == 1 && $array_jogada2[1] == 2) || ($array_jogada1[1] == 2 && $array_jogada2[1] == 1)) {
        $vencedor = 1;
        if ($array_jogada1[1] == 1) {
            $vencedor = 2;
        }  
    }

    //tesoura venceu
    elseif (($array_jogada1[1] == 2 && $array_jogada2[1] == 3) || ($array_jogada1[1] == 3 && $array_jogada2[1] == 2)) {
        $vencedor = 2;
        if ($array_jogada1[1] == 3) {
            $vencedor = 1;
        }
    }

}else{
    $vencedor = 5;
}

//envia resultado
$result_s = array("player" => $player, "vencedor" => $vencedor);
$result_j = json_encode($result_s);

header('Content-Type: application/json');

echo $result_j;
?>