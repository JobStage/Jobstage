<?php

require_once "../config/conexao.php";
class Empresa{

    private $conn;

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function atualizar($idEmpresa, $nome, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        $sql = $this->conn->prepare('UPDATE aluno 
                                        SET nome = :nome,
                                            cnpj = :cnpj,
                                            contato = :contato,
                                            estado = :estado,
                                            cidade = :cidade,
                                            cep = :cep,
                                            rua = :rua,
                                            numero = :numero,
                                            cadastro_completo = 1
                                        WHERE ID = :id');
        $sql->bindParam(':id', $idEmpresa);
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':cnpj', $cnpj);
        $sql->bindParam(':contato', $contato);
        $sql->bindParam(':estado', $estado);
        $sql->bindParam(':cidade', $cidade);
        $sql->bindParam(':cep', $cep);
        $sql->bindParam(':rua', $rua);
        $sql->bindParam(':numero', $numero);
        $sql->execute();

        return;
    }

    public function getAll($id) {
        
        $sql = $this->conn->prepare('SELECT * FROM empresa WHERE id = ?');
        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
