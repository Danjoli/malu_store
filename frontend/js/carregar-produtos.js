async function carregarProdutos() {
    try {
        const response = await fetch("../produtos.json");
        if (!response.ok) {
            throw new Error("Erro ao carregar os produtos");
        }

        const produtos = await response.json();
        const container = document.getElementById("produtos");
        if (!container) return;

        produtos.forEach((produto) => {
            const div = document.createElement("div");
            div.classList.add("product");

            div.innerHTML = `
                <a href="../paginas/compra.html?id=${produto.id}">
                    <img src="${produto.imagem}" alt="${produto.nome}">
                    <div class="descrição-card">
                        <p>${produto.nome}</p>
                        <span>${produto.preco}</span>
                    </div>
                </a>
            `;

            container.appendChild(div);
        });

        // Dispara um evento para avisar que os produtos foram carregados
        window.dispatchEvent(new Event("produtosCarregados"));

    } catch (error) {
        console.error(error);
    }
}

document.addEventListener("DOMContentLoaded", carregarProdutos);
