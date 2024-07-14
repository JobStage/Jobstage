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
                            <img src="../app/public/img/editar-preto.png" width="48px" height="48px" style="cursor:pointer">

                            <img src="../app/public/img/excluir.png" width="48px" height="48px"  style="cursor:pointer">
                        </div>
                    </div>
                    <div class="more-info">
                        <div class="collapse" id="collapseExample">
                            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                        </div>
                    </div>
                </div>
            ';
        }
        echo $html;
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
        case 'editar':
            $result = $empresa->atualizarEmpresa();
        break;
    }



}

?>