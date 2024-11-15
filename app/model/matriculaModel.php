<?php

require_once __DIR__."/../config/conexao.php";


class matriculaModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function getAllMatriculas(){
        try {
            $sql = $this->conn->prepare('SELECT * FROM formacao as f
                                            INNER JOIN aluno as a
                                            ON a.ID = f.id_aluno
                                            LEFT JOIN curso_db as c
                                            ON c.ID = f.curso
                                        WHERE f.matricula_valida = 0');
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
   
    public function aprovarMatricula($id){
        try {
            $sql = $this->conn->prepare("UPDATE formacao
                                            SET matricula_valida = 1
                                         WHERE id_formacao = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            return true;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function reprovarMatricula($id){
        try {
            $sql = $this->conn->prepare("UPDATE formacao
                                            SET matricula_valida = 2
                                         WHERE id_formacao = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            return true;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}

