<?php
require_once('../global.php');
$conexao = new Conexao;


if (isset($_GET['id'])) {
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
    <title>Visualizar Cliente</title>
</head>
<body>
    <h1>Visualizar Cliente</h1>
    <p>ID: <?php echo $cliente_data['id']; ?></p>
    <p>Nome: <?php echo $cliente_data['nome']; ?></p>
    <p>Email: <?php echo $cliente_data['email']; ?></p>
    <p>Contato: <?php echo $cliente_data['contato']; ?></p>
</body>
</html>
