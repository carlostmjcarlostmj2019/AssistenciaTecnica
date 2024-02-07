<?php
require_once('../global.php');

// Verifica se o ID do cliente foi passado na URL
if (!isset($_GET['id'])) {
    // Redireciona de volta para a página anterior se o ID do cliente não estiver definido
    header("Location: index.php");
    exit;
}

// Obtém o ID do cliente da URL
$idCliente = $_GET['id'];

// Inicializa a conexão
$conexao = new Conexao();

// Criar uma instância da classe Cliente
$cliente = new Cliente($conexao);

// Obtém os dados do cliente pelo ID
$clienteData = $cliente->obterClientePorId($idCliente);

// Consulta o banco de dados para obter os orçamentos do cliente
$query = "SELECT * FROM clientes_orçamentos WHERE cliente_id = $idCliente";
$resultado = $conexao->query($query);

// Verifica se há orçamentos associados ao cliente
if ($resultado->num_rows > 0) {
    // Exibe os orçamentos em uma tabela
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orçamentos do Cliente</title>
    </head>
    <body>
        <h1>Orçamentos do Cliente: <?php echo $clienteData['nome']; ?></h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID do Cliente</th>
                    <th>ID do Dispositivo</th>
                    <th>ID do Serviço</th>
                    <th>Valor do Orçamento</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['cliente_id']; ?></td>
                        <td><?php echo $row['dispositivo_id']; ?></td>
                        <td><?php echo $row['servico_id']; ?></td>
                        <td><?php echo $row['orçamento']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php
} else {
    // Retorna uma mensagem se não houver orçamentos associados ao cliente
    echo "<h1>Nenhum orçamento encontrado para o Cliente ID: $idCliente</h1>";
}

// Fecha a conexão
$conexao->Desconectar();
?>
