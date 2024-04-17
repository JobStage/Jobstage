<?php
require_once '../class/agencia.php';

$agencia = new Agencia(1,'Agencia X');
$agencia->exibirDetalhes(); // ALTERAÇÃO
$agencia->validarMatricula(1, 2, 3, 4);