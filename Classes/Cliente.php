<?php

class Cliente {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para obter todos os clientes
    public function obterTodosClientes() {
        $mysqli = $this->conexao->Conectar();

        $query = "SELECT * FROM clientes";
        $resultado = mysqli_query($mysqli, $query);

        $clientes = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $clientes[] = $row;
        }

        return $clientes;
    }

    // Método para obter um cliente por ID
    public function obterClientePorId($id) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "SELECT * FROM clientes WHERE id = '$id'";
        $resultado = mysqli_query($mysqli, $query);

        return mysqli_fetch_assoc($resultado);
    }

    // Método para editar um cliente
    public function editarCliente($id, $nome, $email, $contato) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);
        $nome = mysqli_real_escape_string($mysqli, $nome);
        $email = mysqli_real_escape_string($mysqli, $email);
        $contato = mysqli_real_escape_string($mysqli, $contato);

        $query = "UPDATE clientes SET nome = '$nome', email = '$email', contato = '$contato' WHERE id = '$id'";
        return mysqli_query($mysqli, $query);
    }

   
    // Método para criar um novo cliente
	public function criarNovoCliente($nome, $email, $contato, $senha) {
		$mysqli = $this->conexao->Conectar();
		$nome = mysqli_real_escape_string($mysqli, $nome);
		$email = mysqli_real_escape_string($mysqli, $email);
		$contato = mysqli_real_escape_string($mysqli, $contato);
		$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

		// Verifica se o email já está cadastrado
		$query_verifica_email = "SELECT id FROM clientes WHERE email = '$email'";
		$resultado_verifica_email = mysqli_query($mysqli, $query_verifica_email);

		if (mysqli_num_rows($resultado_verifica_email) > 0) {
			return false; // Cliente já existe
		}

		// Insere o novo cliente caso o email não exista
		$query = "INSERT INTO clientes (nome, email, contato, senha) VALUES ('$nome', '$email', '$contato', '$senha_hash')";
		return mysqli_query($mysqli, $query);
	}


    // Método para excluir um cliente
    public function excluirCliente($id) {
        $mysqli = $this->conexao->Conectar();
        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "DELETE FROM clientes WHERE id = '$id'";
        return mysqli_query($mysqli, $query);
    }
	
	
	
	// Método para adicionar um dispositivo à tabela clientes_Dispositivos
	public function adicionarDispositivoCliente($clienteId, $marca, $modelo, $dispositivo) {
		$mysqli = $this->conexao->Conectar();
		$clienteId = mysqli_real_escape_string($mysqli, $clienteId);
		$marca = mysqli_real_escape_string($mysqli, $marca);
		$modelo = mysqli_real_escape_string($mysqli, $modelo);
		$dispositivo = mysqli_real_escape_string($mysqli, $dispositivo);

		// Insere o dispositivo associado ao cliente na tabela clientes_Dispositivos
		$query = "INSERT INTO clientes_Dispositivos (cliente_id, marca, modelo, dispositivo, data_criado, data_atualizado) VALUES ('$clienteId', '$marca', '$modelo', '$dispositivo', NOW(), NOW())";
		return mysqli_query($mysqli, $query);
	}


	
}


?>
