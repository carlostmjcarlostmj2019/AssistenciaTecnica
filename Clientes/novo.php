<?php
require_once('../global.php');
$conexao = new Conexao;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $contato = $_POST['contato'];

    // Crie um novo cliente
    $cliente = new Cliente($conexao);
    $cliente->criarNovoCliente($nome, $email, $contato, $senha); // Adicione a senha como quarto argumento

    // Redirecione para a página de visualização após a criação
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Clientes</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilo CSS personalizado -->
    <link rel="stylesheet" href="../style.css">
    <!-- Estilo CSS extra para tabela -->
    
</head>
<body>
    <!-- Incluindo a barra de navegação -->
    <?php include('../navbar.php'); ?>

    <div class="container">
        <h1>Novo Cliente</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contato">Contato:</label>
                <input type="text" id="contato" name="contato" class="form-control" required>
            </div>
            <input type="submit" value="Salvar" class="btn btn-primary">
        </form>
    </div>
    
    <!-- Incluindo o rodapé -->
    <?php include('../footer.php'); ?>

    <!-- Scripts do Bootstrap (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
