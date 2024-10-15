<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/controller/curso.php'; 

class TestCursosController extends UnitTestCase {

    private $controller;

    
    public function setUp() {
        $this->controller = new cursos(); 
    }

    public function testListaCursos() {
        $_POST = array(
            'tipo' => 'listarCurso',
            'nivel' => 1
        );

        ob_start(); 
        $resultado = $this->controller->listaCursos($_POST['nivel']);
        $output = ob_get_clean(); 

      
        $this->assertTrue(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }

    public function testListaCursosEdit() {
        $_POST = array(
            'tipo' => 'listarCursoEdit',
            'nivel' => 1
        );

        
        ob_start(); 
        $resultado = $this->controller->listaCursosEdit($_POST['nivel']);
        $output = ob_get_clean(); 

        
        $this->assertTrue(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }

    public function testGetNivel() {
        
        ob_start(); 
        $this->controller->getNivel();
        $output = ob_get_clean(); 

        
        $this->assertEqual(strpos($output, '<option') !== false, "A saída deve conter opções.");
    }
}
