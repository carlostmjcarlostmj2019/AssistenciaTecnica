<?php

class Orcamento {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para adicionar um novo orçamento
    public function adicionarOrcamento($idCliente, $idServico, $idDispositivo, $orcamento) {
        $mysqli = $this->conexao->Conectar();

        // Verifica se os IDs do cliente, serviço e dispositivo existem
        if (!$this->verificarExistencia($idCliente, 'clientes') || 
            !$this->verificarExistencia($idServico, 'servicos') ||
            !$this->verificarExistencia($idDispositivo, 'clientes_dispositivos')) {
            return false; // Se algum dos IDs não existir, retorna falso
        }

        // Cria o registro de orçamento na tabela de orçamentos
        $query = "INSERT INTO clientes_orçamentos (cliente_id, servico_id, dispositivo_id, orçamento) VALUES ('$idCliente', '$idServico', '$idDispositivo', '$orcamento')";
        $resultado = mysqli_query($mysqli, $query);

        return $resultado;
    }

    // Método para verificar se um determinado ID existe em uma tabela específica
    private function verificarExistencia($id, $tabela) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "SELECT id FROM $tabela WHERE id = '$id'";
        $resultado = mysqli_query($mysqli, $query);

        return mysqli_num_rows($resultado) > 0;
    }
}

?>
