// Pega o parâmetro 'id' da URL
const urlParams = new URLSearchParams(window.location.search);
const ofertaId = urlParams.get('id');

// Aqui, você pode fazer uma requisição para buscar os detalhes do produto
// No exemplo abaixo, estou usando dados fictícios para ilustrar

const ofertas = [
    { id: 17, nome: "Oferta 1", descricao: "Descrição da Oferta 1", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer01.jpg" },
    { id: 18, nome: "Oferta 2", descricao: "Descrição da Oferta 2", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer02.jpg" },
    { id: 19, nome: "Oferta 3", descricao: "Descrição da Oferta 3", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer03.jpg" },
    { id: 20, nome: "Oferta 4", descricao: "Descrição da Oferta 4", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer04.jpg" },
    { id: 21, nome: "Oferta 5", descricao: "Descrição da Oferta 5", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer05.jpg" },
    { id: 22, nome: "Oferta 6", descricao: "Descrição da Oferta 6", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer06.jpg" },
    { id: 23, nome: "Oferta 7", descricao: "Descrição da Oferta 7", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer07.jpg" },
    { id: 24, nome: "Oferta 8", descricao: "Descrição da Oferta 8", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer08.jpg" },
    { id: 25, nome: "Oferta 9", descricao: "Descrição da Oferta 9", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer09.jpg" },
    { id: 26, nome: "Oferta 10", descricao: "Descrição da Oferta 10", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer10.jpg" },
    { id: 27, nome: "Oferta 11", descricao: "Descrição da Oferta 11", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer11.jpg" },
    { id: 28, nome: "Oferta 12", descricao: "Descrição da Oferta 12", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer12.jpg" },
    { id: 29, nome: "Oferta 13", descricao: "Descrição da Oferta 13", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer13.jpg" },
    { id: 30, nome: "Oferta 14", descricao: "Descrição da Oferta 14", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer14.jpg" },
    { id: 31, nome: "Oferta 15", descricao: "Descrição da Oferta 15", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer15.jpg" },
    { id: 32, nome: "Oferta 16", descricao: "Descrição da Oferta 15", preco: "R$ 150,00", precoOferta: "R$ 100,00", imagem: "../imagens/offer16.jpg" },
]


// Buscar o produto pelo ID
const oferta = ofertas.find(p => p.id == ofertaId);

if (oferta) {
    document.getElementById('oferta-img').src = oferta.imagem;
    document.getElementById('oferta-nome').innerText = oferta.nome;
    document.getElementById('produto-descricao').innerText = oferta.descricao;
    document.getElementById('oferta-preco-antigo').innerText = oferta.preco;
    document.getElementById('oferta-preco-novo').innerText = oferta.precoOferta;
} else {
    document.querySelector('.produto-detalhes').innerHTML = "<h2>Produto não encontrado</h2>";
}