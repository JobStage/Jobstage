<?php
require_once __DIR__ .'/../config/conexao.php';

class FormacaoModel{
    private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function getAllformacao($id = null){
        $sql = 'SELECT * FROM formacao';

        // verifica se existe valor no id para incluir no WHERE
        if ($id !== null) {
            $sql .= ' WHERE id_formacao = :id';
        }

        $sql = $this->conn->prepare($sql);

        // verifica novamente se existe valor para inserir no bindParam
        if ($id !== null) {
            $sql->bindParam(':id', $id);
        }

        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

   
    public function criarFormacao(string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo): void {
        $sql = $this->conn->prepare('INSERT INTO formacao (curso, setor, instituicao, nivel, inicio, fim, status, matricula, id_aluno) VALUES (:curso, :setor, :instituicao, :nivel, :inicio, :fim, :status, :arquivo, 1)');
        
        $sql->bindParam(':curso', $curso);
        $sql->bindParam(':setor', $setor);
        $sql->bindParam(':instituicao', $instituicao);
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':inicio', $inicio); 
        $sql->bindParam(':fim', $fim); 
        $sql->bindParam(':status', $status);
        $sql->bindParam(':arquivo', $arquivo);
        $sql->execute();
    }

    public function editarFormacao(int $idAluno, int $idFormacao, string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, $status, $arquivo = null): void{
        
        try {
            $sql = 'UPDATE formacao SET curso = :curso, setor = :setor, instituicao = :instituicao, nivel = :nivel, inicio = :inicio, fim = :fim, status = :status';

        if($arquivo){
            $sql .= ', matricula = :arquivo';
        }

        $sql .= ' WHERE id_aluno = :idAluno AND id_formacao = :idFormacao';

        $sql = $this->conn->prepare($sql);

        $sql->bindParam(':curso', $curso);
        $sql->bindParam(':setor', $setor);
        $sql->bindParam(':instituicao', $instituicao);
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':inicio', $inicio);
        $sql->bindParam(':fim', $fim);
        $sql->bindParam(':status', $status);
        $sql->bindParam(':idAluno', $idAluno);
        $sql->bindParam(':idFormacao', $idFormacao);

        if ($arquivo) {
            $sql->bindParam(':arquivo', $arquivo);
        }

        $sql->execute();

        return;
        } catch (PDOException $e) {
            echo ' MODEL -> Erro ao executar a operação: ' . $e->getMessage();
        }
        
    }

    public function excluirFormacao(int $idFormacao, int $idAluno): bool{
        try {
            $sql = $this->conn->prepare('DELETE FROM formacao 
                                            WHERE id_aluno = :idAluno
                                            AND id_formacao = :idFormacao');
            $sql->bindParam(':idAluno',$idAluno);
            $sql->bindParam(':idFormacao',$idFormacao);
    
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            echo ' MODEL -> Erro ao executar a operação: ' . $e->getMessage();
            return false;
        }
        
    }

    public function getMatricula(int $idAluno, int $idFormacao): string{
        $sql = $this->conn->prepare('SELECT matricula FROM formacao
                                    WHERE id_aluno = :idAluno
                                    AND id_formacao = :idFormacao');
        $sql->bindParam(':idAluno',$idAluno);
        $sql->bindParam(':idFormacao',$idFormacao);

        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result['matricula'];
    }


}

