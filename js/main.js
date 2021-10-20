function menu()
{
   var barraVertical = document.querySelector("#menu-lateral")
   var conteudoPainel = document.querySelector(".painel")

    barraVertical.classList.toggle("active-barra")
    conteudoPainel.classList.toggle("active-conteudo")
}