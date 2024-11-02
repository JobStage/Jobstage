<?php
// Na model existirão todas as interações com o BANCO DE DADOS

require_once  __DIR__  .'/../config/conexao.php';

class CursosModel {
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function atualizar($idCurso, $nome, $instituicao, $inicio, $fim, $status, $nivel, $id_aluno) {
        try {
            $sql = $this->conn->prepare('UPDATE curso 
                                            SET nome_curso = :nome,
                                                instituicao = :instituicao,
                                                inicio = :inicio,
                                                fim = :fim,
                                                status = :status,
                                                nivel = :nivel
                                            WHERE id_curso = :id AND id_aluno = :id_aluno');
            $sql->bindParam(':id', $idCurso);
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':instituicao', $instituicao);
            $sql->bindParam(':inicio', $inicio);
            $sql->bindParam(':fim', $fim);
            $sql->bindParam(':status', $status);
            $sql->bindParam(':nivel', $nivel);
            $sql->bindParam(':id_aluno', $id_aluno);
            $sql->execute();
            return;

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    

   public function getAllcurso(int $idAluno,$id = null){
        try {
            $sql = 'SELECT * FROM curso';
            $sql .= ' WHERE id_aluno = :idAluno';

            if ($id !== null) {
                $sql .= ' AND id_curso = :id';
            }
            
            $sql = $this->conn->prepare($sql);
            $sql->bindValue(':idAluno', $idAluno);

            if ($id !== null) {
                $sql->bindParam(':id', $id);
            }

            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
   }
   public function salvarCurso(string $curso, string $instituicao, string $nivelTecnico, $inicio, $fim, string $status, int $idAluno) {
        try {
            $sql = $this->conn->prepare('INSERT INTO curso (nome_curso, instituicao, inicio, fim, status, nivel, id_aluno) VALUES (:curso, :instituicao, :inicio, :fim, :status, :nivelTecnico, :id_aluno)');

            $sql->bindValue(':curso', $curso);
            $sql->bindValue(':instituicao', $instituicao);
            $sql->bindValue(':inicio', $inicio);
            $sql->bindValue(':fim', $fim);
            $sql->bindValue(':status', $status);
            $sql->bindValue(':nivelTecnico', $nivelTecnico);
            $sql->bindValue(':id_aluno', $idAluno);

            $sql->execute();
            // $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return true;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }

    }

    public function excluirCurso(int $idCurso, int $idAluno): bool {
        try {
            $sql = $this->conn->prepare('DELETE FROM curso 
                                            WHERE id_curso = :idCurso
                                            AND id_aluno = :idAluno');
            $sql->bindParam(':idCurso',$idCurso);
            $sql->bindParam(':idAluno',$idAluno);
    
            $sql->execute();

            return true;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}