<?php
require_once '../class/instituicao.php';

$instuicao = new Instituicao(1);
$instuicao->cadastrarInstituicao('Instituição X', 'Rua Roberto carlos, 159', 40028922);
$instuicao->editarInstituicao(1);
$instuicao->excluirInstituicao();