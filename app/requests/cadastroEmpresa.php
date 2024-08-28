<?php
require_once "../controller/loginController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
  
    $cadastro = new LoginController();
    $cadastro->cadastroEmpresa($email, $senha);

  }