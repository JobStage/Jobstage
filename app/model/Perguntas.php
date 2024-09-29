<?php
require_once __DIR__."/../config/conexao.php";

class PerguntasModel {
  private $conn;

  public function __construct()
  {
      $conexao = new Conexao();
      $this->conn = $conexao->conn();
  }

    // Função para inserir perguntas no banco de dados
    public function criarPergunta($vagaId, $pergunta) {
        $query = "INSERT INTO perguntas (vaga_id, pergunta) VALUES (:vaga_id, :pergunta)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':vaga_id', $vagaId);
        $stmt->bindParam(':pergunta', $pergunta);
        $stmt->execute();
    }

    // Função para listar perguntas de uma vaga
    public function listarPerguntasPorVaga($vagaId) {
        $query = "SELECT * FROM perguntas WHERE vaga_id = :vaga_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':vaga_id', $vagaId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função para editar uma pergunta
    public function editarPergunta($perguntaId, $novaPergunta) {
        $query = "UPDATE perguntas SET pergunta = :novaPergunta WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $perguntaId);
        $stmt->bindParam(':novaPergunta', $novaPergunta);
        $stmt->execute();
    }

    // Função para excluir uma pergunta
    public function excluirPergunta($perguntaId) {
        $query = "DELETE FROM perguntas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $perguntaId);
        $stmt->execute();
    }
}
