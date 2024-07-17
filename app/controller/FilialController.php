<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once __DIR__ . '/../model/FilialModel.php';


class FilialController {
    private $filial;

    public function __construct() {
        $this->filial = new FilialModel();
    }

    public function criarFilial($nome, $niveis){
        $nivelInstituicao =  implode(',', $niveis);

        $result = $this->filial->criarFilial($nome, $nivelInstituicao, $_SESSION['id']);

        echo json_encode($result);
        return $result;
    }

    public function listaFiliais(){
        $html = '';
    
        foreach($this->filial->getAllFiliais($_SESSION['id']) as $value){
            $html .= ' 
                <div class="card">
                    <div class="conteudo-principal">
                        <div class="user">
                            <h3>'.$value['nome'].'</h3>
                        </div>
                        <div class="formacao">
                            <h3>Nível</h3>
                            <p>'.$value['niveis'].'</p>
                        </div>
                        <div class="icons">
                            <img src="../app/public/img/editar-preto.png" width="48px" height="48px" style="cursor:pointer" onclick="editar('.$value['id'].')">
                            <img src="../app/public/img/excluir.png" width="48px" height="48px"  style="cursor:pointer">
                        </div>
                    </div>
                    <input type="hidden" id="idFilial" value="">
                </div>
            ';
        }
        echo $html;
    }

    public function getDadosFilial($id){
        $result = $this->filial->getDadoFilial($id, $_SESSION['id']);
        $arr = array(   
            'id'=>$result['id_filial'],
            'nivel'=>$result['nivel'],
            'nome'=>$result['nome'],
        );
        echo json_encode($arr);
        return $arr;
    }

    public function editarFilial($nome, $id, $niveis){
        $nivelInstituicao = implode(",", $niveis);

        $result = $this->filial->editarFilial($nome, $nivelInstituicao, $_SESSION['id'], $id);

        if($result){
            $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Filial editada com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }

        $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Erro ao editar filial', 'icon' => 'danger');
        echo json_encode($retorno);
        return;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];   
    $filial = new FilialController($_SESSION['id']);
    $valoresSelecionados =  $_POST['niveis'] ?? null;

    switch($acao){
        case 'criarFilial':
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;

            $filial->criarFilial($_POST['nome'], $valoresSelecionados);
        break;
        case 'getDadosFilial':
            $filial->getDadosFilial($_POST['id']);
        break;
        case 'editarFilial':
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;
            $filial->editarFilial($_POST['nome'], $_POST['id'], $valoresSelecionados);
        break;
    }



}

?>