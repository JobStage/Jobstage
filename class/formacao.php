<?php
class Formacao {
    private int $idFormacao;
    private string $curso;
    private string $instituicao;
    private string $nivelTecnico;
    private int $duracao;
    private string $status;
    private string $declaracaoMatricula;
    private Aluno $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    public function criarFormacao(string $curso, string $instituicao, string $nivelTecnico, int $duracao, string $status) {
        if ($this->aluno->getId()){
            echo 'formação inserida para o aluno ' . $this->aluno->getId() . ' com os valores: ' . $curso . ', ' . $instituicao . ', ' . $nivelTecnico . ', ' . $duracao . ', ' . $status . '<br>';
        }else{
            echo 'não foi possível inserir formação para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }
    

    public function editarFormacao(int $idFormacao, string $curso, string $instituicao, string $nivelTecnico, int $duracao, string $status) {
        if ($this->aluno->getId()){
            echo 'formação editada do aluno ' . $this->aluno->getId() . ' com os valores: ' . $curso . ', ' . $instituicao . ', ' . $nivelTecnico . ', ' . $duracao . ', ' . $status . '<br>';
        }else{
            echo 'não foi possível inserir formação para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }    

    public function excluirFormacao(int $idFormacao) {
        if ($this->aluno->getId()){
            echo 'formação excluida do aluno ' . $this->aluno->getId() . '<br>';
        }else{
            echo 'não foi possível inserir formação para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }

    public function listarFormacao() {
       echo 'listando todas as formações do aluno ' . $this->aluno->getId() . '<br>';
    }
}