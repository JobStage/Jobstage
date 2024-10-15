<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/FilialController.php';

class TestFilialController extends UnitTestCase {

    private $controller;

    
    public function setUp() {
        $this->controller = new FilialController();
        
        $_SESSION['id'] = 1; // Define um ID de sessão fictício
    }

    
    public function testCriarFilialComDadosValidos() {
      $nome = "Filial Teste";
      $niveis = ["Nível 1", "Nível 2"];
  
     
      ob_start();
      $resultado = $this->controller->criarFilial($nome, $niveis);
      $saida = ob_get_clean(); 
  
      
      $resultadoDecodificado = json_decode($saida, true);
  
      
      if ($resultadoDecodificado !== null) {
          $this->assertTrue(is_array($resultadoDecodificado), "A saída JSON não é um array.");
          $this->assertTrue($resultadoDecodificado['success'], "A filial não foi criada com sucesso.");
          $this->assertEqual($resultadoDecodificado['msg'], 'Filial criada com sucesso!', "Mensagem de sucesso não corresponde.");
      } else {
          $this->fail("A saída JSON foi nula.");
      }
  }
}
