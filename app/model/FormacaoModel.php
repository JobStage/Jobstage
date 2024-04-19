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

   public function criarFormacao(string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo) {
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


}

