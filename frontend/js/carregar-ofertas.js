async function carregarOfertas() {
    try {
        const response = await fetch("../ofertas.json");
        if (!response.ok) {
            throw new Error("Erro ao carregar as ofertas");
        }

        const ofertas = await response.json();
        const container = document.getElementById("offers");
        if (!container) return;

        ofertas.forEach((oferta) => {  // Corrigindo para manter o nome "oferta"
            const div = document.createElement("div");
            div.classList.add("offer");

            div.innerHTML = `
                <a href="../paginas/compra-ofertas.html?id=${oferta.id}">
                    <img src="${oferta.imagem}" alt="${oferta.nome}">
                    <div class="descrição-card">
                        <p>${oferta.nome}</p>
                        <span><del>${oferta.precoAntigo}</del> ${oferta.preco}</span>
                    </div>
                </a>
            `;

            container.appendChild(div);
        });

        // Dispara um evento para avisar que as ofertas foram carregadas
        window.dispatchEvent(new Event("ofertasCarregados"));

    } catch (error) {
        console.error(error);
    }
}

// Garante que as ofertas são carregadas quando a página terminar de carregar
document.addEventListener("DOMContentLoaded", carregarOfertas);
