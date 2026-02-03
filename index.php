<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jokenpô</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/style_register.css">
</head>
<header>
    <div class="menu">
        <!--<input type="checkbox" id="seleciona_avatar">-->
        <div class="avatar" onclick="mostra_infos()">
            <img class="imagem_avatar" src="img/avatar.jpg" alt="Avatar">
            <!--<label class="lavatar" for="seleciona_avatar"></label>-->
        </div>
        <div class="infos_user" id="infos_user">
            <ul class="lista_user">
                <li id="player"></li>
                <li id="name"></li>
            </ul>
            <ul class="lista_infos">
                <li id="info_player"></li>
                <li id="info_name"></li>
            </ul>
        </div>
    </div>
</header>
<body>
    <div class="container_players">
        <div class="jogadores" id="player1" onclick="seleciona_player1()"><p class="cjogadores">player 1</p></div> 
        <div class="jogadores" id="player2" onclick="seleciona_player2()"><p class="cjogadores">player 2</p></div> 
    </div>
    <form id="form" method="POST" action="./api/dados.php">
    <div class="nickname">
        <label class="lnickname" for="Nickname">Nickname:</label>
        <input class="cnickname" name="nickname" type="text" id="nickname" maxlength="14" minlength="2" autocomplete="off" required>
    </div>
    <button id="play">Play</button></div>
    </form>
    <!--
    <div class="container_loading">
        <div class="loading"><p class="cloading">Buscando partida...</p></div>
    </div>
    -->
    <script src="scripts/script.js" language="javascript"></script>
</body>
</html>