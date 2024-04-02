<?php
require_once '../class/formacao.php';
require_once '../class/aluno.php';

$aluno = new Aluno(1);

$formacao = new Formacao($aluno);
$formacao->criarFormacao('TI', 'senai', 'superior', 3, 'andamento'); 
$formacao->editarFormacao(1, 'TI', 'senai', 'superior', 3, 'concluido'); 
$formacao->excluirFormacao(1); 
$formacao->listarFormacao(); 