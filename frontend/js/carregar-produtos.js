async function carregarProdutos() {
    try {
        const response = await fetch("frontend/produtos.json");
        if (!response.ok) {
            throw new Error("Erro ao carregar os produtos");
        }

        const produtos = await response.json();

        // Garantir que os containers existam antes de tentar adicionar produtos a eles
        const containerProdutos = document.getElementById("produtos");
        const containerOfertas = document.getElementById("offers");

        if (!containerProdutos || !containerOfertas) return;

        produtos.forEach((produto) => {
            if (!produto.precoAntigo) {
                // Produto normal
                const div = document.createElement("div");
                div.classList.add("product");

                div.innerHTML = `
                    <a href="frontend/paginas/compra.html?id=${produto.id}">
                        <img src="${produto.imagem}" alt="${produto.nome}">
                        <div class="descrição-card">
                            <p>${produto.nome}</p>
                            <span>${produto.preco}</span>
                        </div>
                    </a>
                `;

                containerProdutos.appendChild(div);
            } else {
                // Produto com oferta (com precoAntigo)
                const div = document.createElement("div");
                div.classList.add("offer");

                div.innerHTML = `
                    <a href="frontend/paginas/compra.html?id=${produto.id}">
                        <img src="${produto.imagem}" alt="${produto.nome}">
                        <div class="descrição-card">
                            <p>${produto.nome}</p>
                            <span><del>${produto.precoAntigo}</del> ${produto.preco}</span>
                        </div>
                    </a>
                `;

                containerOfertas.appendChild(div);
            }
        });

        // Dispara um evento para avisar que os produtos foram carregados
        window.dispatchEvent(new Event("produtosCarregados"));

    } catch (error) {
        console.error(error);
    }
}

document.addEventListener("DOMContentLoaded", carregarProdutos);
