<?php
require_once __DIR__ .'/../config/conexao.php';

class chartsModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

   public function graphAluno(){
    try {
        $sql = $this->conn->prepare("SELECT 
                                    e.nome AS Estado, 
                                    COUNT(v.idVaga) AS qtde,
                                    (SELECT COUNT(idVaga) FROM vagas WHERE ativo = 1) AS ativa,
                                    (SELECT COUNT(idVaga) FROM vagas WHERE ativo = 0) AS inativa
                                FROM 
                                    vagas AS v
                                INNER JOIN 
                                    empresa AS emp ON emp.id_empresa = v.id_empresa 
                                INNER JOIN 
                                    estados AS e ON e.id = emp.estado 
                                GROUP BY 
                                    e.nome
                                ORDER BY 
                                    qtde ASC
                            ");    
                             
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        $this->conexao->logs($e);
        return false;
    }
    
   }

   public function graphEmpresa($id){
        try {
            $sql = $this->conn->prepare("SELECT 
                                            (SELECT COUNT(f.id) FROM funcionarios f 
                                                WHERE f.id_empresa = :id) AS qtdeFunc,
                                            (SELECT COUNT(c.ID) FROM contratacoes c 
                                                WHERE c.id_empresa = :id 
                                                AND c.contratoAtivo = 1) AS qtdeEstagiario
                                        FROM empresa e 
                                        WHERE e.id_empresa = :id;");
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
   }

   public function graphAdmin(){
        try {
            $sql = $this->conn->prepare("SELECT 
                                            (SELECT COUNT(id) FROM aluno) AS aluno,
                                            (SELECT COUNT(id_empresa) FROM empresa) AS empresa,
                                            (SELECT COUNT(id_instituicao) FROM instituicao) AS instituicao"
                                        );
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
   }
}

