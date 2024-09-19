<?php
require_once __DIR__."/../model/classCadastro.php";
require_once __DIR__."/../model/classLogin.php";
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 
class LoginController{
    private $cadastro;
    private $login;
    
    public function __construct() {
        $this->cadastro = new Cadastro();
        $this->login = new Login();
    }

    public function cadastroAluno($email, $senha){
        if(!$this->cadastro->getEmailAluno($email)){
            $this->cadastro->inserirAluno($email, $senha);
            $retorno = array('title' => 'Sucesso', 'msg' => 'E-mail cadastrado com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        
        $retorno = array('title' => 'Erro', 'msg' => 'E-mail já existe', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;
    }

    public function cadastroEmpresa($email, $senha){
        if(!$this->cadastro->getEmailEmpresa($email)){
        
            $this->cadastro->inserirEmpresa($email, $senha);
            $retorno = array('title' => 'Sucesso', 'msg' => 'E-mail cadastrado com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
             
        }
        $retorno = array('title' => 'Erro', 'msg' => 'E-mail já existe', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;
    }

    public function loginAluno($email, $senha){
        $resultLogin = $this->login->loginAluno($email, $senha);
        if($resultLogin){
            $_SESSION['id'] = $resultLogin;
            $_SESSION['idSessao'] = 1;

            $retorno = array('redirecionar'=>'index.php', 'sucesso'=> true);
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('title' => 'Erro', 'msg' => 'E-mail ou senha incorreta', 'icon' => 'error', 'sucesso'=> false);
        echo json_encode($retorno);
        return $retorno;
    }

    public function loginEmpresa($email, $senha){
        $resultLogin = $this->login->loginEmpresa($email, $senha);
        if($resultLogin){
          $_SESSION['id'] = $resultLogin;
          $_SESSION['idSessao'] = 2;

          $retorno = array('redirecionar'=>'index.php', 'sucesso'=> true);
          echo json_encode($retorno);
          return $retorno;
        
        }
        $retorno = array('title' => 'Erro', 'msg' => 'E-mail ou senha incorreta', 'icon' => 'error', 'sucesso'=> false);
       echo json_encode($retorno);
        return $retorno;
    }
}


