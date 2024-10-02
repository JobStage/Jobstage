<?php


// require_once __DIR__."/../model/Cadastro.php";
require_once __DIR__."/../model/classCadastro.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

  $email = $_POST['email'];
  $senha = md5($_POST['senha']);


  $cadastro = new Cadastro();
  if(!$cadastro->getEmailEmpresa($email)){
        
    $cadastro->inserirInstituicao($email, $senha);
    $retorno = array('tittle' => 'Sucesso', 'msg' => 'E-mail cadastrado com sucesso!', 'icon' => 'success');
    echo json_encode($retorno);
    return $retorno;
     
}
$retorno = array('tittle' => 'Erro', 'msg' => 'E-mail já existe', 'icon' => 'error');
echo json_encode($retorno);
return $retorno;
}