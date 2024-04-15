<?php
// Na model existirão todas as interações com o BANCO DE DADOS

require_once "../config/conexao.php";
class Aluno{

    private $conn; // variavel para conexao com banco

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function inserir(){

    }

    public function atualizar(){

    }

    public function deletar(){

    }

    public function getID($id) {
        // exemplo
        $sql = $this->conn->prepare('SELECT * FROM aluno WHERE id = ?');
        $sql->bindParam(1, $id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
