
function editarEntrega(data, nome, numero, bloco, status) {
    document.getElementById('').value = data;
    document.getElementById('').value = nome;
    document.getElementById('').value = numero;
    document.getElementById('').value = bloco;
    document.getElementById('').value = status;
    document.getElementById('editar_entrega').style.display = 'block';

}

function excluirEntrega(data, nome, numero, bloco, status) {
    document.getElementById('').value = data;
    document.getElementById('').value = nome;
    document.getElementById('').value = numero;
    document.getElementById('').value = bloco;
    document.getElementById('').value = status;
    document.getElementById('excluir_entrega').style.display = 'block';

}

function editarMorador(cpf, nome, tel, email, numero, bloco) {
    document.getElementById('cpf').value = cpf;
    document.getElementById('tel').value = tel;
    document.getElementById('nome').value = nome;
    document.getElementById('email').value = email;
    document.getElementById('num_apart').value = numero;
    document.getElementById('bloco_quadra').value = bloco;
    document.getElementById('editar_morador').style.display = 'block';

}

function excluirMorador(cpf, nome, tel, email, numero, bloco) {
    document.getElementById('txtcpf').value = cpf;
    document.getElementById('txttel').value = tel;
    document.getElementById('txtnome').value = nome;
    document.getElementById('txtemail').value = email;
    document.getElementById('numapart').value = numero;
    document.getElementById('txtbloco').value = bloco;
    document.getElementById('excluir_morador').style.display = 'block';

}

function editarPropriedade(id, num_propriedade, bloco) {
    document.getElementById('txtCodigo').value = id;
    document.getElementById('txtNumero').value = num_propriedade;
    document.getElementById('txtBloco').value = bloco;
    document.getElementById('editar_propriedade').style.display = 'block';
}

function excluirPropriedade(id, num_propriedade, bloco) {
    document.getElementById('codigo').value = id;
    document.getElementById('numero').value = num_propriedade;
    document.getElementById('bloco').value = bloco;
    document.getElementById('excluir_propriedade').style.display = 'block';

}
function editarUsuario(id, nome, login, privilegio) {
    document.getElementById('id_user').value = id;
    document.getElementById('nome_user').value = nome;
    document.getElementById('login_user').value = login;
    document.getElementById('privilegio_user').value = privilegio;
    document.getElementById('editar_usuario').style.display = 'block';

}
function excluirUsuario(id, nome, login, privilegio) {
    document.getElementById('user').value = id;
    document.getElementById('nome_usuario').value = nome;
    document.getElementById('login').value = login;
    document.getElementById('privilegio').value = privilegio;
    document.getElementById('excluir_usuario').style.display = 'block';

}
function detalhesEntrega (dt_recebido,recebido_por,destinatario,status) {
    document.getElementById('dt_receb').value = dt_recebido;
    document.getElementById('recebido').value = recebido_por;
    document.getElementById('destin').value = destinatario;
    document.getElementById('status_atual').value = status;
    document.getElementById('detalhes_entrega').style.display = 'block';

}

//função das abas do menus
function openMenu(evt, menuName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("menu");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
    }
    document.getElementById(menuName).style.display = "block";
    evt.currentTarget.className += " w3-red";
}
