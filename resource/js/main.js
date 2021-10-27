function menu()
{
   var barraVertical = document.querySelector("#menu-lateral")
   var conteudoPainel = document.querySelector(".painel")

    barraVertical.classList.toggle("active-barra")
    conteudoPainel.classList.toggle("active-conteudo")
}

// Funções utilizadas no alerta e no modal

function confirmacaoModal($id, caminho)
{
    var modal = document.querySelector(".modal")
    var botao = document.querySelector("#botaoExclusao")
    modal.classList.add('active')
    botao.setAttribute("href", caminho + "?id=" + $id)
}

function fechaAlerta() 
{
    var alerta = document.querySelector(".alerta");
    alerta.style.display = "none";
}


function validacaoCampo(campo)
{
    var campoFormulario = document.getElementById(campo).value 
    var alerta = document.getElementById("validacao-" + campo)
    
    if(campoFormulario == "" || campoFormulario == null)
    {
        alerta.style.display = "block"

    }
    else
    {
        alerta.style.display = "none"
    }
}


// Mascara de Campo
$(document).ready(function()
{
    $('.numero-container').mask('SSSS0000000');
});