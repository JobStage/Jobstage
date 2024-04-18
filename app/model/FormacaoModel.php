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
}

