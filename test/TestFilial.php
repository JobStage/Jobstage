<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/FilialController.php';

class TestFilialController extends UnitTestCase {

    private $controller;

    // Método setUp para inicializar o controlador antes dos testes
    public function setUp() {
        $this->controller = new FilialController();
        // Configurar a sessão para simular uma sessão ativa
        $_SESSION['id'] = 1; // Define um ID de sessão fictício
    }

    // Testa a criação de uma filial com dados válidos
    public function testCriarFilialComDadosValidos() {
      $nome = "Filial Teste";
      $niveis = ["Nível 1", "Nível 2"];
  
      // Captura a saída JSON
      ob_start(); // Inicia o buffer de saída
      $resultado = $this->controller->criarFilial($nome, $niveis);
      $saida = ob_get_clean(); // Captura e limpa o buffer de saída
  
      // Decodifica a saída JSON
      $resultadoDecodificado = json_decode($saida, true);
  
      // Verifica se o resultado é o esperado
      if ($resultadoDecodificado !== null) {
          $this->assertTrue(is_array($resultadoDecodificado), "A saída JSON não é um array.");
          $this->assertTrue($resultadoDecodificado['success'], "A filial não foi criada com sucesso.");
          $this->assertEqual($resultadoDecodificado['msg'], 'Filial criada com sucesso!', "Mensagem de sucesso não corresponde.");
      } else {
          $this->fail("A saída JSON foi nula.");
      }
  }
}
