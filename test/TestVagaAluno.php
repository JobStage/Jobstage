<?php
require_once __DIR__ . '/../app/controller/vagaAluno.php';
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';

class TestVagaController extends UnitTestCase {
  private $controller;

  public function setUp() {
  //   if (session_status() === PHP_SESSION_NONE) {
  //     session_start(); // Inicia a sessão se ainda não estiver iniciada
  // }
    $_SESSION['id'] = 34; // Coloque um ID do Aluno existente no banco
    $this->controller = new VagasController();
}

public function testCandidatarComSucesso() {
    try {
        $idVaga = 16; // Coloque o ID da vaga existente no banco
        $idEmpresa = 7; // Coloque o ID da Empresa existente no banco

        ob_start(); 
        $this->controller->candidatar($idVaga, $idEmpresa);
        $output = ob_get_clean(); 
        $retorno = json_decode($output, true); 

        // Verificações
        $this->assertTrue(is_array($retorno), "O retorno não é um array.");
        $this->assertTrue(array_key_exists('tittle', $retorno), "A chave 'tittle' não está presente no retorno.");
        $this->assertEqual($retorno['tittle'], 'Sucesso', $retorno['msg']);
    } catch (Exception $e) {
        $this->fail("Erro ao executar o método: " . $e->getMessage());
    }
}
}