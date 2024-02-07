<?php
require_once('global.php');

// Verifica se o usuário já está logado, se sim, redireciona para a página de perfil
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();

    // Criando uma instância da classe Usuario
    $usuario = new Usuario($conexao);

    // Verifica se o email já está cadastrado
    if ($usuario->verificarEmailExistente($email)) {
        $erro_cadastro = "Este email já está cadastrado.";
    } else {
        // Cria um novo usuário
        $novoUsuario = $usuario->criarNovoUsuario($nome, $email, $senha);
        if ($novoUsuario) {
            // Cadastro bem-sucedido
            header("Location: login.php");
            exit;
        } else {
            // Falha no cadastro
            $erro_cadastro = "Falha ao cadastrar. Tente novamente mais tarde.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="style.css" rel="stylesheet">
</head>
<body style="background-color: #212529;">
    <!-- Navbar -->
    <?php include('navbar.php');?>

    <!-- Card de Cadastro -->
    <div class="container">
        <div class="login-card card text-center">
            <h1 class="login-card-title mt-5 mb-4">Cadastro</h1>
            <?php if (isset($erro_cadastro)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $erro_cadastro; ?>
                </div>
            <?php } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Seu nome" id="nome" name="nome" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Seu email" id="email" name="email" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Sua senha" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php');?>

    <!-- Scripts do Bootstrap (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
