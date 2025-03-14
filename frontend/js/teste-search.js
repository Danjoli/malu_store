document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-bar input");     // Campo de busca

    const gruposProdutos = document.querySelectorAll(".product"); // Seleciona todos os produtos
    const gruposOfertas = document.querySelectorAll(".offer");    // Seleciona todos as ofertas
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
        const hasProducts = filterItems(gruposProdutos);
        const hasOffers = filterItems(gruposOfertas);

        if (btnVerMais) btnVerMais.style.display = isSearching ? "none" : "block";
        if (btnOfertas) btnOfertas.style.display = isSearching ? "none" : "block";
        
        // Oculta os titulos se não houver produtos ou ofertas
        tituloDestaques.forEach(titulo => titulo.style.display = hasProducts ? "block" : "none");
        tituloOfertas.forEach(titulo => titulo.style.display = hasOffers ? "block" : "none");

        // Verifica se apenas ofertas estão sendo exibidas
        if (!hasProducts && hasOffers) {
            tituloOfertas.forEach(titulo => titulo.style.marginTop = "0px");
        } else {
            tituloOfertas.forEach(titulo => titulo.style.marginTop = "30px");
        } 
    });
});

