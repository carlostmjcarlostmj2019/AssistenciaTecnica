<?php
require_once('../global.php');

$conexao = new Conexao;
$cliente = new Cliente($conexao);
$clientes = $cliente->obterTodosClientes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Todos os Clientes</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilo CSS personalizado -->
    <link rel="stylesheet" href="../style.css">
    <!-- Estilo CSS extra para tabela -->
    <style>
        .table-width-10 {
            width: 100%;
        }

        table {
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #212529;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .btn-primary1 {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary1:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bd2130;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <!-- Incluindo a barra de navegação -->
    <?php include('../navbar.php'); ?>

    <div class="container">
        <h1 class="mt-5">Lista de Clientes</h1>
        <table class="table table-width-10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Contato</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) { ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                        <td><?php echo $cliente['contato']; ?></td>
                        <td>
                            <a href="visualizar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i> Visualizar</a>
                            <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                            <a href="excluir.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</a>
                            <a href="dispositivo.php?id=<?php echo $cliente['id']; ?>" class="btn btn-primary1"><i class="fas fa-plus"></i> Dispositivo</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="novo.php" class="btn btn-primary">Novo Cliente</a>
    </div>
    
    <!-- Incluindo o rodapé -->
    <?php include('../footer.php'); ?>

    <!-- Scripts do Bootstrap (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
