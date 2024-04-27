<?php

class Conexao {
    
    private $host = 'localhost';
    private $db = 'jobstage';
    private $user = 'root';
    private $passwd = '';

    public function __construct() {
        $this->conn();
    }

    public function conn(){
        try{
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->passwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e){
            echo "Error -> " . $e->getMessage();
            return null;
        }
    }
}
$conexao = new Conexao();