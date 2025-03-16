// Pega o parâmetro 'id' da URL
const urlParams = new URLSearchParams(window.location.search);
const produtoId = urlParams.get('id');

// Aqui, você pode fazer uma requisição para buscar os detalhes do produto
// No exemplo abaixo, estou usando dados fictícios para ilustrar

const produtos = [
    { id: 1, nome: "Produto 1", descricao: "Descrição do Produto 1", preco: "R$ 99,99", imagem: "../imagens/product01.jpg" },
    { id: 2, nome: "Produto 2", descricao: "Descrição do Produto 2", preco: "R$ 99,99", imagem: "../imagens/product02.jpg" },
    { id: 3, nome: "Produto 3", descricao: "Descrição do Produto 3", preco: "R$ 99,99", imagem: "../imagens/product03.jpg" },
    { id: 4, nome: "Produto 4", descricao: "Descrição do Produto 4", preco: "R$ 99,99", imagem: "../imagens/product04.jpg" },
    { id: 5, nome: "Produto 5", descricao: "Descrição do Produto 5", preco: "R$ 99,99", imagem: "../imagens/product05.jpg" },
    { id: 6, nome: "Produto 6", descricao: "Descrição do Produto 6", preco: "R$ 99,99", imagem: "../imagens/product06.jpg" },
    { id: 7, nome: "Produto 7", descricao: "Descrição do Produto 7", preco: "R$ 99,99", imagem: "../imagens/product07.jpg" },
    { id: 8, nome: "Produto 8", descricao: "Descrição do Produto 8", preco: "R$ 99,99", imagem: "../imagens/product08.jpg" },
    { id: 9, nome: "Produto 9", descricao: "Descrição do Produto 9", preco: "R$ 99,99", imagem: "../imagens/product09.jpg" },
    { id: 10, nome: "Produto 10", descricao: "Descrição do Produto 10", preco: "R$ 99,99", imagem: "../imagens/product10.jpg" },
    { id: 11, nome: "Produto 11", descricao: "Descrição do Produto 11", preco: "R$ 99,99", imagem: "../imagens/product11.jpg" },
    { id: 12, nome: "Produto 12", descricao: "Descrição do Produto 12", preco: "R$ 99,99", imagem: "../imagens/product12.jpg" },
    { id: 13, nome: "Produto 13", descricao: "Descrição do Produto 13", preco: "R$ 99,99", imagem: "../imagens/product13.jpg" },
    { id: 14, nome: "Produto 14", descricao: "Descrição do Produto 14", preco: "R$ 99,99", imagem: "../imagens/product14.jpg" },
    { id: 15, nome: "Produto 15", descricao: "Descrição do Produto 15", preco: "R$ 99,99", imagem: "../imagens/product15.jpg" },
    { id: 16, nome: "Produto 16", descricao: "Descrição do Produto 15", preco: "R$ 99,99", imagem: "../imagens/product16.jpg" },
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









