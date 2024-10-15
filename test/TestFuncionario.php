<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/funcionario.php';

class TestFuncionarioController extends UnitTestCase {

    private $controller;

    
    public function setUp() {
        $this->controller = new funcionarioController();
    }

    
    public function testSalvarFuncionarioComDadosValidos() {
        
        $nome = 'João da Silva';
        $email = 'joao@empresa.com';
        $idEmpresa = 7;

        
        ob_start(); 
        $resultado = $this->controller->salvar($nome, $email, $idEmpresa);
        $saida = ob_get_clean(); 

        
        $resultadoDecodificado = json_decode($saida, true);

        
        $this->assertTrue($resultadoDecodificado['success']);
        $this->assertTrue($resultadoDecodificado['tittle'], 'Sucesso!');
        $this->assertTrue($resultadoDecodificado['msg'], 'Funcionário criado!');
        $this->assertTrue($resultadoDecodificado['icon'], 'success');
    }
  }