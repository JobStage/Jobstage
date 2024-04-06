<?php
require_once 'class\Vaga.php';

$vaga = new Vaga(1);
$dataVaga = new DateTime('2024-01-05');
$vaga->candidatar('Analista de Sistema', '6 horas de estagio', 'R$ 9,40 a hora', 'cursando TI', 'Parana', 'Curitiba');