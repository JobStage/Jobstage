<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once __DIR__ . '/../model/CursosdbModel.php';

class cursos{
  private $cursosDB;
  public function __construct() {
    $this->cursosDB = new CursosDBModel();
   
  }
  public function listaCursos($id){
    $html = '<option> </option>';
    foreach($this->cursosDB->getAllCursos($id) as $value){
      $html.='<option value='. $value['ID'] .'>'. $value['curso'] .'</option>';
    }
    echo json_encode($html);
    return $html;
  }
  public function getNivel(){
    foreach($this->cursosDB->getNivel() as $value){
      echo'<option value='. $value['ID'] .'>'. $value['nivel'] .'</option>';
    }
  }
}
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