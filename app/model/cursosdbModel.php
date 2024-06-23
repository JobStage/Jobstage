<?php

require_once  __DIR__  .'/../config/conexao.php';

class CursosDBModel{

  private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
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