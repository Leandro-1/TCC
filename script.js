function exibirModal(mensagem) {
    const mensagemModal = document.getElementById('mensagemModal');
    const myModal = document.getElementById('myModal');
    mensagemModal.textContent = mensagem;
    myModal.style.display = 'block';
}

// Função para fechar o modal
function fecharModal() {
    document.getElementById('myModal').style.display = 'none';
}