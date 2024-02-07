<?php
require_once('../global.php');

// Verifica se foi fornecido um ID de dispositivo na requisição GET
if (isset($_GET['id'])) {
    $idDispositivo = $_GET['id'];

    // Criando uma instância da classe Conexao
    $conexao = new Conexao();
    $mysqli = $conexao->Conectar(); // Obter a conexão mysqli

    // Verificar se há erro na conexão
    if ($mysqli->connect_errno) {
        echo "Falha na conexão com o banco de dados: " . $mysqli->connect_error;
        exit();
    }

    // Consulta para obter o valor do dispositivo pelo ID
    $query = "SELECT valor FROM dispositivo_preço WHERE id = $idDispositivo";
    $resultado = $mysqli->query($query);

    if ($resultado->num_rows > 0) {
        // Se o dispositivo existir na tabela, retorna o valor
        $dispositivo = $resultado->fetch_assoc();
        echo $dispositivo['valor'];
    } else {
        // Se o dispositivo não existir, retorna 0
        echo "0";
    }
} else {
    // Se nenhum ID de dispositivo foi fornecido, retorna 0
    echo "0";
}
?>
