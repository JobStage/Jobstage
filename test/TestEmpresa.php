<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/model/classCadastro.php';
require_once __DIR__ . '/../app/controller/cadastroEmpresa.php';

class TestCadastro extends UnitTestCase {
    
    private $cadastro;

    public function setUp() {
        $this->cadastro = new Cadastro(); 
    }

    public function testInserirNovaEmpresaComSucesso() {
        $email = 'teste_empresa_' . time() . '@example.com';
        $senha = md5('555');
      
        
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email;
        $_POST['senha'] = $senha;
    
      try {
        $this->cadastro->inserirEmpresa( $_POST['email'], $_POST['senha']);
        $this->assertTrue(true, "Nenhum erro ocorreu durante a execução do método.");
      } catch (Exception $e) {
          $this->fail("Erro ao executar o método: " . $e->getMessage());
      }
    }
}
