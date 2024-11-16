<?php

require_once  __DIR__  .'/../config/conexao.php';

class ExperienciaModel {
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function atualizar($idExperiencia, $nome, $cargo, $inicio, $fim, $tipo, $atividades, $id_aluno) {
        try {
            $sql = $this->conn->prepare('UPDATE experiencia 
                                            SET nome = :nome,
                                                cargo = :cargo,
                                                inicio = :inicio,
                                                fim = :fim,
                                                tipo = :tipo,
                                                atividades = :atividades
                                            WHERE id_exp = :idExperiencia AND id_aluno = :id_aluno');
    
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':cargo', $cargo);
            $sql->bindParam(':inicio', $inicio);
            $sql->bindParam(':fim', $fim);
            $sql->bindParam(':tipo', $tipo);
            $sql->bindParam(':atividades', $atividades);
            $sql->bindParam(':idExperiencia', $idExperiencia);
            $sql->bindParam(':id_aluno', $id_aluno);
    
            $sql->execute();
            return true;
        }catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
   
    

   public function getAllExperiencia(int $idAluno,$id = null){
        try {
            $sql = 'SELECT * FROM experiencia';
            $sql .= ' WHERE id_aluno = :idAluno';
    
            if ($id !== null) {
                $sql .= ' AND id_exp = :id';
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
   public function salvarExperiencia(int $idAluno, string $cargo, string $empresa, string $tipo, $inicio, $fim, string $atividades) {
        try {
            $sql = $this->conn->prepare('INSERT INTO experiencia (cargo, nome, inicio, fim, tipo, atividades, id_aluno) VALUES (:cargo, :empresa, :inicio, :fim, :tipo, :atividades, :id_aluno)');

            $sql->bindValue(':cargo', $cargo);
            $sql->bindValue(':empresa', $empresa);
            $sql->bindValue(':inicio', $inicio);
            $sql->bindValue(':fim', $fim);
            $sql->bindValue(':tipo', $tipo);
            $sql->bindValue(':atividades', $atividades);
            $sql->bindValue(':id_aluno', $idAluno);

            $sql->execute();
            return true;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function excluirExperiencia(int $idExp, int $idAluno): bool {
        try {
            $sql = $this->conn->prepare('DELETE FROM experiencia 
                                            WHERE id_exp = :idExp
                                            AND id_aluno = :idAluno');
            $sql->bindParam(':idExp',$idExp);
            $sql->bindParam(':idAluno',$idAluno);
    
            $sql->execute();

            return true;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}