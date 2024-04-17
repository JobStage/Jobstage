<?php
require_once '../class/Curriculo.php';
require_once '../class/aluno.php';

$aluno = new Aluno(1);
$curriculo = new Curriculo($aluno);
$curriculo->gerarCurriculo();