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
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();

    // Criando uma instância da classe Usuario
    $usuario = new Usuario($conexao);

    // Realiza o login do usuário
    $usuario_logado = $usuario->loginUsuario($email, $senha);

    if ($usuario_logado) {
        // Armazena os dados do usuário na sessão
        $_SESSION['usuario_id'] = $usuario_logado['id'];
        $_SESSION['usuario_nome'] = $usuario_logado['nome'];
        
        // Redireciona para a página de perfil
        header("Location: index.php");
        exit;
    } else {
        // Exibe mensagem de erro caso o login falhe
        $erro_login = "Email ou senha incorretos.";
    }
}
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	  <link href="style.css" rel="stylesheet">

   </head>
<body style="background-color: #212529;">
    <!-- Navbar -->
    <?php include('navbar.php');?>

    <!-- Card de Login -->
    <div class="container">
        <div class="login-card card text-center">
            <h1 class="login-card-title mt-5 mb-4">Bem-vindo de volta!</h1>
            <?php if (isset($erro_login)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $erro_login; ?>
                </div>
            <?php } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
               
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
            <p class="mt-4 mb-0">Não tem uma conta? <a href="#">Cadastre-se agora</a></p>
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
