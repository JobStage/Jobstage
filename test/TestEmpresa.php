<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/model/classCadastro.php';
require_once __DIR__ . '/../app/controller/cadastroEmpresa.php';

class TestCadastro extends UnitTestCase {
    
    private $cadastro;

    public function setUp() {
        $this->cadastro = new Cadastro(); 
    }

    public function testInserirNovaEmpresa() {
      try {
        $_POST = array(
          'email' => 'teste_empresa' . time() . '@example.com',
          'senha' => md5('555'),
      );
              
        $this->cadastro->inserirEmpresa( $_POST['email'], $_POST['senha']);
        $this->assertTrue(true, "Nenhum erro ocorreu durante a execução do método.");
      } catch (Exception $e) {
          $this->fail("Erro ao executar o método: " . $e->getMessage());
      }
    }
}
