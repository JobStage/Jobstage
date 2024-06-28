<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once __DIR__ . '/../model/curriculoModel.php';

class CurriculoController{
    private $curriculoModel;

    public function __construct() {
        $this->curriculoModel = new CurriculoModel();
    
    }

    public function listarCurriculo() {
        $html = '';
        $dadosAluno = $this->curriculoModel->getDadosAluno($_SESSION['id']);
        $experienciaAluno = $this->curriculoModel->getAllExperiencia($_SESSION['id']);
        $formacaoAluno = $this->curriculoModel->getAllFormacao($_SESSION['id']);
        $cursoAluno = $this->curriculoModel->getAllCursos($_SESSION['id']);
        foreach($dadosAluno as $value) {
            $html .= '<div class="curriculo">
        <div class="cabecalho">
            <p class="nome">'.$value['nome'].'</p>
            <div class="info-cabecalho">
                <p>'.$value['idade']. ' anos</p>
                <p>'.$value['estadoCivil'].'</p>
                <p>'.$value['cidade']. ' - ' .$value['estado'].'</p>
            </div>
        </div>
        <hr>
        <div class="contato">
            <p class="contato-titulo">
                Contato
            </p>
            <p><b>E-mail:</b> '.$value['email'].'</p>
            <p><b>Linkedin:</b> '.$value['linkedin'].'</p>
            <p><b>Telefone:</b> '.$value['telefone'].'</p>
        </div>
        <hr>
        <div class="sobre">
            <p class="sobre-titulo"> Sobre </p>
            <p>'.$value['descricao'].'</p>
        </div>
        <hr>';
        }
        foreach($experienciaAluno as $value) {
            $html .= '<div class="experiencia">
            <p class="experiencia-titulo"> Experiência profissional: </p>
            <p><b>'.$value['nome']. ' - ' .$value['cargo'].'</b></p>
            <p><b>Período:</b> '.$value['inicio']. ' - ' .$value['fim'].'</p>
            <p><b>Atividades Exercidas:</b></p>
            <p>'.$value['atividades'].'</p>
        </div>
        <hr>';
        }
        foreach($formacaoAluno as $value) {
            $html .= '<div class="formacao">
            <p class="formacao-titulo"> Formação acadêmica </p>
            <p>'.$value['curso']. ' - ' .$value['instituicao']. ' <b>'.$value['statuss'].'</b></p>
        </div>
        <hr>';
        }
        foreach($cursoAluno as $value) {
            $html .= '<div class="cursos">
                        <p class="cursos-titulo"> Cursos Extras </p>
                        <p>'.$value['nome_curso']. ' ('.$value['status']. ') <b>'.$value['instituicao'].'</b></p>
                    </div>
                </div>
            </div>';
        }
        echo $html;
        
    }
}