<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/vagaEmpresaController.php';

class TestVagaEmpresaController extends UnitTestCase {
    private $controller;

    // Método para instanciar a classe
    public function setUp() {
        $this->controller = new VagaEmpresaController();
        // Simula a sessão
        $_SESSION['id'] = 1; // ou um valor apropriado
    }

    // Função para testar a criação de uma vaga com sucesso
    public function testCriarVagaComSucesso() {
        // Mock de dados da vaga
        $supervisor = 'Supervisor Teste';
        $nome = 'Vaga Teste';
        $rs = 'RS Teste';
        $modelo = 'Presencial';
        $nivel = 'Júnior';
        $desc = 'Descricao';
        $req = 'Requisitos da vaga teste';
        $area = 'TI';
        $valoresSelecionados = ['Benefício Teste 1', 'Benefício Teste 2'];
        $ensinoMedio = true;
        $perguntas = ['Pergunta 1', 'Pergunta 2'];

        // Inicia o buffer de saída para capturar a resposta JSON
        ob_start();
        $this->controller->criarVaga($supervisor, $nome, $rs, $modelo, $nivel, $desc, $req, $area, $valoresSelecionados, $ensinoMedio, $perguntas);
        $output = ob_get_clean(); // Captura a saída e limpa o buffer

        // // Debug: Imprima a saída real
        echo "Output: " . $output; // Adicione esta linha

        $expectedOutput = json_encode([
            'success' => true, 
            'tittle' => 'Sucesso!', 
            'msg' => 'Vaga criada com sucesso!', 
            'icon' => 'success'
        ]);

        // Asserções
        $this->assertTrue(!empty($output), "A saída não deve estar vazia.");
        $this->assertEqual($output, $expectedOutput, "A vaga deveria ser criada com sucesso.");
    }
}
