<?php

class Contrato{
    private int $idEmpresa;
    private int $idAluno;
    private int $idInstituicao;
    private int $idVaga;

    private Agencia $agencia;

    public function __construct(Agencia $agencia){
    $this->agencia = $agencia;
  }
    public function listarContrato(){
        echo 'Detalhes do contrato:' . '<br>';
        echo 'ID da empresa: ' . $this->idEmpresa . '<br>';
        echo 'ID do aluno: ' . $this->idAluno . '<br>';
        echo 'ID da instituição: ' . $this->idInstituicao . '<br>';
        echo 'ID da vaga: ' . $this->idVaga . '<br>';
        echo 'Agência responsável: ' . $this->agencia->getNome() . '<br>';
    }
}