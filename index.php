<?php

require_once './class/aluno.php';
require_once './class/cursos.php';
require_once './class/experiencia.php';
require_once './class/formacao.php';


$aluno = new Aluno();
$dataAluno = new DateTime('2024-01-01');
$aluno->cadastrarAluno(14, 'asd', 2, 'asd@gmail.com', 'asd', 'asd', 1234, 'horpg', 'dasd', $dataAluno);
$aluno->editarAluno(1);


$cursos = new Cursos();
$cursos->criarCurso('adm', 'senac', 1, 'intermediario');
$cursos->editarCurso(1);
$cursos->excluirCurso(1);
$cursos->listarCurso();


$experiencia = new Experiencia();
$dataExp = new DateTime('2024-01-01');
$experiencia->criarExperiencia('empresa', 'TI', $dataExp, 'atual', 'CLT', 'atividades teste');
$experiencia->editarExperiencia(1);
$experiencia->excluirExperiencia(1);
$experiencia->listarexperiencia();


$formacao = new Formacao();
$formacao->criarFormacao('TI', 'senai', 'superior', 3, 'andamento'); 
$formacao->editarFormacao(1); 
$formacao->excluirFormacao(1); 
$formacao->listarFormacao(); 