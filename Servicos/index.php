<?php
require_once('../global.php');

$conexao = new Conexao();
$servico = new Servico($conexao);
$servicos = $servico->obterTodosServicos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Serviços</title>
</head>
<body>
    <h1>Listagem de Serviços</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data Criado</th>
                <th>Data Atualizado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicos as $servico) { ?>
                <tr>
                    <td><?php echo $servico['id']; ?></td>
                    <td><?php echo $servico['nome']; ?></td>
                    <td><?php echo $servico['descricao']; ?></td>
                    <td><?php echo $servico['valor']; ?></td>
                    <td><?php echo $servico['data_criado']; ?></td>
                    <td><?php echo $servico['data_atualizado']; ?></td>
                    <td>
                        <a href="visualizar.php?id=<?php echo $servico['id']; ?>">Visualizar</a>
                        <a href="editar.php?id=<?php echo $servico['id']; ?>">Editar</a>
                        <a href="excluir.php?id=<?php echo $servico['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="novo.php">Novo Serviço</a>
</body>
</html>
