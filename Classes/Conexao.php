<?php

class Conexao {
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "assistencia";
    private $conexao;

    // Método construtor para estabelecer a conexão
    public function __construct() {
        $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);

        if (mysqli_connect_errno()) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        // Define o conjunto de caracteres para UTF-8 (opcional, dependendo do seu caso)
        mysqli_set_charset($this->conexao, "utf8");
    }

    // Método para obter a conexão
    public function Conectar() {
        return $this->conexao;
    }

    // Método para fechar a conexão
    public function Desconectar() {
        mysqli_close($this->conexao);
    }
	
	 // Método para executar uma consulta SQL
    public function query($sql) {
        return $this->conexao->query($sql);
    }
	
}

