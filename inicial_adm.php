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
    <div id="entregas" class="w3-container w3-border w3-white menu">
        <div class="w3-container w3-display-top">
            <h2 class="w3-center"><b>Consulta de Entregas</b></h2>

            <!--Cadastro de entregas - editar - excluir  -->
          <?php require_once('cadastro_entrega.php')?>

       <!--Editar moradores -->
<div id="editar_morador" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('editar_morador').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
            <h1 class="w3-center"><b>Editar Morador</b></h1>
            <form action="editar_moradorAction.php" method='post' class="w3-padding">
                <div class="w3-cell-row">
                    <input id="cpf" name="cpf" class="w3-input w3-grey w3-border" type="hidden">

                    <div class="w3-cell">
                        <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                        <input id="nome" name="nome" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
                <div class="w3-cell-row">
                    <div class="w3-cell" style="padding-right: 15px; width:30%;">
                        <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                        <input id="tel" name="tel" class="w3-input w3-light-grey w3-border">
                    </div>
                    <div>
                        <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                        <input id="email" name="email" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
                <div class="w3-cell-row">
                    <div class="w3-cell" style="padding-right: 15px;">
                        <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                        <input id="num_apart" name="num_apart" class="w3-input w3-light-grey w3-border">
                    </div>
                    <div class="w3-cell">
                        <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                        <input id="bloco_quadra" name="bloco_quadra" class="w3-input w3-light-grey w3-border">
                    </div>
                </div><br>
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
                        <input id="txtcpf" name="cpf" class="w3-input w3-grey w3-border" type="hidden" readonly>

                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                            <input id="txtnome" name="tel" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <div class="w3-cell-row">
                        <div class="w3-cell" style="padding-right: 15px; width:30%;">
                            <label class="w3-text-black" style="font-weight: bold;">Telefone</label>
                            <input id="txttel" name="nome" class="w3-input w3-grey w3-border" readonly>
                        </div>
                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">E-mail</label>
                            <input id="txtemail" name="email" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <div class="w3-cell-row">
                        <div class="w3-cell" style="padding-right: 15px;">
                            <label class="w3-text-black" style="font-weight: bold;">Apartamento</label>
                            <input id="numapart" name="numapart" class="w3-input w3-grey w3-border" readonly>
                        </div>
                        <div class="w3-cell">
                            <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                            <input id="txtbloco" name="bloco" class="w3-input w3-grey w3-border" readonly>
                        </div>
                    </div><br>
                    <button class="w3-btn w3-black" type="submit">Confirmar Exclusão</button>

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
                        <div class="feedbackMessage"></div>
                        <div class="w3-container w3-content ">
                            <h2 class="w3-center"><b>Cadastrar Usuários</b></h2>
                            <br>
                            <form id="myForm3" action="cadastro_usuarioAction.php" method="post" class="w3-padding">
                                <div class="w3-margin-bottom">
                                    <div class="w3-cell-row">
                                        <div class="w3-cell" style="width: 30%; padding-right: 15px;">
                                            <label for="codigo"><b>Código</b></label>
                                            <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" readonly>
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
                                        <option value="morador">Morador</option>
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
                        echo '<td><button onclick="excluirUsuario(\'' . $linha['id_user'] . '\', \'' . $linha['nome'] . '\', \'' . $linha['login'] . '\', \'' . $linha['privilegio'] . '\')"><i class="fa fa-user-times w3-large w3-text-black"></i></button></td>';
                        echo '<td><button onclick="editarUsuario(\'' . $linha['id_user'] . '\', \'' . $linha['nome'] . '\', \'' . $linha['login'] . '\', \'' . $linha['privilegio'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
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
                            <input id="id_user" name="id_user" class="w3-input w3-grey w3-border" type="hidden">
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                            <input id="nome_user" name="nome" class="w3-input w3-light-grey w3-border">
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Login</label>
                            <input id="login_user" name="login_user" class="w3-input w3-light-grey w3-border">
                            <br>
                            <label for="privilegio" class="w3-text-black" style="font-weight: bold;">Privilégio</label>
                            <select class="slc-usuario w3-light-grey" id="privilegio_user" name="privilegio">
                                <option value="administrador" <?php echo $linha['privilegio'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                <option value="operador" <?php echo $linha['privilegio'] == 'operador' ? 'selected' : ''; ?>>Operador</option>
                                <option value="morador" <?php echo $linha['privilegio'] == 'morador' ? 'selected' : ''; ?>>Morador</option>
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
                            <input id="user" name="user" class="w3-input w3-grey w3-border" readonly>
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                            <input id="nome_usuario" name="nome" class="w3-input w3-grey w3-border" readonly>
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Login</label>
                            <input id="login" name="login" class="w3-input w3-grey w3-border" readonly>
                            <br>
                            <label for="privilegio" class="w3-text-black" style="font-weight: bold;">Privilégio</label>
                            <select class="slc-usuario w3-grey" id="privilegio" name="privilegio" readonly>
                                <option value="administrador" <?php echo $linha['privilegio'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                <option value="operador" <?php echo $linha['privilegio'] == 'operador' ? 'selected' : ''; ?>>Operador</option>
                                <option value="morador" <?php echo $linha['privilegio'] == 'morador' ? 'selected' : ''; ?>>Morador</option>
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
                        <div class="feedbackMessage"></div>
                        <div class="w3-container">
                            <h1 class="w3-center"><b>Cadastrar Propriedade</b></h1>

                            <form id="myForm4" action="cadastro_propriedadeAction.php" method="post" class="w3-padding">
                                <div class="w3-container w3-margin-bottom">
                                    <div class="cod" style="width:35%;">
                                        <label for="codigo"><b>Código</b> </label>
                                        <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" readonly>
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
                    echo '<td><button onclick="editarPropriedade(\'' . $linha['id_propriedade'] . '\', \'' . $linha['num_propriedade'] . '\', \'' . $linha['bloco_quadra'] . '\')"><i class="fa fa-pen-to-square w3-large w3-text-black"></i></button></td>';
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
                            <input id="txtCodigo" name="txtCodigo" class="w3-input w3-grey w3-border">
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Número</label>
                            <input id="txtNumero" name="txtNumero" class="w3-input w3-light-grey w3-border">
                            <br>
                            <label class="w3-text-black" style="font-weight: bold;">Bloco/Quadra</label>
                            <input id="txtBloco" name="txtBloco" class="w3-input w3-light-grey w3-border">
                            <br>
                            <button class="w3-btn w3-black" type="submit">ATUALIZAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div><br><br>

<?php require_once('rodape.php'); ?>