<?php
require_once __DIR__ . '/../app/controller/FormacaoController.php';
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';

class TestFormacaoController extends UnitTestCase {
    private $controller;

    public function setUp() {
        $this->controller = new FormacaoController();
    }

    // public function testCriarFormacaoInvalida() {
    //     // Parâmetros para criar uma formação (dados inválidos)
    //     $curso = 7; // Curso vazio
    //     $instituicao = 'Instituição Exemplo';
    //     $nivel = 'Bacharelado';
    //     $inicio = '2020-01-01';
    //     $fim = '2024-01-01';
    //     $status = 'Concluído';
    
    //     // Use um ID de aluno que realmente existe
    //     $idAluno = 34; // Altere para um ID de aluno existente no seu banco de dados
    
    //     // Chama a função para tentar criar a formação
    //     $resultado = $this->controller->criarFormacao($curso, $instituicao, $nivel, $inicio, $fim, $status, $curso, $idAluno);
        
    //     // Verifica se a criação da formação falhou
    //     $this->assertEqual($resultado['msg'], 'erro', "A mensagem deve ser 'erro'.");
    // }
    public function testCriarFormacaoComErro() {
        try {
            // Defina um ID de aluno que não existe para simular um erro
            $idAluno = 999; // ID que não existe
    
            // Dados para a criação da formação
            $curso = 'ADS';
            $instituicao = 'sesc'; 
            $nivel = 'medio';
            $inicio = '2023-01-01';
            $fim = '2024-01-01';
            $status = 'finalizado';
            $arquivo = [
                'type' => 'application/pdf',
                'tmp_name' => __DIR__ . '/../test/testePDF.pdf' // Caminho para o PDF existente
            ];
    
            // Chamada ao método que está sendo testado
            $retorno = $this->controller->criarFormacao($curso, $instituicao, $nivel, $inicio, $fim, $status, $arquivo, $idAluno);
    
            // Verificações
            $this->assertTrue(is_array($retorno), "O retorno não é um array.");
            $this->assertTrue(array_key_exists('tittle', $retorno), "A chave 'tittle' não está presente no retorno.");
            $this->assertEqual($retorno['tittle'], 'erro', "O título do retorno não é 'erro'.");
        } catch (Exception $e) {
            $this->fail("Erro ao executar o método: " . $e->getMessage());
        }
    }
    
}
