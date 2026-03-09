let jogada = 0;
let vencedor = "";
let jogou = true;

//recebe jogada
function fpedra(){
    jogada = 1;
}
function fpapel(){
    jogada = 2;
}
function ftesoura(){
    jogada = 3;
}

//envia jogada e recebe resultado
function resultado(){
    if(jogou){
        if (jogada == 0){
                alert("Selecione sua jogada antes de comparar");
            }else{
                //desabilita botao
                document.getElementById('btn_compara').innerHTML = "Aguardando jogada...";
                document.getElementById('btn_compara').disabled = true;

                const dados = JSON.stringify(jogada);
                $.ajax({
                    url: './api/vencedor.php',
                    type: 'POST',
                    data: {data: dados},
                    success: function(result){
                        jogou = false;
                        document.getElementById('btn_compara').innerHTML = "Jogar novamente";
                        document.getElementById('btn_compara').disabled = false;
                        //document.getElementById('btn_compara').innerHTML = "jogador: " + result.vencedor + ", venceu";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            }
    }else{
        window.location.href = "./index.php";
    }
    
}