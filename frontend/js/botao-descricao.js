document.addEventListener("DOMContentLoaded", function () {
    const btnDescricao = document.getElementById("btnDescricao");
    const descricaoTexto = document.getElementById("produto-descricao");

    btnDescricao.addEventListener("click", function () {
        if (descricaoTexto.style.display === "none" || descricaoTexto.style.display === "") {
            descricaoTexto.style.display = "block";  // Exibe a descrição
            btnDescricao.textContent = "-";          // Muda o botão para "-"
        } else {
            descricaoTexto.style.display = "none"    // Oculta a descrição
            btnDescricao.textContent = "+";          // Muda o botão para "+"
        }
    })
})
