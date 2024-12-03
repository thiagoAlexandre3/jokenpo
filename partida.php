<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jokenpô</title>
    <link rel="stylesheet" href="styles/style_partida.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="./scripts/script_partida.js" language="javascript"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="container_players">
        <div class="jogador1"><p class="cjogadores">player 1</p></div> <!-- conteudo do display-->
    </div>
    <div class="container_opcoes">
        <div class="imagem1">
            <img id="fpedra" class="pedra" src="img/pedra.png" alt="pedra" onclick="fpedra()">     
        </div>
        <div class="imagem2">
            <img id="fpapel" class="papel" src="img/papel.png" alt="papel" onclick="fpapel()">
        </div>
        <div class="imagem3">
            <img id="ftesoura" class="tesoura" src="img/tesoura.png" alt="tesoura"  onclick="ftesoura()">
        </div>
    </div>
    <div class="container_players">
        <div class="jogador2"><p class="cjogadores">player 2</p></div>
    </div>
    <button id="btn_compara" onclick="resultado()">Resultado</button>

</body>
</html>
