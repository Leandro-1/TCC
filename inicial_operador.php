<?php
//2 primeiras linhas: verificaçaõ unica de acesso para todos os usuario, chamando somente a funcao e colocando o tipo de usuario
//podendo assim excluir o arquivos 'verificar acesso adm e todos'
require_once('verificar_permissaoAcesso.php');
verificar_permissao('operador');
require_once('cabecalho.php');
require_once('conexaoBD.php');
?>

<div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">

    <div class="w3-bar aba_menu">
        <div class="abas w3-blue-grey">
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'propriedades')"><b>Propriedades</b></button>
            <button class="w3-bar-item w3-button tablink w3-right" onclick="openMenu(event,'moradores')"><b>Moradores</b></button>
            <button class="w3-bar-item w3-button tablink  w3-right w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
        </div>
    </div>

    <!--Aba de entregas: Cadastro, consulta, editar e excluir-->
    <?php require_once('aba_entrega.php'); ?>

    <!--Aba de MORADORES -->
    <div id="moradores" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Moradores</b></h2>
        </div><br>
        <!-- Consulta de Moradores -->
        <table class="w3-table-all w3-centered w3-hoverable w3-mobile" style="overflow-y:auto;">
            <tr class="w3-center w3-blue-grey">

                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Apartamento</th>
                <th>Bloco/Quadra</th>
            </tr>
            <?php

            $sql = "SELECT morador.cpf, morador.nome, morador.telefone, morador.email, propriedade.num_propriedade, propriedade.bloco_quadra FROM morador, propriedade WHERE morador.id_propriedade = propriedade.id_propriedade order by nome";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';

                    echo '<td>' . $linha['nome'] . '</td>';
                    echo '<td>' . $linha['telefone'] . '</td>';
                    echo '<td>' . $linha['email'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                }

            ?>
        </table><br>

    </div>

    <!--Aba de Propriedade -->
    <div id="propriedades" class="w3-container w3-border menu" style="display:none">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Propriedades</b></h2>
        </div>
        <br>
        <!-- Consulta de propriedade -->
        <table class="w3-table-all w3-centered w3-hoverable">
            <tr class="w3-center w3-blue-grey">
                <th>Código</th>
                <th>Número</th>
                <th>Bloco/Quadra</th>
            </tr>
            <?php

            $sql = "SELECT * FROM propriedade order by num_propriedade";
            $resultado = $conexao->query($sql);
            if ($resultado != null)
                foreach ($resultado as $linha) {
                    echo '<tr class=w3-text-black>';
                    echo '<td>' . $linha['id_propriedade'] . '</td>';
                    echo '<td>' . $linha['num_propriedade'] . '</td>';
                    echo '<td>' . $linha['bloco_quadra'] . '</td>';
                }
            ?>
        </table><br>

    </div>
</div><br><br>

<?php require_once('rodape.php'); ?>