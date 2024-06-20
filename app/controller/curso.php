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
  public function listaCursos(){
    
    foreach($this->cursosDB->getAllCursos() as $value){
      echo'<option value='. $value['id'] .'>'. $value['curso'] .'</option>';
    }
  }
  public function getNivel(){
    foreach($this->cursosDB->getNivel() as $value){
      echo'<option value='. $value['id'] .'>'. $value['nivel'] .'</option>';
    }
  }
}