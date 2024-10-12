<?php
require_once __DIR__ . '/../app/controller/matricula.php';
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';

class TestMatriculaController extends UnitTestCase {
  private $controller;

  public function setUp() {
      $this->controller = new matricula();
  }

   // Testa a inserção de matrícula com um arquivo PDF válido
//    public function testInserirMatriculaComPdf() {
//     // Crie um arquivo PDF real para o teste
//     $arquivoPdfPath = '/../test/testePDF.pdf'; // Altere para o caminho real do seu arquivo PDF
//     if (!file_exists($arquivoPdfPath)) {
//         $this->fail("O arquivo PDF não existe no caminho especificado.");
//         return;
//     }

//     // Prepare o array de arquivo para simular o upload
//     $arquivoPdf = [
//         'type' => 'application/pdf',
//         'tmp_name' => $arquivoPdfPath
//     ];

//     // Chama a função e verifica se retorna o nome do arquivo renomeado
//     $resultado = $this->controller->inserirMatricula($arquivoPdf);
    
//     // Verifica se o resultado não está vazio
//     $this->assertTrue($resultado, "O retorno deve ser o nome do arquivo renomeado.");
// }
  public function testAprovarMatricula() {
    try {
        $id = 34; // Substitua pelo ID válido que deseja testar
        $retorno = $this->controller->aprovarMatricula($id);

        // Verificações
        $this->assertTrue(is_array($retorno), "O retorno nao e um array.");
        $this->assertTrue(array_key_exists('success', $retorno), "A chave 'success' nao esta presente no retorno.");
        $this->assertTrue($retorno['success'], "A matricula nao foi aprovada com sucesso.");
        $this->assertEqual($retorno['tittle'], 'Sucesso', $retorno['msg']);
    } catch (Exception $e) {
        $this->fail("Erro ao executar o método: " . $e->getMessage());
    }
}

public function testReprovarMatricula() {
  // Insira um ID de matrícula existente para o teste
  $idMatricula = 1; // Altere para um ID válido no seu banco de dados

  // Chama a função para reprovar a matrícula
  $resultado = $this->controller->reprovarMatricula($idMatricula);
  
  // Verifica se o retorno indica sucesso
  $this->assertTrue($resultado['success'], "A matrícula deveria ser reprovada com sucesso.");
  $this->assertEqual($resultado['msg'], 'Matrícula reprovada', "A mensagem deve ser 'Matrícula reprovada'.");
}




//   public function tearDown() {
//       // Aqui você pode limpar outros recursos se necessário
//   }
}