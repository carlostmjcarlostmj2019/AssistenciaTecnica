<?php
require_once('../global.php');
require_once('../Classes/Conexao.php');
require_once('../Classes/Servico.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();

    // Criando uma instância da classe Servico
    $servico = new Servico($conexao);

    // Tentando editar o serviço
    $resultado = $servico->editarServico($id, $nome, $descricao, $valor);

    if ($resultado) {
        // Redireciona para a página de listagem após a edição
        header("Location: index.php");
        exit;
    } else {
        // Exibe mensagem de erro caso a edição falhe
        $erro = "Erro ao editar o serviço.";
    }
} else {
    // Verifica se o ID do serviço foi fornecido via GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Criando uma instância da classe Conexao
        $conexao = new Conexao();

        // Criando uma instância da classe Servico
        $servico = new Servico($conexao);

        // Obtendo os detalhes do serviço por ID
        $detalhesServico = $servico->obterServicoPorId($id);
    } else {
        // Redireciona de volta para a página de listagem se o ID não foi fornecido
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
</head>
<body>
    <h1>Editar Serviço</h1>
    <?php if (isset($erro)) { ?>
        <p><?php echo $erro; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $detalhesServico['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $detalhesServico['nome']; ?>" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo $detalhesServico['descricao']; ?></textarea><br><br>
        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" value="<?php echo $detalhesServico['valor']; ?>" required><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
