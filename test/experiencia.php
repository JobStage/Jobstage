<?php
require_once 'class\Experiencia.php';
require_once 'class\Aluno.php';

$aluno = new Aluno(1);

$experiencia = new Experiencia($aluno);
$dataExp = new DateTime('2024-01-01');
$experiencia->criarExperiencia('empresa', 'TI', $dataExp, 'atual', 'CLT', 'atividades teste');
$experiencia->editarExperiencia(1, 'empresa 2', 'TI', $dataExp, 'atual', 'CLT', 'atividades teste');
$experiencia->excluirExperiencia(1);
$experiencia->listarexperiencia();

