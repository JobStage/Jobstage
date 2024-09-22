<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 
require_once __DIR__ . '/../model/FuncionarioModel.php';
require_once 'matricula.php';

class funcionarioController{
    private $funcionario;

 

    public function __construct() {
       $this->funcionario = new funcionarioModel();
     
    }

    public function salvar($nome, $email, $idEmpresa){
        if(empty($nome) || empty($email)){
            return;
        }

        if($this->funcionario->salvar($nome, $email, $idEmpresa)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Funcionário criado!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('success' => false, 'tittle' => 'Erro!', 'msg' => 'Erro ao criar um funcionário!', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;
    }

    public function listarFuncionario($idEmpresa){
        $html = '';
        $funcionario = $this->funcionario->listarFuncionarios($idEmpresa);
        if($funcionario){
            foreach($funcionario as $value){
                $html .= '

                <div class="conteudo-principal">
                    <div class="user">
                        <h5>Nome: '.$value['nome'].'</h5>
                    </div>
                    <div class="formacao">
                        <h5>E-mail: '.$value['email'].'</h5>
                    </div>
                </div>';
            }
            return $html;
        }
        $html = '<div class="alert alert-danger" role="alert">
                    Não existe nenhum funcionário cadastrado
                </div>';

        return $html;
    }

    public function listarFuncionarioSupervisor($idEmpresa){
        foreach($this->funcionario->listarFuncionarios($idEmpresa) as $value){
            echo '<option value="' . $value['id'] . '">' . $value['nome'] . '</option>';
        }
    }

}

