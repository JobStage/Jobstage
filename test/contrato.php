<?php
require_once 'class\contrato.php';
require_once 'class\agencia.php';

$agencia = new Agencia(1, 'Agencia X');

$contrato = new Contrato($agencia);
$contrato->listarContrato();
