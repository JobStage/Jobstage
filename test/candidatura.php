<?php
require_once 'class\Candidatura.php';
require_once 'class\vaga.php';

$vaga = new Vaga(1);
$candidatura = new Candidatura($vaga);
$candidatura->mostrarCandidaturas();
