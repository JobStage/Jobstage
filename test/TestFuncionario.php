<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/funcionario.php';

class TestFuncionarioController extends UnitTestCase {

    private $controller;

    // Método setUp para inicializar o controlador antes dos testes
    public function setUp() {
        $this->controller = new funcionarioController();
    }

    // Testa a criação de um funcionário com dados válidos
    public function testSalvarFuncionarioComDadosValidos() {
        // Define os dados válidos
        $nome = 'João da Silva';
        $email = 'joao@empresa.com';
        $idEmpresa = 1;

        // Captura a saída JSON
        ob_start(); // Inicia o buffer de saída
        $resultado = $this->controller->salvar($nome, $email, $idEmpresa);
        $saida = ob_get_clean(); // Captura e limpa o buffer de saída

        // Decodifica a saída JSON
        $resultadoDecodificado = json_decode($saida, true);

        // Verifica se o resultado é o esperado
        $this->assertFalse($resultadoDecodificado['success']);
        $this->assertTrue($resultadoDecodificado['tittle'], 'Sucesso!');
        $this->assertTrue($resultadoDecodificado['msg'], 'Funcionário criado!');
        $this->assertTrue($resultadoDecodificado['icon'], 'success');
    }
  }