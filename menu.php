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
        background-color: black;
        color: white;
        text-align: center;

    }
</style>

<body>

    <div class="w3-bar w3-black w3-mobile w3-top w3-center" style="height: 50px;">
        <img src="img/logo.png" alt="" class="w3-bar-item w3-left" style="width: 5%;">
        <span class="w3-left">
            <h4>Conpac</h4>
        </span>
        <a href="#" class="w3-bar-item w3-button w3-right w3-hover-red">Sair</a>
        <a href="#" class="w3-bar-item w3-button w3-right">Alterar Senha</a>
        <span class="w3-bar-item w3-right">Olá, Fulano</span>
    </div>

    <div class="w3-container " style="margin-top: 80px; padding-bottom: 4rem;">


        <div class="w3-bar">
            <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'propriedades')"><b>Propriedades</b></button>
            <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'usuarios')"><b>Usuários</b></button>
            <button class="w3-bar-item w3-button tablink w3-right w3-border" onclick="openMenu(event,'moradores')"><b>Moradores</b></button>
            <button class="w3-bar-item w3-button tablink  w3-right w3-border w3-red" onclick="openMenu(event,'entregas')"><b>Entregas</b></button>
        </div>

        <!--Aba de entregas -->
        <div id="entregas" class="w3-container w3-border menu">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

                <!--Cadastro de entregas com caixa Modal -->
                <button onclick="document.getElementById('cad_entrega').style.display='block'" class="w3-right w3-round-xlarge w3-blue w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_entrega" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_entrega').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <p>Some text in the Modal..</p>
                            <p>Some text in the Modal..</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de Entregas -->
            <table class="w3-table-all w3-centered " style="overflow-y:auto; ">
                <tr class="w3-center w3-grey">
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
                $servername = "localhost:3307";
                $username = "root";
                $password = "usbw";
                $dbname = "conpac";
                $conexao = new mysqli($servername, $username, $password, $dbname);
                if ($conexao->connect_error) {
                    die("Connection failed: " . $conexao->connect_error);
                }

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
                        echo '<td><a href="excluir_entrega.php?dt_recebimento=' . $linha['data_recebimento'] . '&nome=' . $linha['nome_morador'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '&status=' . $linha['status'] . '">
                                        <i class="fa fa-user-times w3-large w3-text-black"></i> 
                                    Detalhes</a></td>
                            </td>';
                        echo '<td><a href="editar_entrega.php?dt_recebimento=' . $linha['data_recebimento'] . '&nome=' . $linha['nome_morador'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '&status=' . $linha['status'] . '">
                                    <i class="fa fa-pen-to-square w3-large w3-text-black""></i>    
                                    </a></td>
                                </td>';
                        echo '</tr>';
                    }

                ?>
            </table>
        </div>

        <!--Aba de MORADORES -->
        <div id="moradores" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Moradores</b></h2>

                <!--Cadastro de moradores com caixa Modal -->
                <button onclick="document.getElementById('cad_morador').style.display='block'" class="w3-right w3-round-xlarge w3-blue w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_morador" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <div class="formulario">
                                <?php


                                // Verifica se há mensagem de sucesso ou erro
                                if (isset($_SESSION['mensagem'])) {
                                    echo '<div class="alert">' . $_SESSION['mensagem'] . '</div>';
                                    unset($_SESSION['mensagem']); // Limpa a mensagem após exibição
                                }
                                ?>
                                <div class="w3-container w3-content">

                                    <h2 class="w3-center"><b>Cadastrar Morador</b></h2>

                                    <form action="cadastro_moradorAction.php" method="post">
                                        <div class="w3-margin-bottom">
                                            <p class="w3-left">
                                                <label for="cpf">CPF</label>
                                                <input class="w3-input w3-border" name="cpf" required pattern="\d{11}" title="O CPF deve conter 11 dígitos.">
                                            </p>

                                            <p class="w3-right">
                                                <label for="tel">Telefone</label>
                                                <input class="w3-input w3-border" type="tel" name="tel" required pattern="\d{10,11}" title="O telefone deve conter 10 ou 11 dígitos.">
                                            </p>


                                            <label for="nome">Nome</label>
                                            <input class="w3-input w3-border" type="text" name="nome" required>
                                            <br>

                                            <label for="email">E-mail</label>
                                            <input class="w3-input w3-border" type="email" name="email" required>
                                            <br>

                                            <label for="propriedade">Propriedade</label>
                                            <select class="w3-input w3-border" name="propriedade" required>
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
            </div>
            <br>
            <!-- Consulta de Moradores -->

            <table class="w3-table-all w3-centered" style="overflow-y:auto;">
                <tr class="w3-center w3-grey">
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
                $servername = "localhost:3307";
                $username = "root";
                $password = "usbw";
                $dbname = "conpac";
                $conexao = new mysqli($servername, $username, $password, $dbname);
                if ($conexao->connect_error) {
                    die("Connection failed: " . $conexao->connect_error);
                }


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
                        echo '<td><a href="excluir_morador.php?cpf=' . $linha['cpf'] . '&nome=' . $linha['nome'] . '&tel=' . $linha['telefone'] .  '&email=' . $linha['email'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-user-times w3-large w3-text-black"></i> 
                                    </a></td>
                            </td>';
                        echo '<td> <a href="editar_morador.php?cpf=' . $linha['cpf'] . '&nome=' . $linha['nome'] . '&tel=' . $linha['telefone'] .  '&email=' . $linha['email'] . '&num_apart=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-pen-to-square w3-large w3-text-black""></i>
                                    </a></td>
                                </td>';
                        echo '</tr>';
                    }

                ?>
            </table>

        </div>

        <!--Aba de usuários -->
        <div id="usuarios" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Usuários</b></h2>

                <!--Cadastro de usuários com caixa Modal -->
                <button onclick="document.getElementById('cad_usuario').style.display='block'" class="w3-right w3-round-xlarge w3-blue w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_usuario" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_usuario').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <p>Some text in the Modal..</p>
                            <p>Some text in the Modal..</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de usuarios -->
            <table class="w3-table-all w3-centered">
                <tr class="w3-center w3-grey">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Privilégio</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>

                <?php
                $servername = "localhost:3307";
                $username = "root";
                $password = "usbw";
                $dbname = "conpac";
                $conexao = new mysqli($servername, $username, $password, $dbname);
                if ($conexao->connect_error) {
                    die("Connection failed: " . $conexao->connect_error);
                }

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
                            echo '<td><a href="excluir_usuario.php?id_user=' . $linha['id_user'] . '&nome=' . $linha['nome'] . '&login=' . $linha['login'] . '&senha=' . $linha['senha'] . '&privilegio=' . $linha['privilegio'] . '">
                            <i class="fa fa-user-times w3-large"></i>
                          </a></td>';
                            echo '<td><a href="editar_usuario.php?id_user=' . $linha['id_user'] . '&nome=' . $linha['nome'] . '&login=' . $linha['login'] . '&senha=' . $linha['senha'] . '&privilegio=' . $linha['privilegio'] . '">
                            <i class="fa fa-pen-to-square w3-large w3-text-black"></i>
                          </a></td>';

                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="w3-center">Nenhum usuário encontrado.</td></tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="5" class="w3-center">Erro ao consultar usuários: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</td></tr>';
                }
                ?>
            </table>
        </div>


        <!--Aba de Propriedade -->
        <div id="propriedades" class="w3-container w3-border menu" style="display:none">
            <div class="w3-container w3-display-top">
                <h2 class="w3-center"><b>Consulta de Usuários</b></h2>

                <!--Cadastro de propriedade com caixa Modal -->
                <button onclick="document.getElementById('cad_propriedade').style.display='block'" class="w3-right w3-round-xlarge w3-blue w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

                <div id="cad_propriedade" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('cad_propriedade').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                            <p>Some text in the Modal..</p>
                            <p>Some text in the Modal..</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Consulta de propriedade -->
            <table class="w3-table-all w3-centered">
                <tr class="w3-center w3-grey">
                    <th>Código</th>
                    <th>Número</th>
                    <th>Bloco/Quadra</th>
                    <th>Editar</th>
                </tr>
                <?php
                $servername = "localhost:3307";
                $username = "root";
                $password = "usbw";
                $dbname = "conpac";
                $conexao = new mysqli($servername, $username, $password, $dbname);
                if ($conexao->connect_error) {
                    die("Connection failed: " . $conexao->connect_error);
                }


                $sql = "SELECT * FROM propriedade order by num_propriedade";
                $resultado = $conexao->query($sql);
                if ($resultado != null)
                    foreach ($resultado as $linha) {
                        echo '<tr class=w3-text-black>';
                        echo '<td>' . $linha['id_propriedade'] . '</td>';
                        echo '<td>' . $linha['num_propriedade'] . '</td>';
                        echo '<td>' . $linha['bloco_quadra'] . '</td>';
                        echo '<td> <a href="editar_propriedade.php?id=' . $linha['id_propriedade'] . '&numero=' . $linha['num_propriedade'] . '&bloco=' . $linha['bloco_quadra'] . '">
                                        <i class="fa fa-pen-to-square w3-large w3-text-black""></i>
                                    </a></td>
                                </td>';
                        echo '</tr>';
                    }

                ?>
            </table>
        </div>
    </div><br><br>

    <script>
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