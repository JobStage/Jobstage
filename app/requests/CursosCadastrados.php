<?php
require_once '../controller/CursosCadastrados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nivel = $_POST['nivel'] ?? '';
    $area = $_POST['area'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $curso = new CursosCadastrados();

    switch($tipo){
        case 'listarArea':
            $curso->listarArea($nivel);
        break;
        case 'listarCursos':
            $curso->listarCursosFiltrados($nivel, $area);
        break;
        case 'listarCurso':
            $curso->listaCursos($_POST['nivel']);
        break;
    }
}