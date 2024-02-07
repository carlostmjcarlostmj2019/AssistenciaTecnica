<?php

class Servico {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para obter todos os serviços
    public function obterTodosServicos() {
        $mysqli = $this->conexao->Conectar();

        $query = "SELECT * FROM servicos";
        $resultado = mysqli_query($mysqli, $query);

        $servicos = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $servicos[] = $row;
        }

        return $servicos;
    }

    // Método para obter um serviço por ID
    public function obterServicoPorId($id) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "SELECT * FROM servicos WHERE id = '$id'";
        $resultado = mysqli_query($mysqli, $query);

        return mysqli_fetch_assoc($resultado);
    }

    // Método para criar um novo serviço
    public function criarNovoServico($nome, $descricao, $valor) {
        $mysqli = $this->conexao->Conectar();
        $nome = mysqli_real_escape_string($mysqli, $nome);
        $descricao = mysqli_real_escape_string($mysqli, $descricao);
        $valor = mysqli_real_escape_string($mysqli, $valor);

        $query = "INSERT INTO servicos (nome, descricao, valor) VALUES ('$nome', '$descricao', '$valor')";
        return mysqli_query($mysqli, $query);
    }

    // Método para editar um serviço
    public function editarServico($id, $nome, $descricao, $valor) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);
        $nome = mysqli_real_escape_string($mysqli, $nome);
        $descricao = mysqli_real_escape_string($mysqli, $descricao);
        $valor = mysqli_real_escape_string($mysqli, $valor);

        $query = "UPDATE servicos SET nome = '$nome', descricao = '$descricao', valor = '$valor' WHERE id = '$id'";
        return mysqli_query($mysqli, $query);
    }

    // Método para excluir um serviço
    public function excluirServico($id) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "DELETE FROM servicos WHERE id = '$id'";
        return mysqli_query($mysqli, $query);
    }
}

?>
