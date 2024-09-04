<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

require_once __DIR__ . '/../model/FilialModel.php';
require_once 'CursosCadastrados.php';


class FilialController {
    private $filial;
    private $cursos;

    public function __construct() {
        $this->filial = new FilialModel();
        $this->cursos = new CursosCadastrados();
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
                            <a href="verFilial.php?id='.$value['id'].'" style="text-decoration: none; color: inherit;">
                                <h3>'.$value['nome'].'</h3>
                            </a>
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

    public function listarCursosFilial($id){
        $resultado = $this->filial->verNivielFilial($id, $_SESSION['id']);

        // Acesse a string dos níveis
        $niveis = $resultado['nivel'];
        
        // Divida a string em um array de números
        $niveisArray = explode(',', $niveis);

        $cursosCadastradosFilial = '';
        if($niveis === 1){
            $cursosCadastradosFilial .= '<div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="ensino-medio" checked disabled/>
                                            <label class="form-check-label" for="ensino-medio">Ensino Médio</label>
                                        </div>';
        }else{
            if(in_array(1, $niveisArray)){
                $cursosCadastradosFilial .= '<div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="ensino-medio" checked disabled/>
                                                <label class="form-check-label" for="ensino-medio">Ensino Médio</label>
                                            </div>';
            }
            if(in_array(2, $niveisArray)){
               $tecnico = $this->cursos->listarCursosNivelTecnico();
               $cursosCadastradosFilial .= '<div>'.$tecnico.'</div>';
            }
            
            if(in_array(3, $niveisArray)){
               $superior = $this->cursos->listarCursosNivelSuperior();
               $cursosCadastradosFilial .= '<div>'.$superior.'</div>';
            }

        }

        $html = '<div style="display: flex; flex-direction:row; justify-content:space-around">
                    '.$cursosCadastradosFilial.'
                </div>';

        return $html;
       
    }
}