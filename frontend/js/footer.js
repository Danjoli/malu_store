document.addEventListener("DOMContentLoaded", function () {
    const caminhosBase = ["frontend/imagens/", "../imagens/"]; // Caminhos possíveis para as imagens

    function criarFooter() {
        // Cria a estrutura do footer
        const footer = document.createElement("footer");

        // Links do footer
        const footerLinks = document.createElement("div");
        footerLinks.className = "footer-links";
        footerLinks.innerHTML = `
            <a href="frontend/paginas/sobre=nós.html" target="_self" class="dynamic-path">Sobre nós</a>
            <a href="frontend/paginas/poilitica-de-privacidade.html" target="_self" class="dynamic-path">Política de privacidade</a>
            <a href="frontend/paginas/termos-condições.html" target="_self" class="dynamic-path">Termos e condições</a>
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
        
        // Ajusta os caminhos após a criação do footer
        ajustarCaminhos(0); // Ajusta os caminhos com o primeiro caminho da lista
    }

    // Função para ajustar os caminhos das imagens
    function ajustarCaminhos(index) {
        if (index >= caminhosBase.length) {
            console.error("Erro ao ajustar os caminhos: Nenhuma opção válida.");
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

                console.log(`Caminho ajustado para: ${caminhosBase[index]}`);
            })
            .catch(() => ajustarCaminhos(index + 1)); // Tenta o próximo caminho se o atual falhar
    }

    // Inicia a criação do footer
    criarFooter();
});
