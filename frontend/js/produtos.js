const produtos = [
    { id: 1, nome: "Produto 1", preco: "R$ 99,99", imagem: "../imagens/product01.jpg" },
    { id: 2, nome: "Produto 2", preco: "R$ 99,99", imagem: "../imagens/product02.jpg" },
    { id: 3, nome: "Produto 3", preco: "R$ 99,99", imagem: "../imagens/product03.jpg" },
    { id: 4, nome: "Produto 4", preco: "R$ 99,99", imagem: "../imagens/product04.jpg" },
    { id: 5, nome: "Produto 5", preco: "R$ 99,99", imagem: "../imagens/product05.jpg" },
    { id: 6, nome: "Produto 6", preco: "R$ 99,99", imagem: "../imagens/product06.jpg" },
    { id: 7, nome: "Produto 7", preco: "R$ 99,99", imagem: "../imagens/product07.jpg" },
    { id: 8, nome: "Produto 8", preco: "R$ 99,99", imagem: "../imagens/product08.jpg" },
    { id: 9, nome: "Produto 9", preco: "R$ 99,99", imagem: "../imagens/product09.jpg" },
    { id: 10, nome: "Produto 10", preco: "R$ 99,99", imagem: "../imagens/product10.jpg" },
    { id: 11, nome: "Produto 11", preco: "R$ 99,99", imagem: "../imagens/product11.jpg" },
    { id: 12, nome: "Produto 12", preco: "R$ 99,99", imagem: "../imagens/product12.jpg" },
    { id: 13, nome: "Produto 13", preco: "R$ 99,99", imagem: "../imagens/product13.jpg" },
    { id: 14, nome: "Produto 14", preco: "R$ 99,99", imagem: "../imagens/product14.jpg" },
    { id: 15, nome: "Produto 15", preco: "R$ 99,99", imagem: "../imagens/product15.jpg" },
    { id: 16, nome: "Produto 16", preco: "R$ 99,99", imagem: "../imagens/product16.jpg" },
]

function carregarProdutos() {
    const container = document.getElementById("produtos");
    if (!container) return;

    produtos.forEach((produtos, index) => {
        const div = document.createElement("div");
        div.classList.add("product");
        
        div.innerHTML = `
            <a href="../paginas/compra.html?id=${produtos.id}">
                <img src="${produtos.imagem}" alt="${produtos.nome}">
                <div class="descrição-card">
                    <p>${produtos.nome}</p>
                    <span>${produtos.preco}</span>
                </div>
            </a>
        `;
        container.appendChild(div);
    });
}

// Chama a função ao carregar a página
document.addEventListener("DOMContentLoaded", carregarProdutos);