<?php

require_once  __DIR__  .'/../config/conexao.php';

class FilialModel {
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }


    public function getAllFiliais($id){
        try {
            $sql = $this->conn->prepare("SELECT f.id_filial as id, f.nome AS nome, GROUP_CONCAT(n.nivel) AS niveis
                                             FROM filial as f
                                            INNER JOIN nivel as n 
                                            ON FIND_IN_SET(n.id, f.nivel) > 0
                                            WHERE id_instituicao = :id
                                            GROUP BY f.nome");
                                
            $sql->bindParam(':id', $id);
            $sql->execute();
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function criarFilial($nome, $niveis, $id) {
        try {
            $sql = $this->conn->prepare("INSERT INTO filial (nome, nivel, id_instituicao) 
                                         VALUES (:nome, :niveis, :id)");
        
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':niveis', $niveis);
            $sql->bindParam(':id', $id);
        
            $sql->execute();
            return true;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
   
    public function getDadoFilial($id, $idInstituicao){
        try {
            $sql = $this->conn->prepare("SELECT nome, nivel, id_filial FROM filial
                                            WHERE id_filial = :id
                                            AND id_instituicao = :idINst");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':idINst', $idInstituicao);
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
        
    }


    public function editarFilial($nome, $nivel, $idInstituicao, $id){
        try {
            $sql = $this->conn->prepare("UPDATE filial
                                            SET nome = :nome,
                                                nivel = :nivel
                                            WHERE
                                                id_filial = :id
                                            AND 
                                                id_instituicao = :idInst");
        
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':nivel', $nivel);
            $sql->bindParam(':id', $id);
            $sql->bindParam(':idInst', $idInstituicao);
            $sql->execute();
            return true;
        
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
        
    }
   
    public function verNivielFilial($id, $idInstituicao){
        try {
            $sql = $this->conn->prepare("SELECT nivel FROM filial
                                            WHERE id_filial = :id
                                            AND id_instituicao = :idINst");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':idINst', $idInstituicao);
            $sql->execute();
    
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    
    // public function insertNivelFilial($idFilial,$cursoTecnico, $cursoSuperior,$estado, $cidade, $cep, $rua) {
    //     $sql = $this->conn->prepare("INSERT INTO filial (id_instituicao, cursoTecnico, cursoSuperior, estado, cidade, CEP, rua) 
    //                                  VALUES (:niveis, :id, :cursoTecnico, :cursoSuperior, :estado, :cidade, CEP, rua)");
    
    //     $sql->bindParam(':niveis', $nivel);
    //     $sql->bindParam(':id', $idFilial);
    //     $sql->bindParam(':cursoTecnico', $cursoTecnico);
    //     $sql->bindParam(':cursoSuperior', $cursoSuperior);
    //     $sql->bindParam(':estado', $estado);
    //     $sql->bindParam(':cidade', $cidade);
    //     $sql->bindParam(':CEP', $cep);
    //     $sql->bindParam(':rua', $rua);
    
    //     $sql->execute();
    //     return true;
    // }
    public function insertNivelFilial($id,$cursosTecnico, $cursosSuperior,$estado, $cidade, $CEP, $rua) {
        try {
            
            $sql = $this->conn->prepare("UPDATE filial 
                                      SET cursosTecnico = :cursosTecnico, 
                                          cursosSuperior = :cursosSuperior, 
                                          estado = :estado, 
                                          cidade = :cidade, 
                                          CEP = :CEP, 
                                          rua = :rua 
                                      WHERE id_instituicao = :id");
    
            $sql->bindParam(':id', $id);
            $sql->bindParam(':cursosTecnico', $cursosTecnico);
            $sql->bindParam(':cursosSuperior', $cursosSuperior);
            $sql->bindParam(':estado', $estado);
            $sql->bindParam(':cidade', $cidade);
            $sql->bindParam(':CEP', $CEP);
            $sql->bindParam(':rua', $rua);

            $sql->execute();
            return true;
        }catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function excluirFilial(int $idFilial, int $idIstituicao) {
        try {
            $sql = $this->conn->prepare('DELETE FROM filial 
                                            WHERE id_filial = :idFilial
                                            AND id_instituicao = :idIstituicao');
            $sql->bindParam(':idFilial',$idFilial);
            $sql->bindParam(':idIstituicao',$idIstituicao);
    
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            echo ' MODEL -> Erro ao executar a operação: ' . $e->getMessage();
            return false;
        }
    } 
    // private function insertNivelFilial($idFilial, $nivel) {
    //     // Implementar lógica para inserir o nível da filial
    //     $query = "INSERT INTO filiais_niveis (id_filial, nivel) VALUES (:idFilial, :nivel)";
    //     // Execute a query
    // }
    public function listarTodasFiliais(){
        $sql = $this->conn->prepare('SELECT * FROM filial');
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getDadosFilialID($id){
        $sql = $this->conn->prepare('SELECT e.nome as nomeEstado, c.nome as nomeCidade, f.* FROM filial as f
                                    INNER JOIN estados as e
                                    on e.id = f.estado
                                    inner join cidades as c
                                    on c.id = f.cidade
                                    WHERE id_filial = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}