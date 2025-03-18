let produtosCarregados = false;
let ofertasCarregadas = false;

window.addEventListener("produtosCarregados", () => {
    produtosCarregados = true;
    verificarCarregamento();
});

window.addEventListener("ofertasCarregados", () => {
    ofertasCarregadas = true;
    verificarCarregamento();
});

function verificarCarregamento() {
    if (produtosCarregados && ofertasCarregadas) {
        console.log("📦 Todos os produtos e ofertas foram carregados!");
        window.dispatchEvent(new Event("tudoCarregado")); // Evento único para quando tudo estiver pronto
    }
}
