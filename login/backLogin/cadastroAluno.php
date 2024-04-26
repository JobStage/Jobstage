<?php

require_once "classCadastro.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['emailAluno'];
    $senha = md5($_POST['senhaAluno']);

  
    $cadastro = new Cadastro();
    if(!$cadastro->getEmailAluno($email)){
        
        $cadastro->inserirAluno($email, $senha);
        echo "Cadastro de aluno realizado com sucesso!";
        return;
    }
    
    echo"E-mail ja existente";

}