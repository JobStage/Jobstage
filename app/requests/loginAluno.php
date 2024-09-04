<?php
session_start();
require_once "../controller/loginController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
  $email = $_POST['email'];
  $senha = md5($_POST['senha']);
  $login = new LoginController();

  $login->loginAluno($email, $senha);

}
