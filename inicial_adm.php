<?php require_once('conexaoBD.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Conpac</title>
</head>
<style>
    .item_nav {
        height: 100%;
        align-items: center;
    }

    .aba_menu {
        border: none;
    }

    .tablink {
        border: white;
        position: relative;
        overflow: hidden;
    }

    .tablink::after {
        content: "";
        position: absolute;
        top: -20px;
        left: -25px;
        width: 40px;
        height: 40px;
        background-color: #E8E8E8;
        transform: rotate(40deg);

    }

    .menu {
        background-color: white;
    }

    .botao_cad {
        background-color: midnightblue;
        color: white;
        box-shadow: 10px 5px 5px black;
    }

    /* rodapé: #page-container e footer  */
    #page-container {
        position: relative;
        min-height: 100vh;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 3rem;
        background-color: #101031;
        color: white;
        text-align: center;

    }

    nav {
        background-color: #101031;
        color: white;
    }

    .slc-usuario {
        width: 30%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>

<body class="w3-light-grey">

    <nav class="w3-bar w3-mobile w3-top w3-center " style="height: 50px;">
        <img src="img/logo_semFundo.png" alt="" class="w3-bar-item w3-left item_nav" style="width: 5%;">
        <span class="w3-left item_nav">
            <h4>Conpac</h4>
        </span>
        <a href="#" class="item_nav w3-bar-item w3-button w3-right w3-hover-red">Sair</a>
        <a href="#" class="item_nav w3-bar-item w3-button w3-right">Alterar Senha</a>
        <span class=" item_nav w3-bar-item w3-right">Olá, Fulano</span>
    </nav>

    <div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">


        <div class="w3-bar aba_menu">
            <div class="abas w3-blue-grey">
                <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'propriedades')"><b>Propriedades</b></button>
                <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'usuarios')"><b>Usuários</b></button>
                <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'moradores')"><b>Moradores</b></button>
                <button class="w3-bar-item w3-button tablink  w3-right w3-border w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
            </div>
        </div>

        <?php 
        session_start();
        if (isset($_SESSION['mensagem'])){
            echo '<dialog class="w3-panel w3-green w3-display-container">';
            echo '<span onclick="this.parentElement.style.display=\'none\'" class="w3-buton w3-large w3-display-topright">&times;</span>';
            echo '<p>'. $_SESSION['mensagem'] . '</p>';
            echo '</dialog>';
            unset($_SESSION['mensagem']);
        }
        ?>

        <!--Aba de entregas -->
        <div id="entregas" class="w3-container w3-border w3-white menu">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

                <!--Cadastro de entregas com caixa Modal -->
                <button onclick="document.getElementById('cad_entrega').style.display='block'" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_entrega" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <div class="w3-container w3-padding">
                                <h2 class="w3-center"><b>Cadastrar Encomenda</b></h2>
                                <form action="cadastro_encomendaAction.php" method="post" class="w3-padding">
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style=" padding-right: 15px;">
                                            <label for="data_recebimento"><b>Data de Recebimento</b> </label>
                                            <input type="date" name="data_recebimento" required>
                                        </div>
                                        <div class="w3-cell">
                                            <label for="recebido_por"><b>Recebido por</b> </label>
                                            <input type="text" name="recebido_por" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style="padding-right: 15px;">
                                            <label for="tipo"><b>Tipo</b> </label>
                                            <select name="tipo" required>
                                                <option value="" disabled selected>Selecione o tipo</option>
                                                <option value="e-commerce">E-COMMERCE</option>
                                                <option value="carta">CARTA</option>
                                                <option value="sedex">SEDEX</option>
                                            </select>
                                        </div>
                                        <div class="w3-cell">
                                            <label for="status"><b>Status</b></label>
                                            <select name="status" required>
                                                <option value="" disabled selected>Selecione o status</option>
                                                <option value="entregue">Entregue</option>
                                                <option value="a retirar">A Retirar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style="padding-right: 15px;">
                                            <label for="morador"><b>Morador</b></label>
                                            <select name="morador" required>
                                                <option value="" disabled selected>Selecione o morador</option>
                                                <?php

                                                $query = "SELECT cpf, nome FROM morador";
                                                $result = $conexao->query($query);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . htmlspecialchars($row["cpf"]) . '">' . htmlspecialchars($row["nome"]) . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">Nenhuma opção disponível</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="w3-cell">
                                            <label for="propriedade"><b>Propriedade</b></label>
                                            <select name="propriedade" required>
                                                <option value="" disabled selected>Selecione a propriedade</option>
                                                <?php

                                                $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                                                $result = $conexao->query($query);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . htmlspecialchars($row["id_propriedade"]) . '">' . htmlspecialchars($row["bloco_quadra"] . ' - ' . $row["num_propriedade"]) . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">Nenhuma opção disponível</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style="padding-right: 15px;">
                                            <label for="remetente"><b>Remetente</b></label>
                                            <input type="text" name="remetente" required>
                                        </div>
                                        <div class="w3-cell">
                                            <label for="num_registro"><b>Número de Registro</b></label>
                                            <input type="text" name="num_registro" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style="padding-right: 15px;">
                                            <label for="retirado_por"><b>Retirado por</b></label>
                                            <input type="text" name="retirado_por">
                                        </div>
                                        <div class="w3-cell">
                                            <label for="data_retirada"><b>Data de Retirada</b></label>
                                            <input type="date" name="data_retirada">
                                        </div>

                                    </div>
                                    <br>

                                    <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                                </form><br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de Entregas -->
            <table class="w3-table-all w3-centered w3-hoverable" style="overflow-y:auto; ">
                <tr class="w3-center w3-blue-grey">
                    <th>Data Recebimento</th>
                    <th>Morador</th>
                    <th>Apartamento</th>
                    <th>bloco</th>
                    <th>Status</th>
                    <th>Relatório</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
                <?php

                // fazer a consulta ainda
                $sql = "SELECT entrega.data_recebimento, entrega.nome_morador, propriedade.num_propriedade, propriedade.bloco_quadra, entrega.status FROM entrega, propriedade WHERE entrega.id_residencia = propriedade.id_propriedade order by data_recebimento";
                $resultado = $conexao->query($sql);
                if ($resultado != null)
                    foreach ($resultado as $linha) {
                        echo '<tr class=w3-text-black>';
                        echo '<td>' . $linha['data_recebimento'] . '</td>';
                        echo '<td>' . $linha['nome_morador'] . '</td>';
                        echo '<td>' . $linha['num_propriedade'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';
                        echo '<td>' . $linha['status'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';

                        // criar um modal para relatório com muito mais dados e detalhado
                        echo '<td><a href="relatorio_entrega.php?dt_recebimento=' . $linha['data_recebimento'] . '&nome=' . $linha['nome_morador'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '&status=' . $linha['status'] . '">
                                        <i class="fa fa-user-times w3-large w3-text-black"></i> 
                                    </a></td>
                            </td>';
                        echo '<td><button onclick="document.getElementById(\'excluir_entrega\').style.display=\'block\'"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                        echo '<td><button onclick="document.getElementById(\'editar_entrega\').style.display=\'block\'"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                        echo '</tr>';
                        echo '</tr>';
                    }

                ?>
            </table><br>
            <!--Editar entregas -->
            <div id="editar_entrega" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('editar_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">

                        </div>
                    </div>
                </div>
            </div>
            <!--Excluir entregas -->
            <div id="excluir_entrega" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('excluir_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Aba de MORADORES -->
        <div id="moradores" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Moradores</b></h2>

                <!--Cadastro de moradores com caixa Modal -->
                <button onclick="document.getElementById('cad_morador').style.display='block'" class="botao_cad w3-right w3-round-xlarge  w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_morador" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <div class="w3-container w3-content">

                                <h2 class="w3-center w3-padding"><b>Cadastrar Morador</b></h2><br>

                                <form action="cadastro_moradorAction.php" method="post" class="w3-padding">
                                    <div class="w3-margin-bottom">
                                        <div class="w3-cell-row">
                                            <div class="w3-cell " style="padding-right: 15px; width:30%;">
                                                <label for="cpf"><b>CPF</b> </label>
                                                <input class="w3-input w3-border" name="cpf" required pattern="\d{11}" title="O CPF deve conter 11 dígitos.">
                                            </div>

                                            <div class="w3-cell">
                                                <label for="nome"><b>Nome</b> </label>
                                                <input class="w3-input w3-border" type="text" name="nome" required>
                                            </div>
                                        </div><br>
                                        <div class="w3-cell-row">
                                            <div class="w3-cell " style="padding-right: 15px; width:30%;">
                                                <label for="tel"><b>Telefone</b> </label>
                                                <input class="w3-input w3-border" type="tel" name="tel" required pattern="\d{10,11}" title="O telefone deve conter 10 ou 11 dígitos.">
                                            </div>
                                            <div class="w3-cell ">
                                                <label for="email"><b>E-mail</b></label>
                                                <input class="w3-input w3-border" type="email" name="email" required>
                                                <br>
                                            </div>
                                        </div><br>
                                        <label for="propriedade"><b>Propriedade</b></label>
                                        <select class="w3-input w3-border" name="propriedade" required style="width:30%;">
                                            <?php
                                            $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                                            $result = $conexao->query($query);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row["id_propriedade"]) . '">' . htmlspecialchars($row["bloco_quadra"] . ' - ' . $row["num_propriedade"]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">Nenhuma opção disponível</option>';
                                            }
                                            ?>
                                        </select>
                                        <br>

                                        <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                                        <br><br>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>

            <!-- Consulta de Moradores -->
            <table class="w3-table-all w3-centered w3-hoverable" style="overflow-y:auto;">
                <tr class="w3-center w3-blue-grey">
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Apartamento</th>
                    <th>Bloco/Quadra</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
                <?php

                $sql = "SELECT morador.cpf, morador.nome, morador.telefone, morador.email, propriedade.num_propriedade, propriedade.bloco_quadra FROM morador, propriedade WHERE morador.id_propriedade = propriedade.id_propriedade order by nome";
                $resultado = $conexao->query($sql);
                if ($resultado != null)
                    foreach ($resultado as $linha) {
                        echo '<tr class=w3-text-black>';
                        echo '<td>' . $linha['cpf'] . '</td>';
                        echo '<td>' . $linha['nome'] . '</td>';
                        echo '<td>' . $linha['telefone'] . '</td>';
                        echo '<td>' . $linha['email'] . '</td>';
                        echo '<td>' . $linha['num_propriedade'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';
                        echo '<td><button onclick="document.getElementById(\'excluir_morador\').style.display=\'block\'"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                        echo '<td><button onclick="document.getElementById(\'editar_morador\').style.display=\'block\'"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                        echo '</tr>';
                    }

                ?>
            </table><br>
            <!--Editar moradores -->
            <div id="editar_morador" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('editar_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <h1 class="w3-center"><b>Editar Morador</b></h1>
                        <form action="editar_moradorAction.php" method='post' class="w3-padding">
                            <div class="w3-cell-row">
                                <div class="w3-cell" style="padding-right: 15px; width:30%;">
                                    <label class="w3-text-black" style="font-weight: bold;">CPF</label>
                                    <input name="cpf" class="w3-input w3-grey w3-border" readonly value="<?php echo $linha['cpf']; ?>">
                                </div>
                                <div class="w3-cell">
                                    <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                                    <input name="tel" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['nome']; ?>">
                                </div>
                            </div><br>
                            <div class="w3-cell-row">
                                <div class="w3-cell" style="padding-right: 15px; width:30%;">
                                    <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                                    <input name="nome" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['telefone']; ?>">
                                </div>
                                <div>
                                    <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                                    <input name="email" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['email']; ?>">
                                </div>
                            </div><br>
                            <label for="propriedade">Propriedade</label>
                            <select class="w3-input w3-border w3-light-grey" name="propriedade" style="width:30%;">
                                <?php

                                $query = "SELECT id_propriedade, bloco_quadra, num_propriedade FROM propriedade";
                                $result = $conexao->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($row["id_propriedade"]) . '">' . htmlspecialchars($row["bloco_quadra"] . ' - ' . $row["num_propriedade"]) . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Nenhuma opção disponível</option>';
                                }
                                ?>
                            </select>
                            <br>
                            <button class="w3-btn w3-black" type="submit">Alterar</button>
                        </form><br>

                    </div>
                </div>
            </div>
            <!--Excluir Morador -->
            <div id="excluir_morador" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('excluir_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">
                            <h2 class="w3-center"><b>Excluir Morador</b></h2>
                            <form action="excluir_moradorAction.php" method="post" class="w3-padding">
                                <div class="w3-cell-row">
                                    <div class="w3-cell" style="padding-right: 15px; width:30%;">
                                        <label class="w3-text-black" style="font-weight: bold;">CPF</label>
                                        <input name="cpf" class="w3-input w3-grey w3-border" readonly value="<?php echo $linha['cpf']; ?>">
                                    </div>
                                    <div class="w3-cell">
                                        <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                                        <input name="tel" class="w3-input w3-light-grey w3-border" readonly value="<?php echo $linha['nome']; ?>">
                                    </div>
                                </div><br>
                                <div class="w3-cell-row">
                                    <div class="w3-cell" style="padding-right: 15px; width:30%;">
                                        <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                                        <input name="nome" class="w3-input w3-light-grey w3-border" readonly value="<?php echo $linha['telefone']; ?>">
                                    </div>
                                    <div class="w3-cell">
                                        <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                                        <input name="email" class="w3-input w3-light-grey w3-border" readonly value="<?php echo $linha['email']; ?>">
                                    </div>
                                </div><br>
                                <div class="w3-cell-row">
                                    <div class="w3-cell" style="padding-right: 15px;">
                                        <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                                        <input name="numapart" class="w3-input w3-grey w3-border" disabled value="<?php echo $linha['num_propriedade']; ?>">
                                    </div>
                                    <div class="w3-cell">
                                        <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                                        <input name="bloco" class="w3-input w3-grey w3-border" disabled value="<?php echo $linha['bloco_quadra']; ?>">
                                    </div>
                                </div><br>
                                <button class="w3-btn w3-black" type="submit">Confirmar Exclusão!</button>

                            </form><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Aba de usuários -->
        <div id="usuarios" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Usuários</b></h2>

                <!--Cadastro de usuários com caixa Modal -->
                <button onclick="document.getElementById('cad_usuario').style.display='block'" class="botao_cad w3-right w3-round-xlarge  w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_usuario" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_usuario').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <div class="w3-container w3-content ">
                                <h2 class="w3-center"><b>Cadastrar Usuários</b></h2>
                                <br>
                                <form action="cadastro_usuarioAction.php" method="post" class="w3-padding">
                                    <div class="w3-margin-bottom">
                                        <div class="w3-cell-row">
                                            <div class="w3-cell" style="width: 30%; padding-right: 15px;">
                                                <label for="codigo"><b>Código</b></label>
                                                <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" disabled>
                                            </div>
                                            <div class="w3-cell">
                                                <label for="nome"><b>Nome</b></label>
                                                <input class="w3-input w3-border" type="text" name="nome" required>
                                            </div>
                                        </div>

                                        <br>
                                        <label for="login"><b>Login</b></label>
                                        <input class="w3-input w3-border" type="text" name="login" required>
                                        <br>
                                        <label for="senha"><b>Senha</b></label>
                                        <input class="w3-input w3-border w3-margin-bottom" type="password" name="senha" required>
                                        <br>
                                        <label for="privilegio"><b>Privilégio</b></label>
                                        <select class="slc-usuario" name="privilegio">
                                            <option value="" select></option>
                                            <option value="administrador">Administrador</option>
                                            <option value="operador">Operador</option>
                                            <option value="operador">Morador</option>
                                        </select>
                                        <br><br>
                                        <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                                        <br><br>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de usuarios -->
            <table class="w3-table-all w3-centered w3-hoverable">
                <tr class="w3-center w3-blue-grey">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Privilégio</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>

                <?php

                try {
                    $sql = "SELECT * FROM usuario";
                    $resultado = $conexao->query($sql);

                    if ($resultado != null) {
                        foreach ($resultado as $linha) {
                            echo '<tr class="w3-text-black">';
                            echo '<td>' . htmlspecialchars($linha['id_user'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($linha['login'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($linha['privilegio'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td><button onclick="document.getElementById(\'excluir_usuario\').style.display=\'block\'"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                            echo '<td><button onclick="document.getElementById(\'editar_usuario\').style.display=\'block\'"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                            echo '</tr>';

                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="w3-center">Nenhum usuário encontrado.</td></tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="5" class="w3-center">Erro ao consultar usuários: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
                }
                ?>
            </table><br>
            <!--Editar usuario -->
            <div id="editar_usuario" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('editar_usuario').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">
                            <h1 class="w3-center"><b>Editar Usuário</b></h1>
                            <form action="editar_usuarioAction.php" method='post' class="w3-padding">
                                <input name="id_user" class="w3-input w3-grey w3-border" type="hidden" value="<?php echo $linha['id_user']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                                <input name="nome" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['nome']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Login</label>
                                <input name="login" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['login']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Senha</label>
                                <input name="senha" class="w3-input w3-light-grey w3-border" type="password" value="<?php echo $linha['senha']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Confirme a senha</label>
                                <input name="confirma_senha" class="w3-input w3-light-grey w3-border" type="password" value="">
                                <br>
                                <label for="privilegio" class="w3-text-black" style="font-weight: bold;">Privilégio</label>
                                <select class="slc-usuario w3-light-grey" name="privilegio">
                                    <option value="administrador" <?php echo $linha['privilegio'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="operador" <?php echo $linha['privilegio'] == 'operador' ? 'selected' : ''; ?>>Operador</option>
                                    <option value="operador" <?php echo $linha['privilegio'] == 'morador' ? 'selected' : ''; ?>>Morador</option>
                                </select>
                                <br><br>
                                <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Excluir usuario -->
            <div id="excluir_usuario" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('excluir_usuario').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">
                            <h2 class="w3-center"><b>Excluir Usuário</b></h2>
                            <form action="excluir_usuarioAction.php" method='post' class="w3-padding">
                                <label class="w3-text-black" style="font-weight: bold;">ID</label>
                                <input name="id_user" class="w3-input w3-grey w3-border" type="hidden" disabled value="<?php echo $linha['id_user']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                                <input name="nome" class="w3-input w3-grey w3-border" disabled value="<?php echo $linha['nome']; ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Login</label>
                                <input name="login" class="w3-input w3-grey w3-border" disabled value="<?php echo $linha['login']; ?>">
                                <br>
                                <label for="privilegio" class="w3-text-black" style="font-weight: bold;">Privilégio</label>
                                <select class="slc-usuario w3-light-grey" name="privilegio" disabled>
                                    <option value="administrador" <?php echo $linha['privilegio'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="operador" <?php echo $linha['privilegio'] == 'operador' ? 'selected' : ''; ?>>Operador</option>
                                    <option value="operador" <?php echo $linha['privilegio'] == 'morador' ? 'selected' : ''; ?>>Morador</option>
                                </select>
                                <br><br>

                                <button class="w3-btn w3-black" type="submit">Confirmar Exclusão!</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Aba de Propriedade -->
        <div id="propriedades" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Propriedades</b></h2>

                <!--Cadastro de propriedade com caixa Modal -->
                <button onclick="document.getElementById('cad_propriedade').style.display='block'" class="botao_cad w3-right w3-round-xlarge w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_propriedade" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <div class="w3-container">
                                <h1 class="w3-center"><b>Cadastrar Propriedade</b></h1>

                                <form action="cadastro_propriedadeAction.php" method="post" class="w3-padding">
                                    <div class="w3-container w3-margin-bottom">
                                        <div class="cod" style="width:35%;">
                                            <label for="codigo"><b>Código</b> </label>
                                            <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" disabled>
                                        </div>
                                        <br>
                                        <div class="w3-cell-row">
                                            <div class="w3-cell" style="width: 50%; padding-right: 15px;">
                                                <label for="numero"><b>Número</b> </label>
                                                <input class="w3-input w3-border" type="number" name="numero" required>
                                            </div>
                                            <div class="w3-cell" style="width: 50%;">
                                                <label for="bloco"><b>Bloco ou Quadra</b></label>
                                                <input class="w3-input w3-border" type="text" name="bloco" required>
                                            </div>
                                        </div>
                                        <br>
                                        <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                                        <br><br>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de propriedade -->
            <table class="w3-table-all w3-centered w3-hoverable">
                <tr class="w3-center w3-blue-grey">
                    <th>Código</th>
                    <th>Número</th>
                    <th>Bloco/Quadra</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>
                <?php
                require_once('conexaoBD.php');
                $sql = "SELECT * FROM propriedade order by num_propriedade";
                $resultado = $conexao->query($sql);
                if ($resultado != null)
                    foreach ($resultado as $linha) {
                        echo '<tr class=w3-text-black>';
                        echo '<td>' . $linha['id_propriedade'] . '</td>';
                        echo '<td>' . $linha['num_propriedade'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';
                        echo '<td><button onclick="document.getElementById(\'excluir_propriedade\').style.display=\'block\'"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                        echo '<td><button onclick="document.getElementById(\'editar_propriedade\').style.display=\'block\'"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
                        echo '</tr>';
                    }
                ?>
            </table><br>
            <!--Editar propriedade -->
            <div id="editar_propriedade" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('editar_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">
                            <h1 class="w3-center"><b>Editar Propriedade</b></h1>
                            <form action="editar_propriedadeAction.php" method='post' class="w3-padding">
                                <input name="txtCodigo" class="w3-input w3-grey w3-border" type="" value="<?php echo $linha['id_propriedade'] ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Número</label>
                                <input name="txtNumero" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['num_propriedade'] ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                                <input name="txtBloco" class="w3-input w3-light-grey w3-border" value="<?php echo $linha['bloco_quadra'] ?>">
                                <br>
                                <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Excluir propriedade -->
            <div id="excluir_propriedade" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('excluir_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                        <div class="w3-container">
                            <h1 class="w3-center"><b>Editar Propriedade</b></h1>
                            <form action="editar_propriedadeAction.php" method='post' class="w3-padding">
                                <input name="txtCodigo" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['id'] ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Número</label>
                                <input name="txtNumero" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['numero'] ?>">
                                <br>
                                <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                                <input name="txtBloco" class="w3-input w3-grey w3-border" disabled value="<?php echo $_GET['bloco'] ?>">
                                <br>
                                <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>

    <script>
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
    </script>
    </div>
</body>

<div id="page-container">
    <footer>
        <p>Suporte:
            <a href="mailto:hege@example.com">contato@econpac.com</a>
        </p>
    </footer>
</div>


</html>