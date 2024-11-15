<?php

class Conexao {
    
    private $host = 'localhost';
    private $db = 'jobstage';
    private $user = 'root';
    private $passwd = '';
    private $connection;

    public function __construct() {
        $this->connection = $this->conn();
    }

    public function conn(){
        try{
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->passwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e){
            echo "Error -> " . $e->getMessage();
            return null;
        }
    }

    public function logs($msg){
        $dataHoraObj = new DateTime();
        $dataHoraObj->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        $dataHoraFormatada = $dataHoraObj->format('Y-m-d H:i:s');

        $sql = $this->connection->prepare("INSERT INTO logs (mensagem, dataHora) VALUES (:msg, :dataHora)");
        $sql->bindParam(":msg", $msg);
        $sql->bindParam(":dataHora", $dataHoraFormatada);
        
        $sql->execute();
    }    

    public function listarLogs(){
        $sql = $this->connection->prepare("SELECT * FROM logs");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $v){
            echo ' <tr>
                    <th scope="row">'.$v['id'].'</th>
                    <td>'.$v['mensagem'].'</td>
                    <td>'.$v['dataHora'].'</td>
                </tr>';
        }
    }
}