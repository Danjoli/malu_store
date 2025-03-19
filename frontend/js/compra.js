// Pega o parâmetro 'id' da URL
const urlParams = new URLSearchParams(window.location.search);
const produtoId = urlParams.get('id');

// Aqui, você pode fazer uma requisição para buscar os detalhes do produto
// No exemplo abaixo, estou usando dados fictícios para ilustrar

fetch('../produtos.json')
    .then(response => response.json())  // Converte a resposta para JSON
    .then(produtos => {
        // Buscar o produto pelo ID
        const produto = produtos.find(p => p.id == produtoId);
        // Ajusta o caminho da imagem, removendo "frontend/" se existir
        const caminhoImagemCorrigido = produto.imagem.replace("frontend/", "../");
        if (!produto.precoAntigo){
            if (produto) {
                // Atualiza os elementos na página
                document.getElementById('produto-img').src = caminhoImagemCorrigido;
                document.getElementById('produto-nome').innerText = produto.nome;
                document.getElementById('produto-descricao').innerText = produto.descricao;
                document.getElementById('produto-preco-atual').innerText = produto.preco;
            } else {
                document.querySelector('.produto-detalhes').innerHTML = "<h2>Produto não encontrado</h2>";
            }
        } else {
            if (produto) {
                // Atualiza os elementos na página
                document.getElementById('produto-img').src = caminhoImagemCorrigido;;
                document.getElementById('produto-nome').innerText = produto.nome;
                document.getElementById('produto-descricao').innerText = produto.descricao;
                document.getElementById('produto-preco-antigo').innerText = produto.precoAntigo;
                document.getElementById('produto-preco-atual').innerText = produto.preco;
            } else {
                document.querySelector('.produto-detalhes').innerHTML = "<h2>Oferta não encontrado</h2>";
            }
        }
    })
    .catch(error => console.error('Erro ao carregar os produtos:', error));







