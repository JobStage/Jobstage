<?php
require_once __DIR__ .'/../config/conexao.php';

class CidadeEstadoModel{
    private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function getAllEstados(){
        $sql = $this->conn->prepare('SELECT * FROM estados');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function listarCidades($id){
        $sql = $this->conn->prepare('SELECT * FROM cidades
                                     WHERE id_estado = :id_estado');
        $sql->bindParam(':id_estado', $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function listarCidadeEstado($idCidade,$idEstado){
        $sql = $this->conn->prepare('SELECT c.nome, e.uf from cidades as c
                                    INNER JOIN estados as e on c.id = e.id 
                                    WHERE e.id = :id_estado AND c.id = :id_cidades' );
        $sql->bindParam(':id_estado', $idEstado);
        $sql->bindParam(':id_cidades', $idCidade);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

