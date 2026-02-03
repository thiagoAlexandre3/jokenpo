let players = 1;
const player2 = document.getElementById('player2');
const player1 = document.getElementById('player1');
const nick = document.querySelector("#nickname");
let valor;
const info_nick = document.getElementById('info_name');
const info_player = document.getElementById('info_player');

function seleciona_player1() {
    players = 1;
    player2.style.border = "2px solid rgb(95, 94, 94)";
    player1.style.border = "2px solid red";
    document.getElementById("infos_user").style.display = "none";
}
function seleciona_player2() {
    players = 2;
    player1.style.border = "2px solid rgb(95, 94, 94)";
    player2.style.border = "2px solid red";
    document.getElementById("infos_user").style.display = "none";
}

nick.onclick = function menu_input(){
    document.getElementById("infos_user").style.display = "none";
}
document.querySelector("#play").onclick = function menu_button(){
    document.getElementById("infos_user").style.display = "none";
}
document.querySelector("#form").onclick = function menu_form(){
    document.getElementById("infos_user").style.display = "none";
}
function coleta_infos(){
    valor = "" + nick.value;
    let mostra_nick = "";
    let mostra_player = "";

    if (valor.length > 0) {
        mostra_nick = info_nick.innerText = "" + valor;
    }
    else {
        mostra_nick = info_nick.innerText = "Não informado";
    }
    if (players == 1) {
        mostra_player = info_player.innerText = "Player 1";
    }
    else if (players == 2){
        mostra_player = info_player.innerText = "Player 2";
    }
    else {
        mostra_player = info_player.innerText = "[ERRO]!";
        console.error("[ERRO] - Não foi possível ler o player selecionado!");
    }
    return mostra_nick, mostra_player;
}
function icons_user(){
    let mostra_icon_name = "";
    let valor_nick = nick.value + "";
    let mostra_icon_player = "";
    if (valor_nick.toLowerCase().indexOf('rodrigão') !== -1) {
        mostra_icon_name = document.getElementById('name').innerHTML = "&#x1F355; nickname: ";
    }
    else {
        mostra_icon_name = document.getElementById('name').innerHTML = "&#x1F47D; nickname: ";
    }
    if (players == 1){
        mostra_icon_player = document.getElementById('player').innerHTML = "&#x261D; banco: ";
    }
    else if(players == 2){
        mostra_icon_player = document.getElementById('player').innerHTML = "&#x270C; banco: ";
    }
    else {
        mostra_icon_player = document.getElementById('player').innerHTML = "&#x2754; banco: ";

    }
    return mostra_icon_name, mostra_icon_player;
}
function mostra_infos(){
    coleta_infos(); icons_user();
    document.getElementById("infos_user").style.display = "flex";
}