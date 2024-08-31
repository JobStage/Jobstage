<?php
require_once __DIR__ . '/../app/controller/loginController.php';
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';

class TestExperienciaController extends UnitTestCase {

    private $controller;

    public function setUp() {
        $this->controller = new LoginController();
    }

    public function testCriarExperienciaSemErro() {
        try {
            $senha = md5('555');
            $email = 'teste_aluno_' . time() . '@example.com'; // Garante que o e-mail é único

            $retorno = $this->controller->cadastroAluno($email, $senha);

            $this->assertTrue(is_array($retorno), "O retorno não é um array.");
            $this->assertTrue(array_key_exists('title', $retorno), "A chave 'title' não está presente no retorno.");
            $this->assertEqual($retorno['title'], 'Sucesso', $retorno['msg']);
        } catch (Exception $e) {
            $this->fail("Erro ao executar o método: " . $e->getMessage());
        }
    }

    public function testCriarCadastroEmpresa() {
        try {
            $senha = md5('555');
            $email = 'teste_empresa_' . time() . '@example.com'; // Garante que o e-mail é único

            $retorno = $this->controller->cadastroEmpresa($email, $senha);

            $this->assertTrue(is_array($retorno), "O retorno não é um array.");
            $this->assertTrue(array_key_exists('title', $retorno), "A chave 'title' não está presente no retorno.");
            $this->assertEqual($retorno['title'], 'Sucesso', $retorno['msg']);
        } catch (Exception $e) {
            $this->fail("Erro ao executar o método: " . $e->getMessage());
        }
    }
}
