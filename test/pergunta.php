<?php
require_once 'class\Perguntas.php';
require_once 'class\vaga.php';

$vaga = new Vaga(1);
$pergunta = new Perguntas($vaga);
$pergunta->candidatar();
