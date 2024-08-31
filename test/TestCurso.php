<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/curso.php'; // Caminho correto para a classe cursos

class TestCursosController extends UnitTestCase {

    private $controller;

    
    public function setUp() {
        $this->controller = new cursos(); 
    }

    // Testa o método listaCursos
    public function testListaCursos() {
        // Simula a entrada de dados
        $_POST = array(
            'tipo' => 'listarCurso',
            'nivel' => 1
        );

        
        ob_start(); 
        $resultado = $this->controller->listaCursos($_POST['nivel']);
        $output = ob_get_clean(); 

        // Verifica se a saída está correta
        $this->assertTrue(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }

    // Testa o método listaCursosEdit
    public function testListaCursosEdit() {
        // Simula a entrada de dados
        $_POST = array(
            'tipo' => 'listarCursoEdit',
            'nivel' => 1
        );

        
        ob_start(); 
        $resultado = $this->controller->listaCursosEdit($_POST['nivel']);
        $output = ob_get_clean(); 

        // Verifica se a saída está correta
        $this->assertTrue(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }

    // Testa o método getNivel
    public function testGetNivel() {
        
        ob_start(); 
        $this->controller->getNivel();
        $output = ob_get_clean(); 

        // Verifica se a saída está correta
        $this->assertTrue(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }
}
