<?php require_once("verificaacesso_admin.php"); ?>
<?php require_once('cabecalho.php'); ?>

<style>
    .slc-usuario {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>
<title>Cadastrar Usuários</title>
</head>

<body>
    <div class="w3-container w3-card w3-round w3-padding">
        <h2 class="w3-center"><b>Cadastrar Usuários</b></h2>
        <br>
        <form action="cadastro_usuarioAction.php" method="post">
            <div class="w3-margin-bottom">
                <label for="codigo">Código</label>
                <input class="w3-input w3-border w3-light-grey" type="text" name="codigo" disabled>
                <br>
                <label for="nome">Nome</label>
                <input class="w3-input w3-border" type="text" name="nome" required>
                <br>
                <label for="login">Login</label>
                <input class="w3-input w3-border" type="text" name="login" required>
                <br>
                <label for="senha">Senha</label>
                <input class="w3-input w3-border w3-margin-bottom" type="password" name="senha" required>
                <br>
                <label for="privilegio">Privilégio</label>
                <select class="slc-usuario" name="privilegio">
                    <option value="administrador">Administrador</option>
                    <option value="operador" selected>Operador</option>
                </select>
                <br><br>
                <button class="w3-btn w3-black" type="submit">CADASTRAR</button>
                <br><br>

            </div>
        </form>
        <div class="w3-center">
            <a href="usuario.php" class="w3-display-top-center">
                <i class="fa fa-arrow-circle-left w3-xxlarge w3-button"></i>
            </a>

            <a href="menu.php" class="w3-display-top-center">
                <i class="fa fa-home w3-xxlarge w3-button"></i>
            </a>
            <a href="consultar_usuario.php" class="w3-display-top-center">
                <i class="fa-solid fa-list w3-xxlarge w3-button"></i>
            </a>
        </div>
    </div>

    <?php require_once('rodape.php'); ?>