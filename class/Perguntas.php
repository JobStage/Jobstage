<?php

class Perguntas
{
    private int $idPergunta;
    private Vaga $vaga;

    public function __construct(Vaga $vaga)
    {
        $this->vaga = $vaga;
    }

    public function candidatar()
    {
        if ($this->vaga->getId()) {
            echo 'Pergunta da vaga';
        } else {
            echo 'Perguntas indisponiveis';
        }
    }
}
