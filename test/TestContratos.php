<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/contratosController.php';

class TestContrato extends UnitTestCase {

  private $controller;

  public function setUp() {
      $this->controller = new contratosController(); 
  }

  public function testGerarContratoEmpresaComDadosValidos() {
    $idAluno = 34; // idAluno existente no banco
    $idVaga = 34; // idVaga existente no banco
    $idEmpresa = 7; // idEmpresa existente no banco

  
    ob_start();
    $this->controller->gerarContratoEmpresa($idAluno, $idVaga, $idEmpresa);
    $saida = ob_get_clean(); 

    
    $resultadoDecodificado = json_decode($saida, true);

   
    if ($resultadoDecodificado) {
        $this->assertEqual(is_array($resultadoDecodificado), "A saída JSON não é um array.");//true
        $this->assertTrue($resultadoDecodificado['success'], "A solicitação não foi bem-sucedida.");
        $this->assertEqual($resultadoDecodificado['msg'], 'Solicitação enviada! Aguarde a geração de contrato.', "Mensagem de sucesso não corresponde.");
    } else {
        $this->fail("saída JSON nula");
    }
}
}