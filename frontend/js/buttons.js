document.addEventListener("DOMContentLoaded", function () {
    const gruposProdutos = document.querySelectorAll(".product"); // Todos os produtos
    const btnVerMais = document.getElementById("verMais");
    const gruposOfertas = document.querySelectorAll(".offer"); // Seleciona todos as ofertas
    const btnOfertas = document.getElementById("ofertas");
    
    // Função para resetar a lista e mostrar apenas os 4 primeiros produtos
    function resetProducts() {
        gruposProdutos.forEach((produto, index) => {
            // produto.style.display = index < 4 ? "block" : "none"; // Mostra apenas os 4 primeiros
            if (index < 4) {;
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
            // produto.style.display = index < 4 ? "block" : "none"; // Mostra apenas os 4 primeiros
            if (index < 4) {;
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

    // Função para mostrar todos os produtos com animação
    function mostrarProdutos() {
        gruposProdutos.forEach((produto, index) => {
            setTimeout(() => {
                produto.style.display = "block";
            }, index * 125); // Atraso progressivo para cada elemento
        });
    }

    // Função para mostrar todas as ofertas com animação
    function mostrarOfertas() {
        gruposOfertas.forEach((oferta, index) => {
            setTimeout(() => {
                oferta.style.display = "block";
            }, index * 125); // Atraso progressivo para cada elemento
        });
    }


    // Evento de clique para alternar entre mostrar mais e menos produtos
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
});