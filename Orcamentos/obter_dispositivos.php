<?php
require_once('../global.php');

// Verifica se o ID do cliente foi passado na URL
if (!isset($_GET['id_cliente'])) {
    // Retorna uma mensagem de erro se o ID do cliente não estiver definido
    echo "Erro: ID do cliente não especificado.";
    exit;
}

// Obtém o ID do cliente da URL
$idCliente = $_GET['id_cliente'];

// Inicializa a conexão
$conexao = new Conexao();

// Obtém os dispositivos associados ao cliente
$query = "SELECT id, marca, modelo FROM clientes_dispositivos WHERE cliente_id = $idCliente";
$resultado = $conexao->query($query);

// Verifica se há dispositivos associados
if ($resultado->num_rows > 0) {
    // Gera as opções para o select
    $options = "";
    while ($row = $resultado->fetch_assoc()) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['marca'] . " " . $row['modelo'] . "</option>";
    }
    echo $options;
} else {
    // Retorna uma mensagem se não houver dispositivos associados ao cliente
    echo "<option value=''>Nenhum dispositivo encontrado</option>";
}

// Fecha a conexão
$conexao->Desconectar();
?>
