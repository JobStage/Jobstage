<?php
require_once __DIR__ . '/../app/controller/matricula.php';
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';

class TestMatriculaController extends UnitTestCase {
  private $controller;

  public function setUp() {
      $this->controller = new matricula();
  }


  public function testAprovarMatricula() {
    try {
        $id = 34; // Substitua pelo ID válido 
        $retorno = $this->controller->aprovarMatricula($id);

        
        $this->assertTrue(is_array($retorno), "O retorno nao e um array.");
        $this->assertTrue(array_key_exists('success', $retorno), "A chave 'success' nao esta presente no retorno.");
        $this->assertTrue($retorno['success'], "A matricula nao foi aprovada com sucesso.");
        $this->assertEqual($retorno['tittle'], 'Sucesso', $retorno['msg']);
    } catch (Exception $e) {
        $this->fail("Erro ao executar o método: " . $e->getMessage());
    }
}

public function testReprovarMatricula() {
 
  $idMatricula = 1; 

 
  $resultado = $this->controller->reprovarMatricula($idMatricula);
  
  
  $this->assertTrue($resultado['success'], "A matrícula deveria ser reprovada com sucesso.");
  $this->assertEqual($resultado['msg'], 'Matrícula reprovada', "A mensagem deve ser 'Matrícula reprovada'.");
}

}