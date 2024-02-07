<?php
require_once('../global.php');

// Inicializa a conexão
$conexao = new Conexao();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $idCliente = $_POST['id_cliente'];
    $idServico = $_POST['id_servico'];
    $idDispositivo = $_POST['id_dispositivo'];
    $orcamento = $_POST['orcamento'];

    // Cria uma instância da classe Orcamento
    $orcamentoObj = new Orcamento($conexao);

    // Tenta adicionar um novo orçamento
    $resultado = $orcamentoObj->adicionarOrcamento($idCliente, $idServico, $idDispositivo, $orcamento);

    if ($resultado) {
        echo "Orçamento criado com sucesso.";
    } else {
        echo "Erro ao criar o orçamento.";
    }
}

// Obtém todos os clientes disponíveis
$clientes = $conexao->query("SELECT id, nome FROM clientes");

// Obtém todos os serviços disponíveis
$servicos = $conexao->query("SELECT id, nome FROM servicos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Orçamento</title>
</head>
<body>
    <h1>Criar Orçamento</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="id_cliente">Cliente:</label>
        <select name="id_cliente" id="id_cliente" required>
            <?php while ($cliente = $clientes->fetch_assoc()) { ?>
                <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></option>
            <?php } ?>
        </select><br><br>

        <label for="id_servico">Serviço:</label>
        <select name="id_servico" id="id_servico" required>
            <?php while ($servico = $servicos->fetch_assoc()) { ?>
                <option value="<?php echo $servico['id']; ?>"><?php echo $servico['nome']; ?></option>
            <?php } ?>
        </select><br><br>

        <label for="id_dispositivo">Dispositivo:</label>
        <select name="id_dispositivo" id="id_dispositivo" required>
            <!-- Este select será populado dinamicamente após selecionar o cliente -->
        </select><br><br>

        <label for="orcamento">Orçamento:</label>
        <input type="text" name="orcamento" required><br><br>

        <input type="submit" value="Criar Orçamento">
    </form>

    <script>
        // Função para carregar dispositivos relacionados ao cliente selecionado
        document.getElementById("id_cliente").addEventListener("change", function() {
            var idCliente = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("id_dispositivo").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "obter_dispositivos.php?id_cliente=" + idCliente, true);
            xhr.send();
        });
    </script>
</body>
</html>
