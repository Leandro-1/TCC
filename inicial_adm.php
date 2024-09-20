<?php
//2 primeiras linhas: verificaçaõ unica de acesso para todos os usuario, chamando somente a funcao e colocando o tipo de usuario
//podendo assim excluir o arquivos 'verificar acesso adm e todos'
require_once('verificar_permissaoAcesso.php');
verificar_permissao('administrador');
require_once('cabecalho.php');
require_once('conexaoBD.php');

?>

<div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">

    <div class="w3-bar aba_menu">
        <div class="abas w3-blue-grey">
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'propriedades')"><b>Propriedades</b></button>
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'usuarios')"><b>Usuários</b></button>
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'moradores')"><b>Moradores</b></button>
            <button class="w3-bar-item w3-button tablink  w3-right w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
        </div>
    </div>

    <!--Aba de entregas -->
    <!-- Cadastro - Consulta - editar - excluir  -->
    <?php require_once('aba_entrega.php') ?>


    <!--Aba de MORADORES -->
    <!-- Cadastro - Consulta - editar - excluir  -->
    <?php require_once('aba_morador.php') ?>


    <!--Aba de usuários -->
    <!-- Cadastro - Consulta - editar - excluir  -->
    <?php require_once('aba_usuario.php') ?>


    <!--Aba de Propriedade -->
    <!-- Cadastro - Consulta - editar  -->
    <?php require_once('aba_propriedade.php') ?>

</div><br><br>

<?php require_once('rodape.php'); ?>