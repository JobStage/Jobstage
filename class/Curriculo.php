<?php
class Curriculo
{
    private int $idAluno;
    private Aluno $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    public function gerarCurriculo()
    {
        if ($this->aluno->getId()) {
            echo "Currículo gerado com sucesso";
        } else {
            echo 'currículo não gerado';
        }
    }

    public function baixarCurriculo(int $idAluno)
    {

    }
}