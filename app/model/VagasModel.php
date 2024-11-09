<?php
require_once __DIR__."/../config/conexao.php";
class Vagas{
  private $conn;
  private $conexao; 
  
  public function __construct() {
      $this->conexao = new Conexao();
      $this->conn = $this->conexao->conn(); 
  }

    public function getAllVagas($id, $idAluno){
      try {
        $sql = $this->conn->prepare('SELECT DISTINCT
                                          et.uf as nomeEstado, 
                                          c.nome as nomeCidade,
                                          e.nome as nomeEmpresa,
                                          n.nivel as nomeNivel, 
                                          m.modelo as modeloVaga, 
                                          v.* 
                                      FROM 
                                          vagas as v
                                          INNER JOIN nivel as n ON n.ID = v.nivel
                                          INNER JOIN modelo as m ON m.id = v.modelo
                                          INNER JOIN empresa as e ON e.id_empresa = v.id_empresa
                                          INNER JOIN estados as et ON et.id = e.estado
                                          INNER JOIN cidades as c ON e.cidade = c.id
                                          INNER JOIN formacao as f ON f.nivel = v.nivel
                                      WHERE 
                                          v.ativo = :ativo
                                          AND FIND_IN_SET(:idCurso, v.cursos) > 0
                                          AND NOT EXISTS (
                                              SELECT 1 
                                              FROM candidatura 
                                              WHERE id_aluno = :idAluno
                                              AND id_vaga = v.idVaga
                                          );
                                        );
                                    ');
      
        
        $sql->bindValue(':ativo', 1);
        $sql->bindValue(':idCurso', $id, PDO::PARAM_INT);
        $sql->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
        $sql->execute();
      
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      
        return $result;
        
      } catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }
 
  public function getVagaById($idVaga) {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM vagas WHERE idVaga = :id");
      $stmt->bindParam(':id', $idVaga);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }  catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
  }

  public function candidatar($idVaga,  $idAluno, $idEmpresa){
    try {
      $sql = $this->conn->prepare('INSERT INTO candidatura (id_vaga, id_aluno, id_empresa) VALUES (:idVaga, :idAluno, :idEmpresa)');
        
      // Vincula os parÃ¢metros aos valores reais
      $sql->bindParam(':idVaga', $idVaga, PDO::PARAM_INT);
      $sql->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
      $sql->bindParam(':idEmpresa', $idEmpresa, PDO::PARAM_INT);
      $sql->execute();
      return true;
    }catch (Exception $e) {
      $this->conexao->logs($e);
      return false;
    }
    
  }



public function vagasCandidatadas($id, $idAluno){
  try {
    $sql = $this->conn->prepare('SELECT DISTINCT
                                    et.uf as nomeEstado, 
                                    c.nome as nomeCidade,
                                    e.nome as nomeEmpresa,
                                    n.nivel as nomeNivel, 
                                    m.modelo as modeloVaga, 
                                    v.* 
                                FROM 
                                    vagas as v
                                    INNER JOIN nivel as n ON n.ID = v.nivel
                                    INNER JOIN modelo as m ON m.id = v.modelo
                                    INNER JOIN empresa as e ON e.id_empresa = v.id_empresa
                                    INNER JOIN estados as et ON et.id = e.estado
                                    INNER JOIN cidades as c ON e.cidade = c.id
                                    INNER JOIN formacao as f ON f.nivel = v.nivel
                                WHERE 
                                    v.ativo = :ativo
                                    AND :idCurso IN (v.cursos)
                                    AND EXISTS (
                                        SELECT 1 
                                        FROM candidatura 
                                        WHERE id_aluno = :idAluno
                                        AND id_vaga = v.idVaga
                                    );
                                ');

    $sql->bindValue(':ativo', 1);
    $sql->bindValue(':idCurso', $id, PDO::PARAM_INT);
    $sql->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $result;

  } catch (Exception $e) {
    $this->conexao->logs($e);
    return false;
}

}


  public function candidaturasEmpresa($empresa){
    try {
      $sql = $this->conn->prepare('SELECT DISTINCT n.nivel as nomeNivel, m.modelo as modeloVaga, v.* FROM vagas as v
      INNER JOIN nivel as n
        ON n.ID = v.nivel
      INNER JOIN modelo as m
        ON m.id = v.modelo
      WHERE v.id_empresa = :id
        AND v.ativo = :ativo');

      $sql->bindParam(':id', $empresa);
      $sql->bindValue(':ativo', 1);
      $sql->execute();

      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      return $result;

    }catch (Exception $e) {
      $this->conexao->logs($e);
      return false;
  }

  }

  public function getCandidatosVagas($idVaga, $idEmpresa) {
    try {
      $sql = $this->conn->prepare(
          "SELECT
              al.ID as idAluno, 
              al.nome as nomeUsuario,
              al.data_nasc as dataNasc,
              curs.curso as curso,
              form.fim as dataFormacao,
              TIMESTAMPDIFF(YEAR, al.data_nasc, CURDATE()) AS idade
          FROM 
              candidatura as cad
              INNER JOIN aluno as al ON al.ID = cad.id_aluno
              INNER JOIN formacao as form ON form.id_aluno = al.ID
              INNER JOIN curso_db as curs ON curs.ID = form.curso
          WHERE 
              cad.id_vaga = :idVaga 
              AND cad.id_empresa = :idEmpresa
              AND cad.id_aluno NOT IN (
                  SELECT contratacoes.id_aluno 
                  FROM contratacoes 
                  WHERE contratacoes.id_empresa = :idEmpresa
              )
      ");
    $sql->bindParam(':idVaga', $idVaga);
    $sql->bindParam(':idEmpresa', $idEmpresa);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    } catch (Exception $e) {
      $this->conexao->logs($e);
      return false;
    }
    
  }

  public function criarPergunta($vagaId, $pergunta) {
    $query = "INSERT INTO perguntas (id_vaga, pergunta) VALUES (:vaga_id, :pergunta)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':vaga_id', $vagaId);
    $stmt->bindParam(':pergunta', $pergunta);
    $stmt->execute();
}

public function listarPerguntasPorVaga($vagaId) {
  $query = "SELECT pergunta FROM perguntas WHERE id_vaga = :vaga_id ";
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(':vaga_id', $vagaId);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function editarPergunta($perguntaId, $novaPergunta) {
    $query = "UPDATE perguntas SET pergunta = :novaPergunta WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $perguntaId);
    $stmt->bindParam(':novaPergunta', $novaPergunta);
    $stmt->execute();
}

public function excluirPergunta($perguntaId) {
    $query = "DELETE FROM perguntas WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $perguntaId);
    $stmt->execute();
}

public function salvarRespostas($resposta, $idAluno) {
  $sql = "INSERT INTO resposta_pergunta (resposta, id_aluno) VALUES (:resposta, :aluno_id)";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':resposta', $resposta);
  $stmt->bindParam(':aluno_id', $idAluno);

  return $stmt->execute();
}
public function listarUltimaResposta() {
  $query = "SELECT resposta FROM resposta_pergunta ORDER BY id DESC LIMIT 1";
  $stmt = $this->conn->prepare($query);
  $stmt->execute();
  
  // Retornar a resposta encontrada
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function listarUltimaPergunta() {
  $query = "SELECT pergunta FROM perguntas ORDER BY id DESC LIMIT 1";
  $stmt = $this->conn->prepare($query);
  $stmt->execute();
  
  // Retornar a resposta encontrada
  return $stmt->fetch(PDO::FETCH_ASSOC);
}
}