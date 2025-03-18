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

        if (produto) {
            document.getElementById('produto-img').src = produto.imagem;
            document.getElementById('produto-nome').innerText = produto.nome;
            document.getElementById('produto-descricao').innerText = produto.descricao;
            document.getElementById('produto-preco').innerText = produto.preco;
        } else {
            document.querySelector('.produto-detalhes').innerHTML = "<h2>Produto não encontrado</h2>";
        }
    })
    .catch(error => console.error('Erro ao carregar os produtos:', error));







