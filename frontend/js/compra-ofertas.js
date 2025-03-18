// Pega o parâmetro 'id' da URL
const urlParams = new URLSearchParams(window.location.search);
const ofertaId = urlParams.get('id');

// Aqui, você pode fazer uma requisição para buscar os detalhes do produto
// No exemplo abaixo, estou usando dados fictícios para ilustrar

fetch('../ofertas.json')
    .then(response => response.json())  // Converte a resposta para JSON
    .then(ofertas => {
        // Buscar o produto pelo ID
        const oferta = ofertas.find(p => p.id == ofertaId);

        if (oferta) {
            document.getElementById('oferta-img').src = oferta.imagem;
            document.getElementById('oferta-nome').innerText = oferta.nome;
            document.getElementById('produto-descricao').innerText = oferta.descricao;
            document.getElementById('oferta-preco-antigo').innerText = oferta.precoAntigo;
            document.getElementById('oferta-preco-novo').innerText = oferta.preco;
        } else {
            document.querySelector('.oferta-detalhes').innerHTML = "<h2>Oferta não encontrado</h2>";
        }
    })
    .catch(error => console.error('Erro ao carregar os produtos:', error));