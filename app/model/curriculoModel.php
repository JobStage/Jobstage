<?php

require_once  __DIR__  .'/../config/conexao.php';

class CurriculoModel {

  private $conn; 
    
  public function __construct() {
    $conexao = new Conexao();
    $this->conn = $conexao->conn();
  }

  public function getDadosAluno($id) {
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
  }

  public function getAllExperiencia($id) {
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
  }
  public function getAllCursos($id) {
    $sql =  $this->conn->prepare("SELECT nome_curso, 
                                  status, 
                                  instituicao FROM curso 
                                 WHERE id_aluno = :id");
    $sql->bindParam(':id',$id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function getAllFormacao($id) {
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
  }
}
