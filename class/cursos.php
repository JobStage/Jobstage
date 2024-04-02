<?php

class Cursos {
    private int $idCurso;
    private string $nomeCurso;
    private string $instituicao;
    private int $duracao;
    private string $nivelTecnico;
    private Aluno $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    public function criarCurso(string $nomeCurso, string $instituicao, int $duracao, string $nivelTecnico){
        if ($this->aluno->getId()){
            echo 'curso criado para o aluno ' . $this->aluno->getId() . ' com os valores: ' . $nomeCurso . ', ' . $instituicao . ', ' . $duracao . ', ' . $nivelTecnico. '<br>';
        }else{
            echo 'não foi possível criar curso para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }

    public function editarCurso(int $idCurso, string $nomeCurso, string $instituicao, int $duracao, string $nivelTecnico){
        if ($this->aluno->getId()){
            echo 'curso editado para o aluno ' . $this->aluno->getId() . ' com os valores: ' . $nomeCurso . ', ' . $instituicao . ', ' . $duracao . ', ' . $nivelTecnico.'<br>';
        }else{
            echo 'não foi possível editar curso para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }

    public function excluirCurso(int $idCurso){
        if ($this->aluno->getId()){
            echo 'curso deletado para o aluno ' . $this->aluno->getId() . '<br>';
        }else{
            echo 'não foi possível deletar curso para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }

    public function listarCurso(){
        echo 'listando todos os cursos do aluno ' . $this->aluno->getId() . '<br>';
    }

}
