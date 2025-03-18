window.addEventListener("tudoCarregado", () => {
    console.log("Tudo carregado! Iniciando search.js");
    iniciarBusca();
});

// Função para iniciar a lógica de busca somente após os produtos e ofertas terem sido carregados
function iniciarBusca() {
    if (produtosCarregados && ofertasCarregadas) {
        console.log("Produtos e ofertas carregados! Iniciando search.js");

        const searchInput = document.querySelector(".search-bar input"); // Campo de busca

        const gruposProdutos = document.querySelectorAll(".product"); // Todos os produtos
        const gruposOfertas = document.querySelectorAll(".offer"); // Todas as ofertas
        const btnVerMais = document.getElementById("verMais");
        const btnOfertas = document.getElementById("ofertas");

        const tituloDestaques = document.querySelectorAll(".titulo-destaques");
        const tituloOfertas = document.querySelectorAll(".titulo-ofertas");

        // Função para resetar a lista e mostrar apenas os 4 primeiros produtos e ofertas
        function resetProducts() {
            gruposProdutos.forEach((produto, index) => {
                produto.style.display = index < 4 ? "block" : "none"; // Mostra apenas os 4 primeiros
            });

            gruposOfertas.forEach((produto, index) => {
                produto.style.display = index < 4 ? "block" : "none"; // Mostra apenas os 4 primeiros
            });

            // Reexibir os títulos corretamente ao limpar a pesquisa
            tituloDestaques.forEach(titulo => titulo.style.display = "block");
            tituloOfertas.forEach(titulo => titulo.style.display = "block");
        }

        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.toLowerCase().trim(); // Normaliza o termo de busca
            const isSearching = searchTerm.length > 0; // Verifica se há texto digitado

            let visibleProductCount = 0;
            let visibleOfferCount = 0;

            // Função para filtrar e exibir no máximo 4 itens correspondentes à busca
            function filterItems(items) {
                let count = 0;
                items.forEach(item => {
                    const name = item.querySelector("p").textContent.toLowerCase(); // Nome do produto ou oferta
                    if (name.includes(searchTerm)) {
                        item.style.display = "block";
                        count ++;
                    } else {
                        item.style.display = "none";
                    }
                });
                return count > 0; // Retorna verdadeiro se houver ao menos um item visível
            }

            // Aplica a busca nos produtos e ofertas
            const hasProducts = filterItems(gruposProdutos);
            const hasOffers = filterItems(gruposOfertas);

            if (!isSearching) {
                resetProducts(); // Volta para exibir apenas os 4 primeiros ao limpar a busca
            }

            // Oculta os botões "Ver Mais" e "Ofertas" durante a busca
            if (btnVerMais) btnVerMais.style.display = isSearching ? "none" : "block";
            if (btnOfertas) btnOfertas.style.display = isSearching ? "none" : "block";

            // Oculta os títulos se não houver produtos ou ofertas visíveis
            tituloDestaques.forEach(titulo => titulo.style.display = hasProducts ? "block" : "none");
            tituloOfertas.forEach(titulo => titulo.style.display = hasOffers ? "block" : "none");

            // Ajusta a margem do título "Ofertas" caso não haja produtos
            tituloOfertas.forEach(titulo => {
                titulo.style.marginTop = !hasProducts && hasOffers ? "0px" : "30px";
            });
        });

        resetProducts(); // Garante que ao carregar a página apenas os 4 primeiros produtos aparecem
    }
}


