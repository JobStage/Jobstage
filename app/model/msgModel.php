<?php

require_once __DIR__."/../config/conexao.php";


class msgModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function listarMsg($idEmpresa, $idAluno){
        try {
        $stmt = $this->conn->prepare(" SELECT 'Aluno' AS origem, id, msg, idUsuario, idDestino 
            FROM msgAluno 
            WHERE idUsuario = :idAluno AND idDestino = :idA
            UNION
            SELECT 'Empresa' AS origem, id, msg, idUsuario, idDestino 
            FROM msgEmpresa 
            WHERE idUsuario = :idEmpresa AND idDestino = :idE
            ");

        $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
        $stmt->bindParam(':idEmpresa', $idEmpresa, PDO::PARAM_INT);
        $stmt->bindParam(':idE', $idAluno, PDO::PARAM_INT);
        $stmt->bindParam(':idA', $idEmpresa, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function listarMsgAluno($idEmpresa, $idAluno){
        try {
            $sql = $this->conn->prepare('SELECT e.msg as msgEmpresa, a.msg as msgAluno FROM msgempresa as e
                                        LEFT JOIN msgaluno as a
                                        on e.idDestino = a.idUsuario
                                        WHERE 
                                            e.idUsuario = :idE
                                        AND
                                            e.idDestino = :idA
                                        ');
            $sql->bindParam(':idE', $idEmpresa);
            $sql->bindParam(':idA', $idAluno);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function salvarMsgEmpresa($txt, $idUser, $idDestino){
        date_default_timezone_set('America/Sao_Paulo');

        // Obtém a data e hora atual
        $dataEnvio = date('Y-m-d H:i:s');  // Formato: YYYY-MM-DD HH:MM:SS

        // Prepara a consulta SQL com o campo de data e hora
        $sql = $this->conn->prepare('INSERT INTO msgempresa (msg, idDestino, idUsuario, dataEnvio) VALUES (:msg, :destino, :usuario, :dt)');

        // Vincula os parâmetros
        $sql->bindParam(':msg', $txt);
        $sql->bindParam(':destino', $idDestino);
        $sql->bindParam(':usuario', $idUser);
        $sql->bindParam(':dt', $dataEnvio);  // Vincula a data e hora

        // Executa a consulta
        $sql->execute();

        return true;
    }
    
    public function salvarMsgAluno($txt, $idUser, $idDestino){



        $sql = $this->conn->prepare('INSERT INTO msgaluno (msg, idDestino, idUsuario) VALUES (:msg, :destino, :usuario)');
        $sql->bindParam(':msg', $txt);
        $sql->bindParam(':destino', $idDestino);
        $sql->bindParam(':usuario', $idUser);
        $sql->execute();
        return true;
    }
   
}