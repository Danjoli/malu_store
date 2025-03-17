// Função para carregar o footer dinamicamente
document.addEventListener("DOMContentLoaded", function () {
    fetch("../paginas/footer.html")
        .then(response => response.text()) // Converte a resposta para texto
        .then(data => {
            document.getElementById("footer-container").innerHTML = data;
        })
        .catch(error => console.error("Erro ao carregar o footer:", error));
});
