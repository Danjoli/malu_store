document.addEventListener("DOMContentLoaded", function () {
    function criarFooter() {
        const footer = document.createElement("footer");

        // Detecta se a URL contém "/malu_store/" e ajusta os caminhos
        const basePath = window.location.pathname.includes("/malu_store/") 
            ? "/malu_store/frontend/" 
            : "/frontend/";

        // Links do footer
        const footerLinks = document.createElement("div");
        footerLinks.className = "footer-links";
        footerLinks.innerHTML = `
            <a href="${basePath}paginas/sobre-nos.html" target="_self">Sobre nós</a>
            <a href="${basePath}paginas/politica-de-privacidade.html" target="_self">Política de privacidade</a>
            <a href="${basePath}paginas/termos-condicoes.html" target="_self">Termos e condições</a>
        `;
        footer.appendChild(footerLinks);

        // Redes sociais
        const socialMedia = document.createElement("div");
        socialMedia.className = "social-media";
        socialMedia.innerHTML = `
            <a href="https://www.instagram.com/malu_storemodafemina/" target="_blank">
                <img src="${basePath}imagens/icon-instagram.png" alt="Ícone do Instagram">
            </a>
            <a href="https://wa.me/5511954598885" target="_blank">
                <img src="${basePath}imagens/icon-whatsapp.png" alt="Ícone do WhatsApp">
            </a>
            <a href="https://www.facebook.com/profile.php?id=61574456004558" target="_blank">
                <img src="${basePath}imagens/icon-facebook.png" alt="Ícone do Facebook">
            </a>
        `;
        footer.appendChild(socialMedia);

        // Informações de contato
        const contactInfo = document.createElement("div");
        contactInfo.className = "contact-info";
        contactInfo.id = "contato";
        contactInfo.innerHTML = `
            <p onclick="copyToClipboard(this)">Email: elienealvesdelima5@gmail.com</p>
            <p onclick="copyToClipboard(this)">Telefone: (11) 95459-8885</p>
        `;
        footer.appendChild(contactInfo);

        // Adiciona o footer ao container
        document.getElementById("footer-container").appendChild(footer);
    }

    // Função para copiar texto ao clicar
    function copyToClipboard(element) {
        const text = element.textContent.replace("Email: ", "").replace("Telefone: ", "");
        navigator.clipboard.writeText(text).then(() => {
            alert(`Copiado: ${text}`);
        }).catch(err => console.error("Erro ao copiar", err));
    }

    criarFooter();
});

