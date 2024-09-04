<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once '../controller/curso.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $curso= new cursos();
  $acao = $_POST['tipo'];
  switch ($acao) {
    case 'listarCurso':
      $curso->listaCursos($_POST['nivel']);
      break;
    
    default:
      # code...
      break;
  }
}