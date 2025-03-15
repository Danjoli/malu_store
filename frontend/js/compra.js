// Pega o parâmetro 'id' da URL
const urlParams = new URLSearchParams(window.location.search);
const produtoId = urlParams.get('id');

// Aqui, você pode fazer uma requisição para buscar os detalhes do produto
// No exemplo abaixo, estou usando dados fictícios para ilustrar

const produtos = [
    { id: 1, nome: "Produto 1", descricao: "Descrição do Produto 1", preco: "R$ 99,99", imagem: "imagens/product01.jpg" },
    { id: 2, nome: "Produto 2", descricao: "Descrição do Produto 2", preco: "R$ 99,99", imagem: "../imagens/product02.jpg" },
    { id: 3, nome: "Produto 3", descricao: "Descrição do Produto 3", preco: "R$ 99,99", imagem: "imagens/product03.jpg" },
    { id: 4, nome: "Produto 4", descricao: "Descrição do Produto 4", preco: "R$ 99,99", imagem: "imagens/product04.jpg" },
    // ... outros produtos
];

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