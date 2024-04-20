<?php

require_once __DIR__ . '/../model/Cursos.php';

class CursosController {
    private $cursosModel;

    public function __construct() {
        $this->cursosModel = new CursosModel();
    }

    public function criarCurso(string $curso, string $instituicao, string $nivelTecnico, int $duracao, string $status) {
       
    }

    public function editarCurso(int $idCurso, string $curso, string $instituicao, string $nivelTecnico, int $duracao, string $status) {
       
    } 
    
    public function excluirCurso(int $idCurso) {
      
    }

    public function listarCursos() {
        $html = '';
        $tabelaCursos = $this->cursosModel->getAllcurso();
       
        if($tabelaCursos){
            $html .= '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Instituição</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">';
                    foreach($tabelaCursos as $value){
                        $html .= '
                        <tr>
                            <td>' . $value['id_curso'] . '</td>
                            <td>' . $value['curso'] . '</td>
                            <td>' . $value['instituicao'] . '</td>
                            <td>' . $value['nivel'] . '</td>
                            <td>' . $value['status'] . '</td>
                            <td>
                                <button class="btn btn-primary" id="edit-'.$value['id_curso'].'" value='.$value['id_curso'].'>
                                    Editar
                                </button>
                                <button class="btn btn-danger" value='.$value['id_curso'].' onclick="excluirCurso('.$value['id_curso'].')">
                                    Excluir
                                </button>
                            </td>
                        </tr>';
                    }
                     $html .='
                </tbody>
            </table>';
        };
        return $html ? $html : '<div class="alert alert-danger" role="alert">Não foram encontrados cursos cadastrados!</div>';
    }

    public function getAllCurso($id){
        return $this->cursosModel->getAllcurso($id);
    }
}