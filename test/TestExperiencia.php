<?php

require_once __DIR__ . '/../app/controller/ExperienciaController.php'; 
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php'; 

class TestExperienciaController extends UnitTestCase {

    private $controller;

    // Método para instanciar a classe
    public function setUp() {
        $this->controller = new ExperienciaController();
    }

    // Função para testar a criação de uma experiência sem erro
    public function testCriarExperienciaSemErro() {
        // Mock de $_POST com todos os campos preenchidos
        $_POST = array(
            'empresa' => 'Empresa Teste',
            'cargo' => 'Desenvolvedor',
            'inicio' => '2022-01-01',
            'fim' => '2023-01-01',
            'tipo' => 'Full-time',
            'atividade' => 'Desenvolvimento de software'
        );

        // Chamando o método para verificar se não ocorre erro
        try {
            $this->controller->criarExperiencia(1, $_POST['cargo'], $_POST['empresa'], $_POST['tipo'], $_POST['inicio'], $_POST['fim'], $_POST['atividade']);
            $this->assertTrue(true, "Nenhum erro ocorreu durante a execução do método.");
        } catch (Exception $e) {
            $this->fail("Erro ao executar o método: " . $e->getMessage());
        }
    }
}
