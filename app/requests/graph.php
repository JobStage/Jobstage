<?php
session_start(); 

require_once "../controller/charts.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $chart = new chartController();
    switch($acao){
        case 'dashboardAluno':
            $chart->graphAluno();
        break;
        case 'dashboardEmpresa':
            $chart->graphEmpresa($_SESSION['id']);
        break;
        case 'dashboardAdmin':
            $chart->graphAdmin();
        break;
    }
    

}
