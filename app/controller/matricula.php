<?php
require_once __DIR__ . '/../model/matriculaModel.php';

 /*
------------------------------------------------------------------------------------------------------
                                                                                                     |
  ALTERA APENAS OS ARQUIVOS CADASTRADOS NO SISTEMA NO DIRETÓRIO ../MATRICULA E NÃO NO BANCO DE DADOS |
                                                                                                     |
------------------------------------------------------------------------------------------------------
*/
class matricula {
    private $matricula;

    public function __construct() {
        $this->matricula = new matriculaModel();
      
     }
    public function inserirMatricula($arquivo): string | false{
        // verifica se o arquivo enviado é diferente de PDF
        if($arquivo['type'] != 'application/pdf'){
            $retorno = array('tittle' => 'erro', 'msg' => 'Arquivo não suportado', 'icon' => 'error');
            echo json_encode($retorno);
            return $retorno;
        }


        $nomeArquivoRenomeado = md5(time()) . '.pdf';
        $caminho_upload = "../matricula/";
        

        if(move_uploaded_file($arquivo['tmp_name'], $caminho_upload . $nomeArquivoRenomeado)){
            return $nomeArquivoRenomeado;
        }else{
            return false;
        }
    }


    public function atualizarMatricula($nomeMatricula, $arquivo): string | false{
        if($arquivo['type'] != 'application/pdf'){
            
            $retorno = array('tittle' => 'erro', 'msg' => 'Arquivo não suportado', 'icon' => 'error');
            echo json_encode($retorno);
            return $retorno;
        }


        if($nomeMatricula){
            // deleta arquivo cadastrado no sistema
            $caminho_detele = '../matricula/' . $nomeMatricula;

            unlink($caminho_detele);
            $nomeArquivoRenomeado = md5(time()) . '.pdf';
            $caminho_upload = "../matricula/" . $nomeArquivoRenomeado;

            if(move_uploaded_file($arquivo['tmp_name'], $caminho_upload)){
                return $nomeArquivoRenomeado;
            }else{
                return false;
            }
        }
    }

    
    public function excluirMatricula($nomeMatricula): bool{
        if($nomeMatricula){
            $caminho = '../matricula/' . $nomeMatricula;
            unlink($caminho);
            return true;
        }
        
        return false;
    }

    public function listarMatriculas(){
        $html = '';
        // foreach($this->matricula->getAllMatriculas() as $value){
        //     $html .= '
        //     <div style="display:flex; flex-direction:row;">
        //         <embed src="../app/matricula/'.$value['matricula'].'" width="50%" height="600px" />
        //         <div>
        //             <p>'.$value['curso'].'</p>
        //             <p>'.$value['instituicao'].'</p>
        //             <p>'.$value['inicio'].'</p>
        //             <p>'.$value['fim'].'</p>
        //         </div>
        //     </div>';
        // }
        foreach($this->matricula->getAllMatriculas() as $index => $value){
            $html .= '
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading'.$index.'">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$index.'" aria-expanded="true" aria-controls="collapse'.$index.'">
                            Matrícula: '.$value['nome'].'
                        </button>
                    </h2>
                    <div id="collapse'.$index.'" class="accordion-collapse collapse" aria-labelledby="heading'.$index.'" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="display:flex; flex-direction:row;">
                            <embed src="../app/matricula/'.$value['matricula'].'" width="50%" height="600px" />
                            <div>
                                <p><strong>Curso:</strong> '.$value['curso'].'</p>
                                <p><strong>Instituição:</strong> '.$value['instituicao'].'</p>
                                <p><strong>Início:</strong> '.$value['inicio'].'</p>
                                <p><strong>Fim:</strong> '.$value['fim'].'</p>
                                <div>
                                    <button class="btn btn-danger" onclick="reprovar('.$value['ID'].', '.$value['id_formacao'].')">Reprovar</button>
                                    <button class="btn btn-primary" onclick="aprovar('.$value['ID'].', '.$value['id_formacao'].')">Aprovar</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
            </div>
            ';
        }

        echo $html;
    }

    public function aprovarMatricula($id){
        if($this->matricula->aprovarMatricula($id)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Matrícula aprovada', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'ERRO', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;
        
    }
    public function reprovarMatricula($id){
        if($this->matricula->reprovarMatricula($id)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Matrícula reprovada', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'ERRO', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;
    }
}