<?php
session_start(); 

require_once "../controller/AlunoController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $aluno = new AlunoController($_SESSION['id']);
    switch($acao){
        case 'getAll':
            $response = $aluno->getAll();
            $arr = array(   
                'id'=>$response['ID'],
                'nome'=>$response['nome'],
                'email'=>$response['email'],
                'nasc'=>$response['data_nasc'],
                'tel'=>$response['telefone'],
                'civil'=>$response['estado_civil'],
                'cidade'=>$response['cidade'],
                'estado'=>$response['estado'],
                'cep'=>$response['CEP'],
                'rua'=>$response['rua'],
                'numero'=>$response['numero'],
                'sobre'=>$response['descricao'],
                'link'=>$response['linkedin'],
                'cadastro'=>$response['cadastro_completo'],
            );
            echo json_encode($arr);
            return $arr;
        break;
        case 'editar':
            $result = $aluno->editarAluno();
        break;
    }
    

}
