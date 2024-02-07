<?php

class Dashboard
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function getTotal($tabela)
    {
        $query = "SELECT COUNT(*) AS total FROM $tabela";
        $resultado = $this->conexao->query($query);
        $total = $resultado->fetch_assoc()['total'];
        return $total;
    }

    public function getTotalClientes()
    {
        return $this->getTotal('clientes');
    }

    public function getTotalOrcamentos()
    {
        return $this->getTotal('clientes_orçamentos');
    }

    // Método para obter o total de dispositivos
    public function getTotalDispositivos()
    {
        return $this->getTotal('clientes_dispositivos');
    }

    // Método para obter o número de registros no mês anterior
    public function getTotalRegistrosMesAnterior($tabela)
    {
        $query = "SELECT COUNT(*) AS total_registros FROM $tabela WHERE MONTH(data_criado) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)";
        $resultado = $this->conexao->query($query);
        $total = $resultado->fetch_assoc()['total_registros'];
        return $total;
    }

    // Método para calcular a diferença percentual entre o número atual de registros e o número de registros do mês anterior
    public function calcularDiferencaPercentual($tabela)
    {
        $totalAtual = $this->getTotal($tabela);
        $totalMesAnterior = $this->getTotalRegistrosMesAnterior($tabela);

        if ($totalMesAnterior > 0) {
            $diferencaPercentual = (($totalAtual - $totalMesAnterior) / $totalMesAnterior) * 100;
        } else {
            $diferencaPercentual = 0;
        }

        return $diferencaPercentual;
    }
}

?>
