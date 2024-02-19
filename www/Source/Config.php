<?php

class Config
{
    // private $host = 'db'; // Endereço do banco de dados
    // private $db_name = 'spot'; // Nome do banco de dados
    // private $username = 'root'; // Nome de usuário do banco de dados
    // private $password = 'root'; // Senha do banco de dados

    private $host = 'db';
private $db_name = 'spot';
private $username = 'myuser';
private $password = 'mypassword';

    private $conn; // Variável para armazenar a conexão MySQL

    // Método para obter a conexão com o banco de dados
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password);
            mysqli_select_db($this->conn, $this->db_name); // Correção aqui
        } catch (Exception $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
