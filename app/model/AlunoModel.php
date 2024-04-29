<?php
// Na model existirão todas as interações com o BANCO DE DADOS

require_once __DIR__ .'/../config/conexao.php';
class AlunoModel{

    private $conn; // variavel para conexao com banco

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }
    
    public function atualizar($idAluno, $nome, $dataNasc, $telefone, $estadoCivil, $cidade, $estado, $cep, $rua, $numero, $linkedin, $descricao){
        $sql = $this->conn->prepare('UPDATE aluno 
                                        SET nome = :nome,
                                            data_nasc = :nasc,
                                            telefone = :tel,
                                            estado_civil = :civil,
                                            cidade = :cidade,
                                            estado = :estado,
                                            cep = :cep,
                                            rua = :rua,
                                            numero = :numero,
                                            linkedin = :linkedin,
                                            descricao = :descricao,
                                            cadastro_completo = 1
                                        WHERE ID = :id');
        $sql->bindParam(':id', $idAluno);
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':nasc', $dataNasc);
        $sql->bindParam(':tel', $telefone);
        $sql->bindParam(':civil', $estadoCivil);
        $sql->bindParam(':cidade', $cidade);
        $sql->bindParam(':estado', $estado);
        $sql->bindParam(':cep', $cep);
        $sql->bindParam(':rua', $rua);
        $sql->bindParam(':numero', $numero);
        $sql->bindParam(':linkedin', $linkedin);
        $sql->bindParam(':descricao', $descricao);
        $sql->execute();

        return;
    }


    public function getAll($id) {
        // exemplo
        $sql = $this->conn->prepare('SELECT * FROM aluno WHERE ID = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
