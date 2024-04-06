<?php
require_once 'class\Cursos.php';
require_once 'class\Aluno.php';

$aluno = new Aluno(1);

$cursos = new Cursos($aluno);
$cursos->criarCurso('adm', 'senac', 1, 'intermediario');
$cursos->editarCurso(1, 'TI', 'Senai', 1, 'iniciante');
$cursos->excluirCurso(1);
$cursos->listarCurso();

