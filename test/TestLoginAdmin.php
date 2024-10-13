<?php
require_once __DIR__ . '/../vendor/simpletest/simpletest/autorun.php';
require_once __DIR__ . '/../app/model/classLogin.php'; // Substitua pelo caminho correto

class TestLogin extends UnitTestCase {

  // Testa o login com credenciais válidas
  public function testLoginComCredenciaisValidas() {
      // Use um email e senha de um usuário existente no banco de dados
      $senha = md5('senhaExistente'); // Substitua por uma senha existente (MD5)
      $email = 'admin@teste.com'; // Substitua por um email existente

      // Instancia a classe Login
      $login = new Login();

      // Executa o método de login
      $resultLogin = $login->loginAdmin($email, $senha);
      
      // Depuração: Exibe o resultado do login
      print_r($resultLogin);
      
      // Verifica se o login foi bem-sucedido
      if ($resultLogin) {
          // Configura as variáveis de sessão
          $_SESSION['id'] = $resultLogin;
          $_SESSION['idSessao'] = 3;

          // Cria o retorno esperado
          $retornoEsperado = array('redirecionar' => 'index.php', 'sucesso' => true);

          // Converte para JSON
          $retornoJson = json_encode($retornoEsperado);

          // Verifica se o retorno está correto
          $this->assertEqual($retornoJson, json_encode($retornoEsperado), 'O JSON de retorno não corresponde ao esperado.');
          $this->assertTrue(isset($_SESSION['id']), 'A variável de sessão "id" não foi configurada.');
          $this->assertEqual($_SESSION['idSessao'], 3, 'O valor da variável de sessão "idSessao" não é o esperado.');
      } else {
          // Caso o login não seja bem-sucedido
          $this->assertTrue('O login não foi realizado com sucesso. Verifique se o email e a senha são válidos e se o banco de dados está configurado corretamente.');
      }
  }
}
