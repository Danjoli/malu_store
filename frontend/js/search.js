document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-bar input");     // Campo de busca
    const products = document.querySelectorAll(".product");             // Lista de produtos
    const offers = document.querySelectorAll(".offer");                 // Lista de ofertas

    const gruposProdutos = document.querySelectorAll(".more-products"); // Seleciona todos os grupos
    const gruposOfertas = document.querySelectorAll(".more-offers");    // Seleciona todos as ofertas
    const btnVerMais = document.getElementById("verMais"); 
    const btnOfertas = document.getElementById("ofertas");

    const tituloDestaques = document.querySelectorAll(".titulo-destaques");
    const tituloOfertas = document.querySelectorAll(".titulo-ofertas");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase().trim();   // Normaliza o termo de busca
        const isSearching = searchTerm.length > 0;           // Verifica se há texto digitado


        // Função para filtrar itens com base no texto
        function filterItems(items) {
            let hasVisibleItems = false;

            items.forEach(item => {
                const name = item.querySelector("p").textContent.toLowerCase(); // Nome do produto ou oferta
                if (name.includes(searchTerm)) {
                    item.style.display = "block"; // Mostra o item se corresponder à busca
                    hasVisibleItems = true;
                } else {
                    item.style.display = "none"  // Esconde o item se não corresponder
                }
            });

            return hasVisibleItems;
        }

        // Aplica a busca nos produtos e nas ofertas
        const hasProducts = filterItems(products);
        const hasOffers = filterItems(offers);

        // Oculta ou exibe os botões dependendo da busca
        if (isSearching) {
            if (btnVerMais) btnVerMais.style.display = "none";
            if (btnOfertas) btnOfertas.style.display = "none";

            // Garante que os produtos de produtos e ofertas apareçam
            gruposProdutos.forEach((grupo, index) => {
                grupo.style.display = "flex"
                grupo.style.opacity = 1; 
            });

            gruposOfertas.forEach((grupo, index) => {
                grupo.style.display = "flex"
                grupo.style.opacity = 1; 
            });
            /*
            gruposProdutos.forEach(grupo => grupo.classList.remove("hidden-featured"));
            gruposOfertas.forEach(grupo => grupo.classList.remove("hidden-offer"));
            */

            // Oculta os titulos se não houver produtos ou ofertas
            tituloDestaques.forEach(titulo => titulo.style.display = hasProducts ? "block" : "none");
            tituloOfertas.forEach(titulo => titulo.style.display = hasOffers ? "block" : "none");
        } else {
            if (btnVerMais) btnVerMais.style.display = "block";
            if (btnOfertas) btnOfertas.style.display = "block";

            // Esconde os grupos de produtos e ofertas
            /*
            gruposProdutos.forEach(grupo => grupo.classList.add("hidden-featured"));
            gruposOfertas.forEach(grupo => grupo.classList.add("hidden-offer"));
            */
            gruposProdutos.forEach((grupo, index) => {
                grupo.style.display = "none"
                grupo.style.opacity = 0; 
            });

            gruposOfertas.forEach((grupo, index) => {
                grupo.style.display = "none"
                grupo.style.opacity = 0; 
            });

            // Exibe os títulos novamente ao sair da pesquisa
            tituloDestaques.forEach(titulo => titulo.style.display = "block");
            tituloOfertas.forEach(titulo => titulo.style.display = "block");
        }
    });
});

