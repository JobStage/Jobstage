<?php
require_once __DIR__."/../config/conexao.php";
class funcionarioModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }
  
  public function salvar($nome, $email, $idEmpresa, $area){
        try {
            $sql = $this->conn->prepare("INSERT INTO funcionarios (nome, email, id_empresa, setor, tipo_usuario)
                                        VALUES(:nome, :email, :idEmpresa, :setor, :user)");
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':idEmpresa', $idEmpresa);
            $sql->bindParam(':setor', $area);
            $sql->bindValue(':user', 5);
    
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function atualizar($nome, $email, $idEmpresa){
        try {
            $sql = $this->conn->prepare("UPDATE funcionarios
                                            SET nome = :nome,
                                                email = :email
                                            WHERE id_empresa = :idEmpresa
                                        ");
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':idEmpresa', $idEmpresa);
    
            $sql->execute();
            return true;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function listarFuncionarios($idEmpresa){
        try {
            $sql = $this->conn->prepare("SELECT * FROM funcionarios
                                            WHERE id_empresa = :id_empresa");
            $sql->bindParam(':id_empresa', $idEmpresa);
    
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}