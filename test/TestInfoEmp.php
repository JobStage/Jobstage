<?php
// Corrija o caminho para incluir o arquivo corretamente
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/EmpresaController.php';
require_once __DIR__ . '/../app/model/EmpresaModel.php';

class TestEmpresaController extends UnitTestCase {

    private $controller;

    public function setUp() {
        $this->controller = new EmpresaController(1);
    }

    public function testInserirEmpresaSemErro() {
        $_POST = array(
            'idEmpresa' => 32,
            'nome' => 'Empresa Teste',
            'email' => 'email@teste.com',
            'cnpj' => '00.000.000/0000-00',
            'contato' => '123456789',
            'estado' => 'SP',
            'cidade' => 'São Paulo',
            'cep' => '01000-000',
            'rua' => 'Rua Teste',
            'numero' => '123'
        );

        try {
            ob_start();
            $this->controller->inserirEmpresa();
            $output = ob_get_clean();

            $expected = json_encode(array('success' => true, 'title' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success'));
            $this->assertEqual($output, $expected);
        } catch (Exception $e) {
            $this->fail("Erro ao executar o método: " . $e->getMessage());
        }
    }
}
