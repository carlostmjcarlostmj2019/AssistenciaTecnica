<?php
require_once('../global.php');
$conexao = new Conexao;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];

    // Atualize o cliente
    $cliente = new Cliente($conexao);
    $cliente->editarCliente($id, $nome, $email, $contato);

    // Redirecione para a página de visualização após a edição
    header("Location: index.php");
    exit;
} elseif (isset($_GET['id'])) {
    // Obtenha o ID do cliente da consulta GET
    $id = $_GET['id'];

    // Obtenha os dados do cliente por ID
    $cliente = new Cliente($conexao);
    $cliente_data = $cliente->obterClientePorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $cliente_data['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $cliente_data['nome']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente_data['email']; ?>"><br><br>
        <label for="contato">contato:</label>
        <input type="text" id="contato" name="contato" value="<?php echo $cliente_data['contato']; ?>"><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
