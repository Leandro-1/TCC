<?php
//2 primeiras linhas: verificaçaõ unica de acesso para todos os usuario, chamando somente a funcao e colocando o tipo de usuario
//podendo assim excluir o arquivos 'verificar acesso adm e todos'
require_once('verificar_permissaoAcesso.php');
verificar_permissao('morador');
require_once('cabecalho.php');
require_once('conexaoBD.php');
?>


<!-- Falta a criação da logica para o usuario verificar somente suas entregas -->

<div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">

    <div class="w3-bar aba_menu">
        <div class="abas w3-blue-grey">
            <button class="w3-bar-item w3-button tablink  w3-right w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
        </div>
    </div>

    <!--Aba de entregas -->
    <div id="entregas" class="w3-container w3-border w3-white menu">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Entregas</b></h2>
        </div>
        <br>

        <!-- Consulta de Entregas -->
        <table class="w3-table-all w3-centered w3-hoverable" style="overflow-y:auto; ">
            <tr class="w3-center w3-blue-grey">
                <th>Data Recebimento</th>
                <th>Quem Recebeu</th>
                <th>Morador</th>
                <th>Relatório</th> <!-- Dentro de relatório detalhar quem retirou, e mais detalhes cadastrados -->
                <th>Status</th>
            </tr>
            <?php
            $usuario_id = $_SESSION['id_user'];
            $tipo = $_SESSION['privilegio'];

            // Identificar a propriedade associada ao usuário logado
            $sql_propriedade = "SELECT id_propriedade FROM morador WHERE id_usuario = '$usuario_id'";
            $result_propriedade = $conexao->query($sql_propriedade);

            if ($result_propriedade->num_rows > 0) {
                $morador = $result_propriedade->fetch_assoc();
                $id_propriedade = $morador['id_propriedade'];

                // Buscar entregas para o apartamento identificado
                $sql_entregas = "SELECT entrega.*, propriedade.* FROM entrega 
                     JOIN propriedade ON entrega.id_residencia = propriedade.id_propriedade 
                     WHERE propriedade.id_propriedade = '$id_propriedade'";
                $result_entregas = $conexao->query($sql_entregas);

                while ($linha = $result_entregas->fetch_assoc()) {
                        echo '<tr class=w3-text-black>';
                        echo '<td>' . $linha['data_recebimento'] . '</td>';
                        echo '<td>' . $linha['nome_morador'] . '</td>';
                        echo '<td>' . $linha['num_propriedade'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';
                        echo '<td>' . $linha['status'] . '</td>';

                        // criar um modal para relatório com muito mais dados e detalhado
                        echo '<td><a href="relatorio_entrega.php?dt_recebimento=' . $linha['data_recebimento'] . '&nome=' . $linha['nome_morador'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '&status=' . $linha['status'] . '">
                                        <i class="fa fa-user-times w3-large w3-text-black"></i> 
                                    </a></td>
                            </td>';
                    }
            }
            ?>
        </table><br>

    </div>
</div><br><br>

<?php require_once('rodape.php'); ?>