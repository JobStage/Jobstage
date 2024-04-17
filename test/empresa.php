<?php
require_once '../class/Empresa.php';
require_once '../class/Vaga.php';

$vaga = new Vaga(1);

$empresa = new Empresa($vaga);
$empresa->cadastrarVagas('VOLVO', '12.345.678/0001-90', 'Rua das Flores, 123', 41987654321);
$empresa->editarVagas(1, 'CIEE', '13.312.655/0002-70','Rua Madalena, 321', 4191234567);
$empresa->removerVagas(1);
$empresa->listarVagas();