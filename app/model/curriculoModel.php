<?php

require_once  __DIR__  .'/../config/conexao.php';

class CurriculoModel {
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }


  public function getDadosAluno($id) {
    try {
      $sql =  $this->conn->prepare("SELECT 
                              al.ID,
                              al.nome AS nome,
                              al.email AS email,
                              al.linkedin AS linkedin,
                              al.descricao AS descricao,
                              al.telefone AS telefone,
                              TIMESTAMPDIFF(YEAR, al.data_nasc, CURDATE()) AS idade,
                              al.estado_civil AS estadoCivil,
                              cid.nome AS cidade,
                              es.uf AS estado
                          FROM 
                              aluno AS al
                              INNER JOIN cidades AS cid ON cid.id = al.cidade
                              INNER JOIN estados AS es ON es.id = al.estado
                          WHERE 
                              al.ID = :id;
              ");
      $sql->bindParam(':id',$id);
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $result;
           
    }  catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }


  public function getAllExperiencia($id) {
    try {
      $sql =  $this->conn->prepare("SELECT nome, 
                                  cargo,
                                  inicio,
                                  fim,
                                  atividades FROM experiencia
                                  WHERE id_aluno = :id");
      $sql->bindParam(':id',$id);
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $result;
           
    }  catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }


  public function getAllCursos($id) {
    try {
      $sql =  $this->conn->prepare("SELECT nome_curso, 
                                    status, 
                                    instituicao FROM curso 
                                   WHERE id_aluno = :id");
      $sql->bindParam(':id',$id);
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }  catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }


  public function getAllFormacao($id) {
    try {
      $sql =  $this->conn->prepare("SELECT 
                                  curs.curso AS curso, 
                                  form.instituicao AS instituicao,
                                  form.status AS statuss
                                  FROM curso_db as curs
                                  INNER JOIN formacao as form
                                  ON curs.ID = form.curso
                                  WHERE form.id_aluno = :id");
  
  
      $sql->bindParam(':id',$id);
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }  catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }
}
