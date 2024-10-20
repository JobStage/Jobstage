<?php

require_once  __DIR__  .'/../config/conexao.php';

class CursosDBModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
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
      } catch (Exception $e) {
          $this->conexao->logs($e);
          return false;
      }
    }
  }