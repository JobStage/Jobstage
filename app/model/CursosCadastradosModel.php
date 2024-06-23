<?php

require_once __DIR__."/../config/conexao.php";


class CursosCadastradosModel{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function getCursosCadastradosFiltrados($nivel, $area){
        $sql = $this->conn->prepare('SELECT * FROM curso_db
                                        WHERE nivel_id = :nivel
                                        AND setor_id = :setor
                                        ORDER BY curso ASC');
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':setor', $area);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function getArea($nivel){
        $sql = $this->conn->prepare('SELECT DISTINCT s.setor as setor, s.id as idSetor
                                        FROM setor AS s
                                        INNER JOIN curso_db c ON s.id = c.setor_id
                                        INNER JOIN nivel AS n ON c.nivel_id = n.id
                                        WHERE c.nivel_id = :nivel');
        $sql->bindParam(':nivel', $nivel);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllCursos($id){
        $sql = $this->conn->prepare('SELECT * from curso_db WHERE nivel_id = :id');
        $sql->bindParam(':id', $id );
      
        $sql->execute();
        $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function getNivel(){
        $sql = $this->conn->prepare('SELECT * from nivel ');
        $sql->execute();
        $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }
}