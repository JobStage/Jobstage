<?php

require_once __DIR__."/../config/conexao.php";


class contratosModel{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function gerarContratoEmpresaModel($idAluno, $idVaga, $idEmpresa){
        try {
            $sql = $this->conn->prepare("INSERT INTO contratacoes (idVaga, idAluno, idEmpresa)
                                        VALUES (:aluno, :vaga, :empresa)");
            $sql->bindParam(':aluno', $idAluno);
            $sql->bindParam(':vaga', $idVaga);
            $sql->bindParam(':empresa', $idEmpresa);
            $sql->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }

    public function getAllSolicitacoesContratoModel(){
        try {
            $sql = $this->conn->prepare("SELECT * FROM contratacoes
                                            WHERE contratoGerado = :contratoGerado");
            $sql->bindValue(':contratoGerado', 0);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
        
    }
}