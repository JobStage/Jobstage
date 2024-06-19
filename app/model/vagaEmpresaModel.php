<?php

require_once __DIR__."/../config/conexao.php";


class vagaEmpresaModel{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $idEmpresa, $area = null, $valoresSelecionados = null){
        try {
             
        $sql = $this->conn->prepare("INSERT INTO vagas (nome, salario, modelo, nivel, descricao, requisitos, setor, cursos, id_empresa) 
                                     VALUES (:nome, :rs, :modelo, :nivel, :descricao, :requisitos, :area, :valores_selecionados, :id)");

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':rs', $rs);
        $sql->bindParam(':modelo', $modelo);
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':descricao', $desc);
        $sql->bindParam(':requisitos', $req);
        $sql->bindParam(':area', $area);
        $sql->bindParam(':valores_selecionados', $valoresSelecionados);
        $sql->bindParam(':id', $idEmpresa);
        $sql->execute();

        return true;

        } catch (PDOException $e) {
            return false;
        }
    }


    public function getAllVagas($idEmpresa){
        $sql = $this->conn->prepare('SELECT * FROM vagas 
                                    WHERE id_empresa = :id');

        $sql->bindParam(':id', $idEmpresa);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function excluirVaga($idVaga, $idEmpresa){

        try {
            $sql = $this->conn->prepare('DELETE FROM vagas
                                        WHERE idVaga = :vaga
                                        AND id_empresa = :empresa');
    
            $sql->bindParam(':vaga', $idVaga);
            $sql->bindParam(':empresa', $idEmpresa);
    
            $sql->execute();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getVagaFiltado($id){
        $sql = $this->conn->prepare('SELECT * FROM vagas
                                    WHERE idVaga = :id');

        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

