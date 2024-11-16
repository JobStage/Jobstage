<?php

require_once __DIR__."/../config/conexao.php";


class contratosModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function gerarContratoEmpresaModel($idAluno, $idVaga, $idEmpresa, $funcionarioId, $idFilial){
        try {
            $sql = $this->conn->prepare("INSERT INTO contratacoes (idVaga, id_aluno, id_empresa, id_funcionario, idFilial)
                                        VALUES (:vaga, :aluno, :empresa, :func, :filial)");
            $sql->bindParam(':aluno', $idAluno);
            $sql->bindParam(':vaga', $idVaga);
            $sql->bindParam(':empresa', $idEmpresa);
            $sql->bindParam(':func', $funcionarioId);
            $sql->bindParam(':filial', $idFilial);
            $sql->execute();
            return true;
        } catch (Exception $e) {
           echo $e;
            return false;
        }
        
    }

    public function getAllSolicitacoesContratoModel(){
        try {
            $sql = $this->conn->prepare("SELECT * FROM contratacoes as c
                                            INNER JOIN empresa as e
                                            ON e.id_empresa = c.id_empresa
                                            WHERE c.contratoGerado = :contratoGerado");
            $sql->bindValue(':contratoGerado', 0);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
        
    }

    public function getContratoModel($id){
        try {
            $sql = $this->conn->prepare("SELECT * FROM contratacoes 
                                        WHERE ID = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
       
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
                                            cdb.curso as nomeCurso,
                                            func.nome as nomeFunc,
                                            func.email as emailFunc,
                                            func.id as idFunc
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
                        INNER JOIN funcionarios as func
                        ON func.id = v.id_funcionario
                        WHERE v.idVaga = $idVaga
                        AND v.id_empresa = $idEmpresa
                        AND c.id_aluno = $idAluno");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
      
    }
    // funcao que irá gerar um contrato com as informacoes do contrato de estagio e o id da solicitacao
    public function gerarContratoModel($id, $textoDoContrato, $hash){
        try {
            
            $this->conn->beginTransaction();
          
            $sql = $this->conn->prepare("UPDATE contratacoes 
                                            SET contrato = :textoDoContrato, 
                                            hashContrato = :hashC,
                                            contratoGerado = 1 
                                        WHERE ID = :id");
            $sql->bindParam(':textoDoContrato', $textoDoContrato);
            $sql->bindParam(':hashC', $hash);
            $sql->bindParam(':id', $id);
            $sql->execute();
            
            $this->conn->commit();
    
            return true;
        } catch (Exception $e) {
            // Rollback em caso de erro
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getContratos($idAluno){
        try {
            $sql = $this->conn->prepare("SELECT * FROM contratacoes as ctr
                                            INNER JOIN empresa as e
                                            on e.id_empresa = ctr.id_empresa
                                            WHERE ctr.id_aluno = :idAluno
                                            AND contratoGerado = 1" );
            $sql->bindParam(":idAluno", $idAluno);
            $sql->execute();
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getAlunosContratados($idEmpresa){
        try {
            $sql = $this->conn->prepare("SELECT a.nome as nomeAluno, c.* FROM contratacoes as c
                                        INNER JOIN aluno as a
                                        on c.id_aluno = a.ID
                                        WHERE id_empresa = :id
                                        AND contratoGerado > 0");
            $sql->bindParam(':id', $idEmpresa);    
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getContratoPorHash($hash){
        try {
            $sql = $this->conn->prepare("SELECT
                                            c.contrato as contrato, 
                                            c.id_aluno as idAluno, 
                                            c.idFilial as idFilial, 
                                            c.contratoAtivo as contratoAtivo, 
                                            c.id as idContrato,
                                            c.id_funcionario as idFunc,
                                            ass.nome as nomeAss,
                                            ass.dataHora as dataHora
                                        FROM contratacoes as c
                                        LEFT JOIN assinatura as ass
                                        on ass.idContratosEstagio = c.ID
                                            WHERE c.hashContrato = :hsh");
    
            $sql->bindParam(':hsh', $hash);
            $sql->execute();
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function verificaSeTemAssinatura($id, $user){
        try {
            $sql = $this->conn->prepare("SELECT * FROM contratacoes
                                        WHERE id_aluno = :idAluno
                                            AND assinado_{$user} IS NULL");
            $sql->bindParam(':idAluno',$id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;

        } catch (Exception $e) {
            $this->conexao->logs($e);
            return;
        }
    }

    public function desligamentoContrato($hash){
        try {
           $sql = $this->conn->prepare("UPDATE contratacoes
                                        SET contratoAtivo = 2
                                        WHERE hashContrato = :hashh");
            $sql->bindParam(':hashh', $hash);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return;
        }
    }
}