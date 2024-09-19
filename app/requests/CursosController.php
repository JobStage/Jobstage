<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once '../controller/CursosController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $id = $_POST['id'] ?? '';
    $idAluno = $_SESSION['id'];
    $curso = new CursosController();
    switch($acao){
        case 'salvar':
            $curso->criarCurso($_POST['nome'], $_POST['instituicao'], $_POST['nivel'], $_POST['inicio'], $_POST['fim'], $_POST['status'],$idAluno);
            break;
        case 'editar':
            $curso->editarCurso($idAluno);
        break;
        case 'excluir':
           $curso->excluirCurso($_POST['idCurso'],$idAluno);
        break;
        case 'getAll':
            $response = $curso->getAllCurso($idAluno,$id);
            $arr = array( 'id_curso' => $response['0']['id_curso'],
                            'nome_curso' => $response['0']['nome_curso'],
                            'instituicao' => $response['0']['instituicao'],
                            'inicio' => $response['0']['inicio'],
                            'fim' => $response['0']['fim'],
                            'status' => $response['0']['status'],
                            'nivel' => $response['0']['nivel'],
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
    }
}