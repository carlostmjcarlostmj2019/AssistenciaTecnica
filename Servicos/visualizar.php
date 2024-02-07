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

    // Obtendo os detalhes do serviço por ID
    $detalhesServico = $servico->obterServicoPorId($id);
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
    <title>Visualizar Serviço</title>
</head>
<body>
    <h1>Detalhes do Serviço</h1>
    <p>ID: <?php echo $detalhesServico['id']; ?></p>
    <p>Nome: <?php echo $detalhesServico['nome']; ?></p>
    <p>Descrição: <?php echo $detalhesServico['descricao']; ?></p>
    <p>Valor: <?php echo $detalhesServico['valor']; ?></p>
    <p>Data Criado: <?php echo $detalhesServico['data_criado']; ?></p>
    <p>Data Atualizado: <?php echo $detalhesServico['data_atualizado']; ?></p>
</body>
</html>
