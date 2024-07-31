function exibirModal(mensagem) {
    document.getElementById('mensagemModal').textContent = mensagem;
    document.getElementById('myModal').style.display = 'block';
}

// Função para fechar o modal
function fecharModal() {
    document.getElementById('myModal').style.display = 'none';
}