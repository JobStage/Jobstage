<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once '../controller/FormacaoController.php';
require_once '../controller/matricula.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao']?? null;
    $id = $_POST['id'] ?? '';
    $formacao = new FormacaoController($_SESSION['id']);
    switch($acao){
        case 'editar':
           $formacao->editarFormacao($_SESSION['id'], $idFormacao = $_POST['idFormacao'], $curso = $_POST["curso"], $instituicao = $_POST["instituicao"], $nivel = $_POST["nivel"], $inicio = $_POST["inicio"], $fim = $_POST["fim"], $status = $_POST["status"], $arquivo = $_FILES['file'] ?? '');
        break;
        case 'excluir':
            $formacao->excluirFormacao($_POST['idFormacao'], $_SESSION['id']);
        break;
        case 'getAll':
            $response = $formacao->getAllFormacao($id, $_SESSION['id']);
            $arr = array( 'id_formacao' => $response['0']['id_formacao'],
                            'curso' => $response['0']['curso'],
                            'instituicao' => $response['0']['instituicao'], 
                            'nivel' => $response['0']['nivel'],
                            'inicio' => $response['0']['inicio'], 
                            'fim' => $response['0']['fim'], 
                            'status' => $response['0']['status'],
                            'matricula' => $response['0']['matricula'], 
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
        case 'criar':
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $formacao->criarFormacao($curso = $_POST["curso"], $instituicao = $_POST["instituicao"], $nivel = $_POST["nivel"], $inicio = $_POST["inicio"], $fim = $_POST["fim"], $status = $_POST["status"], $arquivo = $_FILES['file'], $_SESSION['id']);
            }
        break;
    }
}