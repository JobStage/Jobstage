<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/model/AlunoModel.php';
require_once __DIR__ . '/../app/controller/cadastroAluno.php';

class TestCadastro extends UnitTestCase {
    
    private $cadastro;

    public function setUp() {
        $this->cadastro = new Cadastro(); 
    }

    public function testInserirNovoAluno() {
      try {
        $_POST = array(
          'email' => 'teste_aluno' . time() . '@example.com',
          'senha' => md5('555'),
      );
              
        $this->cadastro->inserirAluno( $_POST['email'], $_POST['senha']);
        $this->assertTrue(true, "Nenhum erro ocorreu durante a execução do método.");
      } catch (Exception $e) {
          $this->fail("Erro ao executar o método: " . $e->getMessage());
      }
    }
}
