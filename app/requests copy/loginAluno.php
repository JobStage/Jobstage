<?php
require_once __DIR__."/../model/classLogin.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
  $email = $_POST['email'];
  $senha = md5($_POST['senha']);
  $login = new Login();
    
  $resultLogin = $login->loginAluno($email, $senha);
  if($resultLogin){
    
    $_SESSION['id'] = $resultLogin;
    $_SESSION['idSessao'] = 1;
   
  
    $retorno = array('redirecionar'=>'index.php', 'sucesso'=> true);
    echo json_encode($retorno);
    return $retorno;
  
  
  
  }
  $retorno = array('tittle' => 'Erro', 'msg' => 'E-mail ou senha incorreta', 'icon' => 'error', 'sucesso'=> false);
  echo json_encode($retorno);
  return $retorno;
}
  

