<?php

require_once __DIR__."/../config/conexao.php";


class matriculaModel{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function getAllMatriculas(){
        $sql = $this->conn->prepare('SELECT * FROM formacao
                                    WHERE matricula_valida = 0');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
}

