<?php
// Na model existirão todas as interações com o BANCO DE DADOS

require_once '../app/config/conexao.php';

class CursosModel {

  private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

   public function getAllcurso($id = null){
        $sql = 'SELECT * FROM curso';

        // verifica se existe valor no id para incluir no WHERE
        if ($id !== null) {
            $sql .= ' WHERE id_curso = :id';
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