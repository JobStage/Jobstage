<?php

require_once  __DIR__  .'/../config/conexao.php';

class FilialModel {

  private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }


    public function getAllFiliais($id){
        $sql = $this->conn->prepare("SELECT f.nome AS nome, GROUP_CONCAT(n.nivel) AS niveis
                                         FROM filial as f
                                        INNER JOIN nivel as n 
                                        ON FIND_IN_SET(n.id, f.nivel) > 0
                                        WHERE id_instituicao = :id
                                        GROUP BY f.nome");
                            
        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function criarFilial($nome, $niveis, $id) {
        $sql = $this->conn->prepare("INSERT INTO filial (nome, nivel, id_instituicao) 
                                     VALUES (:nome, :niveis, :id)");
    
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':niveis', $niveis);
        $sql->bindParam(':id', $id);
    
        $sql->execute();
        return true;
    }
    
}