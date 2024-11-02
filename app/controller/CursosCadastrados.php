<?php
require_once __DIR__ . '/../model/CursosCadastradosModel.php';

class CursosCadastrados{
    private $cursosModel;

    public function __construct() {
        $this->cursosModel = new CursosCadastradosModel();
    }
    
    public function listarCursosFiltrados($nivel, $area){
        $html = "";
        foreach($this->cursosModel->getCursosCadastradosFiltrados($nivel, $area) as $value){
            $html .= '<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="'. $value['ID'] .'" id="'. $value['ID'] .'"/>
                        <label class="form-check-label" for="'. $value['ID'] .'">'. $value['curso'] .'</label>
                    </div>';
        }

        echo json_encode($html);
        return $html;
    }
    
    public function listarArea($nivel){
        $html = "<option value=''></option>";
        foreach($this->cursosModel->getArea($nivel) as $value){
            $html .= '
                <option value='.$value['idSetor'].'>' .$value['setor'] . '</option>
            ';
        }

        echo json_encode($html);
        return $html;
    }

    public function listarTodasArea(){
        $html = "<option value=''></option>";
        foreach($this->cursosModel->getAllArea() as $value){
            $html .= '
                <option value='.$value['ID'].'>' .$value['setor'] . '</option>
            ';
        }

        echo json_encode($html);
        return $html;
    }

    public function listaCursos($id){
        $html = '<option id= "medio"> </option>';
        
        foreach($this->cursosModel->getAllCursos($id) as $value){
            $html.='<option value='. $value['ID'] .'>'. $value['curso'] .'</option>';
        }

        echo json_encode($html);
        return $html;
    }

    public function listaCursosEdit($id){
        $html = '<option id= "medioEdit" > </option>';
        foreach($this->cursosModel->getAllCursos($id) as $value){
            $html.='<option value='. $value['ID'] .'>'. $value['curso'] .'</option>';
        }
        echo json_encode($html);
        return $html;
    }

    public function getNivel(){
        foreach($this->cursosModel->getNivel() as $value){
        echo'<option value='. $value['ID'] .'>'. $value['nivel'] .'</option>';
        }
    }
    
    public function listarCursosNivelTecnico(){
        $html = "";
        foreach($this->cursosModel->getCursoNivelTecnico() as $value){
            $html .= '<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="'. $value['ID'] .'" id="'. $value['ID'] .'"/>
                        <label class="form-check-label" for="'. $value['ID'] .'">'. $value['curso'] .'</label>
                    </div>';
        }

        json_encode($html);
        return $html;
    }

    public function listarCursosNivelSuperior(){
        $html = "";
        foreach($this->cursosModel->getCursoNivelSuperior() as $value){
            $html .= '<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="'. $value['ID'] .'" id="'. $value['ID'] .'"/>
                        <label class="form-check-label" for="'. $value['ID'] .'">'. $value['curso'] .'</label>
                    </div>';
        }

        json_encode($html);
        return $html;
    }
}