<?php

class Candidatura
{
    private Vaga $vaga;
    private int $idAluno;

    public function __construct(Vaga $vaga)
    {
        $this->vaga = $vaga;
    }

    public function mostrarCandidaturas()
    {
        if ($this->vaga->getId()) {

            echo 'Candidatura criado com sucesso! Id vaga: ' . $this->vaga->getId();
        } else {
            echo 'Candidatura não realizada.';
        }
    }
}
