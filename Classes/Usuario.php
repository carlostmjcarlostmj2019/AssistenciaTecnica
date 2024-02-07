<?php

class Usuario {
    private $conexao;

    // Método construtor para obter a conexão
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    // Método para obter informações do usuário por ID
    public function obterUsuarioPorId($id) {
        $mysqli = $this->conexao->Conectar();

        $id = mysqli_real_escape_string($mysqli, $id);

        $query = "SELECT * FROM usuarios WHERE id = $id";
        $resultado = mysqli_query($mysqli, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null; // Usuário não encontrado
        }

        $this->conexao->Desconectar();
    }

    // Método para criar um novo usuário e salvar no banco de dados
    public function criarNovoUsuario($nome, $email, $senha) {
        $mysqli = $this->conexao->Conectar();

        $nome = mysqli_real_escape_string($mysqli, $nome);
        $email = mysqli_real_escape_string($mysqli, $email);
        // Criando um hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        $resultado = mysqli_query($mysqli, $query);

        if ($resultado) {
            return mysqli_insert_id($mysqli); // Retorna o ID do novo usuário inserido
        } else {
            return false; // Falha ao criar o usuário
        }

        $this->conexao->Desconectar();
    }

    // Método para verificar se um email já está cadastrado
    public function verificarEmailExistente($email) {
        $mysqli = $this->conexao->Conectar();

        $email = mysqli_real_escape_string($mysqli, $email);

        $query = "SELECT id FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($mysqli, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return true; // O email já está cadastrado
        } else {
            return false; // O email não está cadastrado
        }

        $this->conexao->Desconectar();
    }
	
	  // Método para realizar login de usuário
    public function loginUsuario($email, $senha) {
        $mysqli = $this->conexao->Conectar();

        $email = mysqli_real_escape_string($mysqli, $email);
        $senha = mysqli_real_escape_string($mysqli, $senha);

        // Busca o usuário pelo email
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($mysqli, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);
            // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $usuario['senha'])) {
                return $usuario; // Retorna os dados do usuário se login for bem-sucedido
            }
        }

        return null; // Login falhou
    }

}

?>
