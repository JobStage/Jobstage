<?php
require_once 'class\Aluno.php';

$aluno = new Aluno(1);
$dataAluno = new DateTime('2024-01-01');
$aluno->cadastrarAluno('Newt', 'ADS', 3, 'a@gmail.com', 'passwd', 'solteiro', 41999999999, 'linkLinkedin', 'descricao', $dataAluno);
$aluno->editarAluno(1);
