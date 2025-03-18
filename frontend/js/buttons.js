window.addEventListener("produtosCarregados", () => {
    console.log("Tudo carregado! Iniciando buttons.js");
    iniciarButtons();
});

// Função para iniciar buttons.js apenas quando ambos os eventos forem disparados
function iniciarButtons() {
    const gruposProdutos = document.querySelectorAll(".product");
    const btnVerMais = document.getElementById("verMais");

    const gruposOfertas = document.querySelectorAll(".offer");
    const btnOfertas = document.getElementById("ofertas");

    function resetProducts() {
        gruposProdutos.forEach((produto, index) => {
            if (index < 4) {
                produto.style.display = "block";
            } else {
                produto.classList.add("fade-out");
                setTimeout(() => {
                    produto.style.display = "none";
                    produto.classList.remove("fade-out");
                }, 500);
            }
        });

        gruposOfertas.forEach((oferta, index) => {
            if (index < 4) {
                oferta.style.display = "block";
            } else {
                oferta.classList.add("fade-out");
                setTimeout(() => {
                    oferta.style.display = "none";
                    oferta.classList.remove("fade-out");
                }, 500);
            }
        });
    }

    function mostrarProdutos() {
        gruposProdutos.forEach((produto, index) => {
            setTimeout(() => {
                produto.style.display = "block";
            }, index * 125);
        });
    }

    function mostrarOfertas() {
        gruposOfertas.forEach((oferta, index) => {
            setTimeout(() => {
                oferta.style.display = "block";
            }, index * 125);
        });
    }

    btnVerMais.addEventListener("click", function () {
        if (btnVerMais.textContent === "Ver mais") {
            mostrarProdutos();
            btnVerMais.textContent = "Voltar";
        } else {
            resetProducts();
            btnVerMais.textContent = "Ver mais";
        }
    });

    btnOfertas.addEventListener("click", function () {
        if (btnOfertas.textContent === "Aproveite agora") {
            mostrarOfertas();
            btnOfertas.textContent = "Voltar";
        } else {
            resetProducts();
            btnOfertas.textContent = "Aproveite agora";
        }
    });

    resetProducts(); // Garante que ao carregar a página apenas os 4 primeiros produtos aparecem
};






