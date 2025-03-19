document.addEventListener("DOMContentLoaded", function () {
    const caminhosBase = ["frontend/imagens/", "../imagens/"]; // Caminhos possíveis para as imagens
    const caminhosLinks = ["frontend/paginas/", "../paginas/"]; // Caminhos possíveis para os links

    function criarFooter() {
        // Cria a estrutura do footer
        const footer = document.createElement("footer");

        // Links do footer
        const footerLinks = document.createElement("div");
        footerLinks.className = "footer-links";
        footerLinks.innerHTML = `
            <a href="frontend/paginas/sobre-nos.html" target="_self" class="dynamic-path">Sobre nós</a>
            <a href="frontend/paginas/politica-de-privacidade.html" target="_self" class="dynamic-path">Política de privacidade</a>
            <a href="frontend/paginas/termos-condicoes.html" target="_self" class="dynamic-path">Termos e condições</a>
        `;
        footer.appendChild(footerLinks);

        // Redes sociais
        const socialMedia = document.createElement("div");
        socialMedia.className = "social-media";
        socialMedia.innerHTML = `
            <a href="https://www.instagram.com/malu_storemodafemina/" target="_blank">
                <img src="frontend/imagens/icon-instagram.png" alt="Ícone do Instagram" class="dynamic-img">
            </a>
            <a href="https://wa.me/5511954598885" target="_blank">
                <img src="frontend/imagens/icon-whatsapp.png" alt="Ícone do WhatsApp" class="dynamic-img">
            </a>
            <a href="https://www.facebook.com/profile.php?id=61574456004558" target="_blank">
                <img src="frontend/imagens/icon-facebook.png" alt="Ícone do Facebook" class="dynamic-img">
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
        
        // Ajusta os caminhos das imagens e dos links
        ajustarCaminhos(0); // Ajusta os caminhos com o primeiro caminho da lista de imagens
        ajustarLinks(); // Ajusta os caminhos dos links dependendo de onde estamos (index ou dentro de paginas)
    }

    // Função para ajustar os caminhos das imagens
    function ajustarCaminhos(index) {
        if (index >= caminhosBase.length) {
            console.error("Erro ao ajustar os caminhos das imagens: Nenhuma opção válida.");
            return;
        }

        // Verifica a validade do caminho da imagem (usando uma imagem de teste)
        const testeUrl = caminhosBase[index] + "icon-instagram.png";
        fetch(testeUrl, { method: 'HEAD' })
            .then(response => {
                if (!response.ok) throw new Error("Caminho inválido");

                // Ajusta as imagens com a classe .dynamic-img
                document.querySelectorAll(".dynamic-img").forEach(img => {
                    img.src = img.src.replace(/(frontend\/imagens\/|..\/imagens\/)/, caminhosBase[index]);
                });

                console.log(`Caminho ajustado para as imagens: ${caminhosBase[index]}`);
            })
            .catch(() => ajustarCaminhos(index + 1)); // Tenta o próximo caminho se o atual falhar
    }

    // Função para ajustar os caminhos dos links dependendo de onde estamos
    function ajustarLinks() {
        // Detecta se estamos no index ou em uma página dentro da pasta "paginas"
        const isIndexPage = window.location.pathname.indexOf('index.html') !== -1;

        // Ajusta os links com a classe .dynamic-path
        document.querySelectorAll(".dynamic-path").forEach(link => {
            const currentHref = link.getAttribute("href");
            const adjustedHref = isIndexPage 
                ? currentHref.replace("frontend/paginas/", "frontend/paginas/") 
                : currentHref.replace("frontend/paginas/", "../paginas/");
            link.setAttribute("href", adjustedHref);
        });

        console.log(`Caminho ajustado para os links`);
    }

    // Inicia a criação do footer
    criarFooter();
});
