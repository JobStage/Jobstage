<?php
require_once __DIR__."/../config/conexao.php";
class Vagas{
  private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function getAllVagas(){
      $sql = $this->conn->prepare('SELECT et.uf as nomeEstado, c.nome as nomeCidade,e.nome as nomeEmpresa,n.nivel as nomeNivel, m.modelo as modeloVaga, v.* FROM vagas as v
                                      INNER JOIN nivel as n
                                      ON n.ID = v.nivel
                                      INNER JOIN modelo as m
                                      ON m.id = v.modelo
                                      INNER JOIN empresa as e
                                      ON e.id_empresa = v.id_empresa
                                      INNER JOIN estados as et
                                      ON et.id = e.estado
                                      INNER JOIN cidades as c
                                      ON e.cidade = c.id

                                  WHERE v.ativo = :ativo');

      
      $sql->bindValue(':ativo', 1);
      $sql->execute();

      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      return $result;
  }
  
  public function getVagaById($idVaga) {
    // Consulta SQL para obter os detalhes da vaga pelo ID
    $stmt = $this->conn->prepare("SELECT * FROM vagas WHERE idVaga = ?");
    $stmt->execute([$idVaga]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function candidatar($idVaga,  $idAluno, $idEmpresa){
  try {
    $sql = $this->conn->prepare('INSERT INTO candidatura (id_vaga, id_aluno, id_empresa) VALUES (:idVaga, :idAluno, :idEmpresa)');
      
    // Vincula os parâmetros aos valores reais
    $sql->bindParam(':idVaga', $idVaga, PDO::PARAM_INT);
    $sql->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $sql->bindParam(':idEmpresa', $idEmpresa, PDO::PARAM_INT);
    $sql->execute();
    return true;
  } catch (PDOException $e) {
    echo $e;
    return false;
  }
  
}
}