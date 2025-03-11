document.addEventListener("DOMContentLoaded", function() {
    const btnVerMais = document.getElementById("verMais"); 
    const gruposProdutos = document.querySelectorAll(".more-products"); // Seleciona todos os grupos
    const btnOfertas = document.getElementById("ofertas");
    const gruposOfertas = document.querySelectorAll(".more-offers"); // Seleciona todos as ofertas

    btnVerMais.addEventListener("click", function () {
        if (btnVerMais.textContent == "Ver mais") {
            // Exibe todas as divisões de uma vez
            gruposProdutos.forEach(grupo => grupo.classList.remove("hidden-featured"));

            // Altera o texto do botão para "Voltar"
            btnVerMais.textContent = "Voltar";
        } else {
            // Esconde novamente as divisões extras
            gruposProdutos.forEach(grupo => grupo.classList.add("hidden-featured"));

            // Altera o texto do botão de volta para "Ver mais"
            btnVerMais.textContent = "Ver mais";
        }
    });

    btnOfertas.addEventListener("click", function () {
        if (btnOfertas.textContent == "Aproveite agora") {
            // Exibe todas as divisões de uma vez
            gruposOfertas.forEach(grupo => grupo.classList.remove("hidden-offer"));

            // Altera o texto do botão para "Voltar"
            btnOfertas.textContent = "Voltar";
        } else {
            // Esconde novamente as divisões extras
            gruposOfertas.forEach(grupo => grupo.classList.add("hidden-offer"));

            // Altera o texto do botão de volta para "Ver mais"
            btnOfertas.textContent = "Aproveite agora";
        }
    });
});
