<?php
require_once __DIR__."/../config/conexao.php";
class funcionarioModel{
  private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function salvar($nome, $email, $idEmpresa){
        try {
            $sql = $this->conn->prepare("INSERT INTO funcionarios (nome, email, id_empresa)
                                        VALUES(:nome, :email, :idEmpresa)");
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':idEmpresa', $idEmpresa);
    
            $sql->execute();
            return true;
        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
            return false;
        }
    }
}