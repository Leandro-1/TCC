$(document).ready(function () {

    // Submeter o formulário via AJAX
    $('#myForm_alterar_senha').submit(function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Envia os dados do formulário usando jQuery AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Obtém a URL do atributo action do formulário
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function (response) {
                $('.feedbackMessage').html(response).show();

                // Oculta a mensagem após 3 segundos
                setTimeout(function () {
                    $('.feedbackMessage').hide();
                }, 3000);

                // Opcional: Limpar o formulário após o envio
                $('#myForm_alterar_senha')[0].reset();
            },
            error: function () {
                $('.feedbackMessage').html('Ocorreu um erro ao processar o formulário.').show();
            }
        });
    });

});


//função para mostrar a mensagem nas caixas de cadastros(entega,moradores,usuarios e propriedade)
$(document).ready(function () {

    function processarFormularioCadastro(idForm) {
        // Submeter o formulário via AJAX
        $(idForm).submit(function (event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Envia os dados do formulário usando jQuery AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Obtém a URL do atributo action do formulário
                data: $(this).serialize(), // Serializa os dados do formulário
                success: function (response) {
                    $('.feedbackMessage').html(response).show();

                    // Oculta a mensagem após 3 segundos
                    setTimeout(function () {
                        $('.feedbackMessage').hide();
                    }, 3000);

                    // Opcional: Limpar o formulário após o envio
                    $(idForm)[0].reset();
                },
                error: function () {
                    $('.feedbackMessage').html('Ocorreu um erro ao processar o formulário.').show();
                }
            });
        });
    }
    processarFormularioCadastro('#myForm_entrega');
    processarFormularioCadastro('#myForm_morador');
    processarFormularioCadastro('#myForm_usuario');
    processarFormularioCadastro('#myForm_propriedade');

});

//função para mostrar mensagem nas demais caixas, com a diferença que a caixa fecha depois da mensagem
$(document).ready(function () {

    function processarForm_Fechar(idForm, idModal) {
        // Submeter o formulário via AJAX
        $(idForm).submit(function (event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Envia os dados do formulário usando jQuery AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Obtém a URL do atributo action do formulário
                data: $(this).serialize(), // Serializa os dados do formulário
                success: function (response) {
                    $('.feedbackMessage').html(response).show();

                    // Oculta a mensagem após 3 segundos
                    setTimeout(function () {
                        $(idModal).hide();
                        $('.feedbackMessage').hide();
                    }, 3000);
                },
                error: function () {
                    $('.feedbackMessage').html('Ocorreu um erro ao processar o formulário.').show();
                }
            });
        });
    }

    processarForm_Fechar('#form_excluir_entrega', '#excluir_entrega');
    processarForm_Fechar('#form_excluir_morador', '#excluir_morador');
    processarForm_Fechar('#form_excluir_usuario', '#excluir_usuario');
    processarForm_Fechar('#form_editar_entrega', '#editar_entrega');
    processarForm_Fechar('#form_editar_morador', '#editar_morador');
    processarForm_Fechar('#form_editar_usuario', '#editar_usuario');
    processarForm_Fechar('#form_editar_propriedade', '#editar_propriedade');
    processarForm_Fechar('#form_status', '#modal_status');
    


    $('.close-modal').click(function () {
        var idModal = $(this).data('modal');
        $(idModal).hide();
    });
});

function modalStatus(id, status, numPropriedade, blocoQuadra) {
    document.getElementById('entregaID').value = id;
    document.getElementById('status_atualizar').value = status;
    document.getElementById('propriedade_status').value = `${numPropriedade} - ${blocoQuadra}`;
    document.getElementById('modal_status').style.display = 'block';
}
function editarEntrega(id, data, tipo, nome, propriedade, status, data_retirada) {
    document.getElementById('id_entrega').value = id;
    document.getElementById('data_recebimento').value = data;
    document.getElementById('tipo').value = tipo;
    document.getElementById('destinatario').value = nome;
    document.getElementById('propriedade').value = propriedade; // Atualiza a propriedade
    document.getElementById('status').value = status;
    document.getElementById('data_retirada').value = data_retirada; // Preenche a data de retirada

    // Exibe o modal de edição
    document.getElementById('editar_entrega').style.display = 'block';
}



function excluirEntrega(id, data, tipo, nome, numero, bloco, status) {
    document.getElementById('cod_entrega').value = id;
    document.getElementById('data_receb').value = data;
    document.getElementById('tipo_entrega').value = tipo;
    document.getElementById('destinatario_entrega').value = nome;
    document.getElementById('apartamento_').value = `${numero} - ${bloco}`;
    document.getElementById('status_entrega').value = status;
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
function detalhesEntrega(dt_recebido, recebido_por, destinatario, status) {
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
        x[i].style.display = "none"; // Esconde todas as abas
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); // Remove a classe "ativa"
    }
    document.getElementById(menuName).style.display = "block"; // Mostra a aba ativa
    evt.currentTarget.className += " w3-red"; // Adiciona a classe "ativa" à aba clicada
}

