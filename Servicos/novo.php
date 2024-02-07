<?php
require_once('../global.php');
require_once('../Classes/Conexao.php');
require_once('../Classes/Servico.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();

    // Criando uma instância da classe Servico
    $servico = new Servico($conexao);

    // Tentando criar um novo serviço
    $resultado = $servico->criarNovoServico($nome, $descricao, $valor);

    if ($resultado) {
        // Redireciona para a página de listagem após a criação
        header("Location: index.php");
        exit;
    } else {
        // Exibe mensagem de erro caso a criação falhe
        $erro = "Erro ao criar novo serviço.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Serviço</title>
</head>
<body>
    <h1>Novo Serviço</h1>
    <?php if (isset($erro)) { ?>
        <p><?php echo $erro; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>
        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" required><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
