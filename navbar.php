<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Página Inicial</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['usuario_id'])) { ?>
                    <!-- Se o usuário estiver logado -->
                    <li class="nav-item">
                        <span class="nav-link">Olá, <?php echo $_SESSION['usuario_nome']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $URL_SITE ?>logout.php"><i class="fas fa-sign-out-alt mr-1"></i>Sair</a>
                    </li>
                <?php } else { ?>
                    <!-- Se o usuário não estiver logado -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $URL_SITE ?>login.php"><i class="fas fa-sign-in-alt mr-1"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $URL_SITE ?>cadastro.php"><i class="fas fa-user-plus mr-1"></i>Cadastro</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
