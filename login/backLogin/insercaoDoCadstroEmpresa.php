<?php

require_once "./app/config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  $nome = $_POST['nomeEmpresa'];
  $email = $_POST['emailEmpresa'];
  $senha = md5($_POST['senhaEmpresa']);


  $cadastro = new Cadastro();
  $cadastro->inserirEmpresa($email, $senha);

  echo "Cadastro de empresa realizado com sucesso!";
}