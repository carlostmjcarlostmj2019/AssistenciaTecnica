<?php

require_once("global.php");

// Verifica se o usuário não está logado, se não estiver, redireciona para a página de login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Cria uma instância da classe Conexao
$conexao = new Conexao();

// Cria uma instância da classe Dashboard
$dashboard = new Dashboard($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <!-- Integração do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ícones do Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="style.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-title {
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-link {
            color: inherit; /* Remove a cor padrão do link */
            text-decoration: none; /* Remove o sublinhado do link */
        }

        .card-link:hover {
            color: inherit; /* Mantém a cor do link ao passar o mouse sobre ele */
        }

        .card-link:focus {
            color: inherit; /* Mantém a cor do link quando ele recebe foco */
        }

        .card-link:visited {
            color: inherit; /* Mantém a cor do link depois de visitado */
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">
    <!-- Navbar -->
    <?php include('navbar.php');?>

    <div class="container">
        <h1 class="mt-5">Bem-vindo à página inicial</h1>
        <p>Olá, <?php echo $_SESSION['usuario_nome']; ?>! Você está logado.</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="clientes/index.php" class="card-link">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users mr-2"></i>Total de Clientes</h5>
                            <p class="card-text"><?php echo $dashboard->getTotalClientes(); ?></p>
                            <?php $percentualClientes = $dashboard->calcularDiferencaPercentual('clientes'); ?>
                            <?php if ($percentualClientes > 0) { ?>
                                <p class="card-text text-success">+<?php echo round($percentualClientes, 2); ?>% desde o último mês</p>
                            <?php } elseif ($percentualClientes < 0) { ?>
                                <p class="card-text text-danger"><?php echo round($percentualClientes, 2); ?>% desde o último mês</p>
                            <?php } else { ?>
                                <p class="card-text">Sem mudança desde o último mês</p>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="orcamentos/index.php" class="card-link">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-money-bill-wave mr-2"></i>Total de Orçamentos</h5>
                            <p class="card-text"><?php echo $dashboard->getTotalOrcamentos(); ?></p>
                            <?php $percentualOrcamentos = $dashboard->calcularDiferencaPercentual('clientes_orçamentos'); ?>
                            <?php if ($percentualOrcamentos > 0) { ?>
                                <p class="card-text text-success">+<?php echo round($percentualOrcamentos, 2); ?>% desde o último mês</p>
                            <?php } elseif ($percentualOrcamentos < 0) { ?>
                                <p class="card-text text-danger"><?php echo round($percentualOrcamentos, 2); ?>% desde o último mês</p>
                            <?php } else { ?>
                                <p class="card-text">Sem mudança desde o último mês</p>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="dispositivos/index.php" class="card-link">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-mobile-alt mr-2"></i>Total de Dispositivos</h5>
                            <p class="card-text"><?php echo $dashboard->getTotalDispositivos(); ?></p>
                            <?php $percentualDispositivos = $dashboard->calcularDiferencaPercentual('clientes_dispositivos'); ?>
                            <?php if ($percentualDispositivos > 0) { ?>
                                <p class="card-text text-success">+<?php echo round($percentualDispositivos, 2); ?>% desde o último mês</p>
                            <?php } elseif ($percentualDispositivos < 0) { ?>
                                <p class="card-text text-danger"><?php echo round($percentualDispositivos, 2); ?>% desde o último mês</p>
                            <?php } else { ?>
                                <p class="card-text">Sem mudança desde o último mês</p>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <p><a href="logout.php" class="btn btn-danger">Sair</a></p>
    </div>

    <!-- Footer -->
    <?php include('footer.php');?>

    <!-- Scripts do Bootstrap (jQuery e Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
