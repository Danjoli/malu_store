document.addEventListener("DOMContentLoaded", function() {
    const btnVerMais = document.getElementById("verMais"); 
    const gruposProdutos = document.querySelectorAll(".product"); // Seleciona todos os grupos
    const btnOfertas = document.getElementById("ofertas");
    const gruposOfertas = document.querySelectorAll(".offer"); // Seleciona todos as ofertas

    // Função para animar a entrada dos elementos
    function animarEntrada(elementos) {
        let delay = 0
        elementos.forEach((grupo, index) => {
            if (index > 3) {
                grupo.style.display = "block"  // Torna o elemento visível
                grupo.style.opacity = 0;    // Inicia a opacidade em 0
                grupo.style.transform = "translateY(20px)"; // Inicia com o elemento deslocado

                // Forncendo uma pequena transição para cada elemento
                grupo.style.transition = `opacity 0.5s ease ${delay}s, transform 0.5 ease ${delay}s`;

                setTimeout(() => {
                    grupo.style.opacity = 1;    // Aumeta a opacidade
                    grupo.style.transform = "translateY(0)"; // Retorna ao estado original
                }, delay * 1500);  // Atraso baseado no índice do elemento
                delay += 0.3; // Atraso progressivo para cada elemento
            }
        });
    }

    // Função para animar a saida dos elementos
    function animarSaida(elementos) {
        let delay = 0
        elementos.forEach((grupo, index) => {
            if (index > 3) {
                grupo.style.transition = `opacity 0.5s ease ${delay}s, transform 0.5 ease ${delay}s`;
                grupo.style.opacity = 0;    // Torna a opacidade 0
                grupo.style.transform = "translateY(-20px)"; // Desloca o elemento para cima
            
            setTimeout(() => {
                grupo.style.display = "none"  // Esconde o elemento após a animação
                grupo.style.transform = "translateY(0)"; // Retorna ao estado original
            }, delay * 1000);  // Esconde após a animação
            }
        });
    }

    // Controle do botão "Ver Mais"
    btnVerMais.addEventListener("click", function () {
        if (btnVerMais.textContent == "Ver mais") {
            // Exibe todos os produtos com animação
            animarEntrada(gruposProdutos);

            // Altera o texto do botão para "Voltar"
            btnVerMais.textContent = "Voltar"; // Exibe todos os produtos com animação
        } else {
            // Esconde os produtos
            animarSaida(gruposProdutos);

            // Altera o texto do botão de volta para "Ver mais"
            btnVerMais.textContent = "Ver mais";
        }
    });

    // Controle do botão "Aproveite agora"
    btnOfertas.addEventListener("click", function () {
        if (btnOfertas.textContent == "Aproveite agora") {
            // Exibe todas as ofertas com animação
            animarEntrada(gruposOfertas)

            // Altera o texto do botão para "Voltar"
            btnOfertas.textContent = "Voltar";
        } else {
            // Esconde as ofertas 
            animarSaida(gruposOfertas);
            gruposOfertas.forEach(grupo => grupo.classList.add("hidden"));

            // Altera o texto do botão de volta para "Ver mais"
            btnOfertas.textContent = "Aproveite agora";
        }
    });
});

