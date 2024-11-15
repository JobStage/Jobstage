<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once '../controller/funcionario.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao']?? null;
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $area = $_POST['area'] ?? '';
    $formacao = new funcionarioController();
    switch($acao){
        case 'salvar':
           $formacao->salvar($nome, $email, $_SESSION['id'], $area);
        break;
        case 'listarFuncionariosSupervisor':
            $formacao->listarFuncionarioSupervisor($_SESSION['id']);
        break;
    }
}