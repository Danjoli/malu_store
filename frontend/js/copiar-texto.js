function copyToClipboard(element) {
    const text = element.textContent.split(": ")[1];  // Remove "Email:" ou "Telefone:"

    if (!text) {
        console.error("Nenhum texto encontrado para copiar.")
        return;
    }

    navigator.clipboard.writeText(text).then(() => {
        alert(`Erro ao copiar: ${text}`);
    }).catch(err => {
        console.error("Erro ao copiar: ", err);
    });
}