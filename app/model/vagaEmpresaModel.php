<?php

require_once __DIR__."/../config/conexao.php";


class vagaEmpresaModel{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $idEmpresa, $area = null, $valoresSelecionados = null, $ensinoMedio = null){
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

        if($valoresSelecionados){
            $sql->bindParam(':valores_selecionados', $valoresSelecionados);
        }else{
            $sql->bindParam(':valores_selecionados', $ensinoMedio);
        }

        $sql->bindParam(':id', $idEmpresa);
        $sql->execute();

        return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllVagas($idEmpresa){
        $sql = $this->conn->prepare('SELECT n.nivel as nomeNivel, m.modelo as modeloVaga, v.* FROM vagas as v
                                        INNER JOIN nivel as n
                                        ON n.ID = v.nivel
                                        INNER JOIN modelo as m
                                        ON m.id = v.modelo
                                    WHERE v.id_empresa = :id
                                    AND v.ativo = :ativo');

        $sql->bindParam(':id', $idEmpresa);
        $sql->bindValue(':ativo', 1);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function excluirVaga($idVaga, $idEmpresa){

        try {
            $sql = $this->conn->prepare(' UPDATE vagas
                                            SET ativo = 0
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
        $sql = $this->conn->prepare('SELECT * FROM vagas as v
                                    WHERE v.idVaga = :id');

        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function atualizarVaga($idVaga, $nome, $rs, $modelo, $desc, $req, $valoresSelecionados = null){
        try {
            $sql = 'UPDATE vagas 
                SET nome = :nome, salario = :rs, modelo = :modelo, descricao = :desc, requisitos = :req';
            
            if($valoresSelecionados){
                $sql .= ', cursos = :cursos';
            }
                    
            $sql .= ' WHERE idVaga = :idVaga';

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':rs', $rs);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':req', $req);

            if($valoresSelecionados){
                $stmt->bindParam(':cursos', $valoresSelecionados);
            }
            
            $stmt->bindParam(':idVaga', $idVaga);

            // Executa a query
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}

