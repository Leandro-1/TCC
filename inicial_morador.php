<?php
require_once('verificar_permissaoAcesso.php');
verificar_permissao('morador');
require_once('cabecalho.php');
require_once('conexaoBD.php');

?>

<div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">

    <div class="w3-bar aba_menu">
        <div class="abas w3-blue-grey">
            <button class="w3-bar-item w3-button tablink w3-right"><b>Entregas</b></button>
        </div>
    </div>

    <!--Aba de entregas -->
    <div id="entregas" class="w3-container w3-border w3-white menu">
        <div class="w3-container w3-display-top w3-padding">
            <h2 class="w3-center"><b>Consulta de Entregas</b></h2>
        </div>
        <br>

        <!-- Consulta de Entregas -->
        <table class="w3-table-all w3-centered w3-hoverable" style="overflow-x:auto; ">
            <tr class="w3-center w3-blue-grey">
                <th>Apartamento/Bloco</th>
                <th>Data Recebimento</th>
                <th>Recebido por</th>
                <th>Destinatário</th>
                <th>Retirado por</th>
                <th>Data Retirada</th>
                <th>Status</th>
                <th>Relatório</th><!-- Dentro de relatório com mais detalhes cadastrados -->
            </tr>
            <?php
            $usuario_id = $_SESSION['id_user'];
            $tipo = $_SESSION['privilegio'];

            // Identificar a propriedade associada ao usuário logado
            $sql_propriedade = "SELECT id_propriedade FROM morador WHERE id_usuario = $usuario_id;";
            $result_propriedade = $conexao->query($sql_propriedade);

            if ($result_propriedade->num_rows > 0) {
                $morador = $result_propriedade->fetch_assoc();
                $id_propriedade = $morador['id_propriedade'];

                // Buscar entregas para o apartamento identificado
                $sql_entregas = "SELECT entrega.*, propriedade.* FROM entrega 
                     JOIN propriedade ON entrega.id_residencia = propriedade.id_propriedade 
                     WHERE propriedade.id_propriedade = $id_propriedade;";
                $result_entregas = $conexao->query($sql_entregas);

                while ($linha = $result_entregas->fetch_assoc()) {
                    echo '<tr class="w3-text-black">';
                    echo '<td>' . $linha['num_propriedade'] . ' / ' . $linha['bloco_quadra'] . '</td>';
                    echo '<td>' . $linha['data_recebimento'] . '</td>';
                    echo '<td>' . $linha['recebido_por'] . '</td>';
                    echo '<td>' . $linha['nome_destinatario'] . '</td>';
                    echo '<td>' . $linha['retirado_por'] . '</td>';
                    echo '<td>' . $linha['data_retirada'] .  '</td>';
                    echo '<td>' . $linha['status'] . '</td>';

                    // colocar mais detalhes relevantes
                    echo '<td><button onclick="detalhesEntrega(\'' . $linha['data_recebimento'] . '\',\'' . $linha['recebido_por'] . '\',\'' . $linha['nome_destinatario'] . '\',\'' . $linha['status'] . '\')" class="w3-text-blue">Detalhes</button></td>';
                }
            }
            ?>
        </table><br>

        <!-- modal para detalhes da entrega -->
        <div id="detalhes_entrega" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('detalhes_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="w3-container">
                        <h2>Detalhes da Entrega</h2>
                        <span>Data de Recebimento:</span>
                        <p id="dt_receb"></p>
                        <span>Recebido Por:</span>
                        <p id="recebido"></p>
                        <span>Destinatário</span>
                        <p id="destin"></p>
                        <span>Status</span>
                        <p id="status_atual"></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function detalhesEntrega(dt_recebido, recebido_por, destinatario, status) {
                document.getElementById('dt_receb').value = dt_recebido;
                document.getElementById('recebido').value = recebido_por;
                document.getElementById('destin').value = destinatario;
                document.getElementById('status_atual').value = status;
                document.getElementById('detalhes_entrega').style.display = 'block';

            }
        </script>
    </div>
</div><br><br>

<?php require_once('rodape.php'); ?>