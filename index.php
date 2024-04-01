<?php

require_once './class/aluno.php';
require_once './class/cursos.php';
require_once './class/experiencia.php';
require_once './class/formacao.php';
require_once './class/empresa.php';
require_once './class/mensagem.php';
require_once './class/vaga.php';
require_once './class/Perguntas.php';
require_once './class/Candidatura.php';
require_once './class/Curriculo.php';
require_once './class/agencia.php';
require_once './class/contrato.php';
require_once './class/instituicao.php';

$aluno = new Aluno();
$dataAluno = new DateTime('2024-01-01');
$aluno->cadastrarAluno(14, 'asd', 2, 'asd@gmail.com', 'asd', 'asd', 1234, 'horpg', 'dasd', $dataAluno);
$aluno->editarAluno(1);


$cursos = new Cursos();
$cursos->criarCurso('adm', 'senac', 1, 'intermediario');
$cursos->editarCurso(1);
$cursos->excluirCurso(1);
$cursos->listarCurso();


$experiencia = new Experiencia();
$dataExp = new DateTime('2024-01-01');
$experiencia->criarExperiencia('empresa', 'TI', $dataExp, 'atual', 'CLT', 'atividades teste');
$experiencia->editarExperiencia(1);
$experiencia->excluirExperiencia(1);
$experiencia->listarexperiencia();


$formacao = new Formacao();
$formacao->criarFormacao('TI', 'senai', 'superior', 3, 'andamento'); 
$formacao->editarFormacao(1); 
$formacao->excluirFormacao(1); 
$formacao->listarFormacao(); 


$empresa = new Empresa();
$empresa->cadastrarVagas(1,'Empresa X', '12.345.678/0001-90', 'Rua das Flores, 123', 4197767551320);
$empresa->editarVagas(1);
$empresa->removerVagas(1);
$empresa->listarVagas();


$mensagem = new Mensagem();
$mensagem->enviarMensagem('Conteudo...');


$vaga = new Vaga();
$vaga->cadastrar(1, 'Estagio QA', 'resolucao de problemas', 'Cursando 3°Período', 'Paraná', 'Curitiba');

$perguntas = new Perguntas();
$perguntas->candidatar(1,890567);

$candidatura = new Candidatura();
$candidatura->mostrarCandidaturas(1,890590);

$curriculo = new Curriculo();
$curriculo->gerarCurriculo(35);
$curriculo->baixarCurriculo(35);

$contrato = new Contrato();
$contrato->listarContrato();

$instituicao = new Instituicao();
$instituicao->cadastrarInstituicao(1, 'Instituição X', 'Rua Roberto carlos, 159', 40028922,);
$instituicao->editarInstituicao(1);
$instituicao->excluirInstituicao(1);

$agencia = new Agencia();
$agencia->validaMatricula();