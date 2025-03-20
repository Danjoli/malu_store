document.addEventListener("DOMContentLoaded", function () {
    // Detecta se a URL contém "/malu_store/" e ajusta os caminhos
    const basePath = window.location.pathname.includes("/malu_store/") 
        ? "/malu_store/" 
        : "/";

    // Seleciona os links da navegação
    const links = document.querySelectorAll("header nav a");

    // Modifica os caminhos dinamicamente
    links.forEach(link => {
        if (link.getAttribute("href") === "/malu_store/index.html" || link.getAttribute("href") === "/index.html") {
            link.setAttribute("href", `${basePath}index.html`);
        }
    });
});
