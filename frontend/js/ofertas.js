const ofertas = [
    { id: 17, nome: "Oferta 1", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer01.jpg" },
    { id: 18, nome: "Oferta 2", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer02.jpg" },
    { id: 19, nome: "Oferta 3", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer03.jpg" },
    { id: 20, nome: "Oferta 4", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer04.jpg" },
    { id: 21, nome: "Oferta 5", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer05.jpg" },
    { id: 22, nome: "Oferta 6", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer06.jpg" },
    { id: 23, nome: "Oferta 7", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer07.jpg" },
    { id: 24, nome: "Oferta 8", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer08.jpg" },
    { id: 25, nome: "Oferta 9", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer09.jpg" },
    { id: 26, nome: "Oferta 10", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer10.jpg" },
    { id: 27, nome: "Oferta 11", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer11.jpg" },
    { id: 28, nome: "Oferta 12", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer12.jpg" },
    { id: 29, nome: "Oferta 13", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer13.jpg" },
    { id: 30, nome: "Oferta 14", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer14.jpg" },
    { id: 31, nome: "Oferta 15", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer15.jpg" },
    { id: 32, nome: "Oferta 16", precoAntigo: "R$ 150,00", preco: "R$ 100,00", imagem: "../imagens/offer16.jpg" },
]

function carregarOfertas() {
    const container = document.getElementById("offers");
    if (!container) return;

    ofertas.forEach(oferta => {
        const div = document.createElement("div");
        div.classList.add("offer");
        div.innerHTML = `
            <a href="../paginas/compra.html?id=${oferta.id}">
                <img src="${oferta.imagem}" alt="${oferta.nome}">
                <div class="descrição-card">
                    <p>${oferta.nome}</p>
                    <span><del>${oferta.precoAntigo}</del> ${oferta.preco}</span>
                </div>
            </a>
        `;
        container.appendChild(div);
    });
}

// Chama a função ao carregar a página
document.addEventListener("DOMContentLoaded", carregarOfertas);