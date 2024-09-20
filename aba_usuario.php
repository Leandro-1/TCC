<div id="usuarios" class="w3-container w3-border menu" style="display:none">
    <div class="w3-container w3-display-top">
        <h2 class="w3-center"><b>Consulta de Usuários</b></h2>

        <!--Cadastro de usuários com caixa Modal -->
        <button onclick="document.getElementById('cad_usuario').style.display='block'" class="botao_cad w3-right w3-round-xlarge  w3-large w3-padding w3-display-top" type="submit">Novo Cadastro</button>

        <div id="cad_usuario" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('cad_usuario').style.display='none'" class="w3-button w3-display-topright w3-hover-red w3-large"><b>&times;</b></span>
                    <div class="feedbackMessage w3-padding"></div>
                    <div class="w3-container w3-content ">
                        <h2 class="w3-center w3-padding"><b>Cadastrar Usuários</b></h2><br>
                        <form id="myForm_usuario" action="cadastro_usuarioAction.php" method="post" class="w3-padding">
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
                                <select class="slc-usuario" name="privilegio" required>
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
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container">
                    <h1 class="w3-center w3-padding"><b>Editar Usuário</b></h1>
                    <form id="form_editar_usuario" action="editar_usuarioAction.php" method='post' class="w3-padding">
                        <input id="id_user" name="id_user" class="w3-input w3-grey w3-border" type="hidden">
                        <br>
                        <label class="w3-text-black" style="font-weight: bold;">Nome</label>
                        <input id="nome_user" name="nome" class="w3-input w3-light-grey w3-border" required>
                        <br>
                        <label class="w3-text-black" style="font-weight: bold;">Login</label>
                        <input id="login_user" name="login_user" class="w3-input w3-light-grey w3-border" required>
                        <br>
                        <label for="privilegio" class="w3-text-black" style="font-weight: bold;">Privilégio</label>
                        <select class="slc-usuario w3-light-grey" id="privilegio_user" name="privilegio" required>
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
                <div class="feedbackMessage w3-padding"></div>
                <div class="w3-container w3-padding">
                    <h2 class="w3-center w3-padding"><b>Excluir Usuário</b></h2>
                    <form id="form_excluir_usuario" action="excluir_usuarioAction.php" method='post' class="w3-padding">
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