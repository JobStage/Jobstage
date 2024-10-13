<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/contratosController.php';

class TestContrato extends UnitTestCase {

  private $controller;

  // Método setUp para inicializar o controlador antes dos testes
  public function setUp() {
      $this->controller = new contratosController(); // Substitua 'YourController' pelo nome da sua classe
  }

  // Testa a geração de contrato com dados válidos
  public function testGerarContratoEmpresaComDadosValidos() {
    // Define os dados válidos
    $idAluno = 1;
    $idVaga = 1;
    $idEmpresa = 1;

    // Inicia o buffer de saída
    ob_start();
    $this->controller->gerarContratoEmpresa($idAluno, $idVaga, $idEmpresa);
    $saida = ob_get_clean(); // Captura a saída e limpa o buffer

    // Decodifica a saída JSON
    $resultadoDecodificado = json_decode($saida, true);

    // Verifica se o resultado é o esperado
    if ($resultadoDecodificado) {
        $this->assertTrue(is_array($resultadoDecodificado), "A saída JSON não é um array.");
        $this->assertTrue($resultadoDecodificado['success'], "A solicitação não foi bem-sucedida.");
        $this->assertEqual($resultadoDecodificado['msg'], 'Solicitação enviada! Aguarde a geração de contrato.', "Mensagem de sucesso não corresponde.");
    } else {
        $this->fail("saída JSON nula");// assertTrue sempre forçara a  dar certo
    }
}
}