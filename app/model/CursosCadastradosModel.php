<?php

require_once __DIR__."/../config/conexao.php";


class CursosCadastradosModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function getCursosCadastradosFiltrados($nivel, $area){
        try {
            $sql = $this->conn->prepare('SELECT * FROM curso_db
                                            WHERE nivel_id = :nivel
                                            AND setor_id = :setor
                                            ORDER BY curso ASC');
            $sql->bindParam(':nivel', $nivel);
            $sql->bindParam(':setor', $area);
            $sql->execute();
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    
    public function getArea($nivel){
        try {
            $sql = $this->conn->prepare('SELECT DISTINCT s.setor as setor, s.id as idSetor
                                            FROM setor AS s
                                            INNER JOIN curso_db c ON s.id = c.setor_id
                                            INNER JOIN nivel AS n ON c.nivel_id = n.id
                                            WHERE c.nivel_id = :nivel');
            $sql->bindParam(':nivel', $nivel);
            $sql->execute();
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getAllArea(){
        $sql = $this->conn->prepare('SELECT * FROM setor');
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllCursos($id){
        try {
            $sql = $this->conn->prepare('SELECT * from curso_db WHERE nivel_id = :id');
            $sql->bindParam(':id', $id );
          
            $sql->execute();
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $retorno;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getNivel(){
        try {
            $sql = $this->conn->prepare('SELECT * from nivel ');
            $sql->execute();
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $retorno;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getCursoNivelTecnico(){
        try {
            $sql = $this->conn->prepare('SELECT * FROM curso_db 
                                        WHERE nivel_id = 2');
            $sql->execute();
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $retorno;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
   
    public function getCursoNivelSuperior(){
        try {
            $sql = $this->conn->prepare('SELECT * FROM curso_db 
                                        WHERE nivel_id = 3');
            $sql->execute();
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $retorno;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}