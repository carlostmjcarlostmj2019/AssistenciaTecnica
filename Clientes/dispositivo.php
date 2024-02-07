<?php
require_once('../global.php');

// Verifica se o ID do cliente foi passado na URL
if (!isset($_GET['id'])) {
    // Redireciona de volta para a página anterior se o ID do cliente não estiver definido
    header("Location: index.php");
    exit;
}

// Obtém o ID do cliente da URL
$clienteId = $_GET['id'];

$conexao = new Conexao();
$cliente = new Cliente($conexao);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $dispositivo = $_POST['dispositivo'];

    // Adicione o dispositivo ao cliente
    $resultado = $cliente->adicionarDispositivoCliente($clienteId, $marca, $modelo, $dispositivo);

    // Verifique se o dispositivo foi adicionado com sucesso
    if ($resultado) {
        echo "Dispositivo adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar o dispositivo.";
    }
}

// Obtenha o cliente específico pelo ID fornecido na URL
$clienteDetalhes = $cliente->obterClientePorId($clienteId);

// Verifica se o cliente foi encontrado
if (!$clienteDetalhes) {
    // Redireciona de volta para a página anterior se o cliente não for encontrado
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Dispositivo ao Cliente</title>
</head>
<body>
    <h1>Adicionar Dispositivo ao Cliente: <?php echo $clienteDetalhes['nome']; ?></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $clienteId; ?>">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>
        <label for="dispositivo">Dispositivo:</label>
        <input type="text" id="dispositivo" name="dispositivo" required><br><br>
        <input type="submit" value="Adicionar Dispositivo">
    </form>
</body>
</html>
