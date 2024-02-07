<?php
require_once('../global.php');
require_once('../Classes/Conexao.php');
require_once('../Classes/Servico.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();

    // Criando uma instância da classe Servico
    $servico = new Servico($conexao);

    // Tentando excluir o serviço
    $resultado = $servico->excluirServico($id);

    if ($resultado) {
        // Redireciona para a página de listagem após a exclusão
        header("Location: index.php");
        exit;
    } else {
        // Exibe mensagem de erro caso a exclusão falhe
        $erro = "Erro ao excluir o serviço.";
    }
} else {
    // Redireciona de volta para a página de listagem se o ID não foi fornecido
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Serviço</title>
</head>
<body>
    <h1>Excluir Serviço</h1>
    <?php if (isset($erro)) { ?>
        <p><?php echo $erro; ?></p>
    <?php } ?>
    <p>Tem certeza de que deseja excluir este serviço?</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
        <input type="submit" value="Confirmar">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
