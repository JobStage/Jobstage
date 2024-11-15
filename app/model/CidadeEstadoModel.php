<?php
require_once __DIR__ .'/../config/conexao.php';

class CidadeEstadoModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function getAllEstados(){
        try {
            $sql = $this->conn->prepare('SELECT * FROM estados');
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function listarCidades($id){
        try {
            $sql = $this->conn->prepare('SELECT * FROM cidades
                                         WHERE id_estado = :id_estado');
            $sql->bindParam(':id_estado', $id);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    public function listarCidadeEstado($idCidade,$idEstado){
        try {
            $sql = $this->conn->prepare('SELECT c.nome, e.uf from cidades as c
                                        INNER JOIN estados as e on c.id = e.id 
                                        WHERE e.id = :id_estado AND c.id = :id_cidades' );
            $sql->bindParam(':id_estado', $idEstado);
            $sql->bindParam(':id_cidades', $idCidade);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}

