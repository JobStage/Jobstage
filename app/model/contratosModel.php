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
                                        VALUES (:vaga, :aluno, :empresa)");
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
            $sql = $this->conn->prepare("SELECT * FROM contratacoes as c
                                            INNER JOIN empresa as e
                                            ON e.id_empresa = c.idEmpresa
                                            WHERE c.contratoGerado = :contratoGerado");
            $sql->bindValue(':contratoGerado', 0);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            return false;
        }
        
    }

    public function getContratoModel($id){
        $sql = $this->conn->prepare("SELECT * FROM contratacoes 
                                        WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // funcao para coletar dados da vaga, curso, nivel, nome aluno, nome empresa, formacao
    public function getDadosParaContatoModel($idVaga, $idAluno, $idEmpresa){
        try {
            $sql = $this->conn->prepare("SELECT 
                                            a.nome as nomeAluno,
                                            v.descricao as descricaoVaga,
                                            v.salario as salarioVaga,
                                            cid.nome as cidade,
                                            est.nome as estado,
                                            e.nome as nomeEmpresa,
                                            e.cnpj as cnpjEmpresa,
                                            cdb.curso as nomeCurso
                                        FROM vagas as v
                        INNER JOIN empresa as e
                        ON v.id_empresa = e.id_empresa
                        INNER JOIN cidades as cid
                        ON cid.id = e.cidade
                        INNER JOIN estados as est
                        ON est.id = e.estado
                        INNER JOIN nivel as n
                        ON n.ID = v.nivel
                        INNER JOIN curso_db as cdb
                        ON v.cursos = cdb.ID
                        INNER JOIN candidatura as c
                        ON c.id_vaga = v.idVaga
                        INNER JOIN aluno as a
                        ON a.id = c.id_aluno
                        WHERE v.idVaga = $idVaga
                        AND v.id_empresa = $idEmpresa
                        AND c.id_aluno = $idAluno");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        } catch (PDOException $e) {
            return $e;
        }
      
    }
// funcao que irá gerar um contrato com as informacoes do contrato de estagio e o id da solicitacao
    public function gerarContratoModel($idVaga, $idAluno, $idEmpresa, $id){
        $sql = $this->conn->prepare("INSERT INTO contratosestagio (contrato, idContratacoes) 
                                        VALUES(:contrato, :idCpntratacao)");
    }
}