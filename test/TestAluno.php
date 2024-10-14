<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/model/AlunoModel.php';
require_once __DIR__ . '/../app/controller/cadastroAluno.php';

class TestCadastro extends UnitTestCase {
    
    private $cadastro;

    public function setUp() {
        $this->cadastro = new Cadastro(); // Instanciação da classe para teste
    }

    // Teste para inserir um novo aluno com sucesso
    public function testInserirNovoAlunoComSucesso() {
        $email = 'teste_aluno_' . time() . '@example.com';
        $senha = md5('555');
        //$tipo = 'aluno';

        // Simula o REQUEST_METHOD e os dados do POST
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $email;
        $_POST['senha'] = $senha;
        //$_POST['tipo'] = $tipo; 

      try {
        $this->cadastro->inserirAluno( $_POST['email'], $_POST['senha']);
        $this->assertTrue(true, "Nenhum erro ocorreu durante a execução do método.");
      } catch (Exception $e) {
          $this->fail("Erro ao executar o método: " . $e->getMessage());
      }
    }
}
