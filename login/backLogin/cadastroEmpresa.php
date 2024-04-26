<?php


require_once "../backLogin/classCadastro.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

  $email = $_POST['emailEmpresa'];
  $senha = md5($_POST['senhaEmpresa']);


  $cadastro = new Cadastro();
  if(!$cadastro->getEmailEmpresa($email)){
        
    $cadastro->inserirEmpresa($email, $senha);
    echo "Cadastro da empresa realizado com sucesso!";
    return;
}

echo"E-mail ja existente";
}