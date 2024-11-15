<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

require_once __DIR__ . '/../model/chartsModel.php';


class chartController{
    private $chart;

    public function __construct() {
        $this->chart = new chartsModel();
    
    }

    public function graphAluno(){
        echo json_encode($this->chart->graphAluno());
    }
    
    public function graphEmpresa($id){
        echo json_encode($this->chart->graphEmpresa($id));
    }

    public function graphAdmin(){
        echo json_encode($this->chart->graphAdmin());
    }
}