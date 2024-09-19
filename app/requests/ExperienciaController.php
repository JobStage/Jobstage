<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once '../controller/ExperienciaController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $id = $_POST['id'] ?? '';
    $idAluno = $_SESSION['id'];
    $experiencia = new ExperienciaController();
    switch($acao){
        case 'salvar':
            $experiencia->criarExperiencia($idAluno,$_POST['cargo'], $_POST['empresa'], $_POST['tipo'], $_POST['inicio'], $_POST['fim'], $_POST['atividade']);
            break;
        case 'editar':
            $experiencia->editarExperiencia($idAluno,$id);
        break;
        case 'excluir':
           $experiencia->excluirExperiencia($_POST['id'],$idAluno);
        break;
        case 'getAll':
            $response = $experiencia->getAllExperiencia($idAluno,$id);
            $arr = array( 'id_exp' => $response['0']['id_exp'],
                            'nome' => $response['0']['nome'],
                            'cargo' => $response['0']['cargo'],
                            'inicio' => $response['0']['inicio'],
                            'fim' => $response['0']['fim'],
                            'tipo' => $response['0']['tipo'],
                            'atividades' => $response['0']['atividades'],
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
    }
}