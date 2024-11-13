<?php

require_once __DIR__."/../config/conexao.php";


class vagaEmpresaModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }
   
    public function inserirPerguntas($vagaId, $perguntas){
        try {
                    // Se as perguntas vierem como uma string separada por vírgulas, converta para um array
            if (is_string($perguntas)) {
                $perguntas = explode(',', $perguntas);
            }

            // Inserir cada pergunta individualmente
            $query = "INSERT INTO perguntas (id_vaga, pergunta) VALUES (:vaga_id, :pergunta)";
            $stmt = $this->conn->prepare($query);

            foreach ($perguntas as $pergunta) {
                $stmt->bindParam(':vaga_id', $vagaId);
                $stmt->bindParam(':pergunta', $pergunta); 
                $stmt->execute();
            }
            return true;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    } 


    public function criarVaga($supervisor, $nome, $rs, $modelo, $nivel, $desc, $req, $idEmpresa, $area = null, $valoresSelecionados = null, $ensinoMedio = null, $perguntas= null){
        try {
        
        $this->conn->beginTransaction();
        
        $sql = $this->conn->prepare("INSERT INTO vagas (nome, salario, modelo, nivel, descricao, requisitos, setor, cursos,  id_empresa, id_funcionario) 
                                     VALUES (:nome, :rs, :modelo, :nivel, :descricao, :requisitos, :area, :valores_selecionados, :id, :funcionario)");

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':rs', $rs);
        $sql->bindParam(':modelo', $modelo);
        $sql->bindParam(':nivel', $nivel);
        $sql->bindParam(':descricao', $desc);
        $sql->bindParam(':requisitos', $req);
        $sql->bindParam(':area', $area);
        $sql->bindParam(':funcionario', $supervisor);

        if($valoresSelecionados){
            $sql->bindParam(':valores_selecionados', $valoresSelecionados);
        }else{
            $sql->bindParam(':valores_selecionados', $ensinoMedio);
        }

        $sql->bindParam(':id', $idEmpresa);
        $sql->execute();

        // Obter o ID da vaga recém-criada
        $idVaga = $this->conn->lastInsertId();

        if ($perguntas) {
            $this->inserirPerguntas($idVaga, $perguntas);
        }

        $this->conn->commit();
        return true;

        } catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getAllVagas($idEmpresa){
        try {
            $sql = $this->conn->prepare('SELECT DISTINCT n.nivel as nomeNivel, m.modelo as modeloVaga, v.* FROM vagas as v
                                     INNER JOIN nivel as n ON n.ID = v.nivel
                                     INNER JOIN modelo as m ON m.id = v.modelo
                                WHERE v.id_empresa = :id
                                AND v.ativo = :ativo');
    
            $sql->bindParam(':id', $idEmpresa);
            $sql->bindValue(':ativo', 1);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $result;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
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
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getVagaFiltado($id){
        try {
            $sql = $this->conn->prepare('SELECT f.nome as nomeFunc, v.*, p.* FROM vagas as v
                                            INNER JOIN funcionarios as f
                                                ON v.id_funcionario = f.id
                                            LEFT JOIN perguntas as p
                                            ON p.id_vaga = v.idVaga
                                            WHERE v.idVaga = :id');
    
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
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
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}

