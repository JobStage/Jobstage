<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once "../controller/EmpresaController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $empresa = new EmpresaController($_SESSION['id']);
    switch($acao){
        case 'getAll':
            $response = $empresa->getAll();
            $arr = array(
                'id'=>$response['id_empresa'],
                'nome'=>$response['nome'],
                'email'=>$response['email'],
                'cnpj'=>$response['cnpj'],
                'contato'=>$response['contato'],
                'estado'=>$response['estado'],
                'cidade'=>$response['cidade'],
                'cep'=>$response['cep'],
                'rua'=>$response['rua'],
                'numero'=>$response['numero'],
            );
            echo json_encode($arr);
            return $arr;
        break;
        case 'editar':
            $result = $empresa->atualizarEmpresa();
        break;
    }
}