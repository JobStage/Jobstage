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
        $sql = $this->conn->prepare('SELECT * FROM formacao as f
                                        INNER JOIN aluno as a
                                        ON a.ID = f.id_aluno
                                        LEFT JOIN curso_db as c
                                        ON c.ID = f.curso
                                    WHERE f.matricula_valida = 0');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
   
    public function aprovarMatricula($id){
        $sql = $this->conn->prepare("UPDATE formacao
                                        SET matricula_valida = 1
                                     WHERE id_formacao = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        return true;
    }
}

