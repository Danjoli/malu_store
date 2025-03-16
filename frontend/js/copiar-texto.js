function copyToClipboard(id) {
    const text = document.getElementById(id).textContent;
    navigator.clipboard.writeText(text).then(() => {
        alert("Copiado: " + text);
    }).catch(err => {
        console.error("Erro ao copiar: ", err)
    })
}