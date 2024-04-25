<?php

require_once "../backLogin/classCad.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nome = $_POST['nomeAluno'];
    $email = $_POST['emailAluno'];
    $senha = md5($_POST['senhaAluno']);

  
    $cadastro = new Cadastro();
    $cadastro->inserirAluno($email, $senha);

    echo "Cadastro de aluno realizado com sucesso!";
}