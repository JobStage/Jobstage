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
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nivel = $_POST['nivel'];
    $area = $_POST['area'] ?? '';
    $tipo = $_POST['tipo'];
    $curso = new CursosCadastrados();

    switch($tipo){
        case 'listarArea':
            $curso->listarArea($nivel);
        break;
        case 'listarCursos':
            $curso->listarCursosFiltrados($nivel, $area);
        break;
    }
}