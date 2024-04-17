<?php

class Agencia{
    private int $idAgencia;

    private string $nome;

    public function __construct(int $idAgencia, string $nome){
    $this->idAgencia = $idAgencia;
    $this->nome = $nome;
  }

  public function exibirDetalhes(){
    echo 'ID AGENCIA: '. $this->idAgencia  . '<br>';
    echo 'NOME: '. $this->nome .'<br>';
  }

  public function validarMatricula(int $idEmpresa, int $idAluno, int $idInstituicao, int $idVaga) {

    if ($idEmpresa > 0 && $idAluno > 0 && $idInstituicao > 0 && $idVaga > 0) {
        echo 'Matrícula válida para a agência ' . $this->nome . '<br>';
    } else {
        echo 'Matrícula inválida para a agência ' . $this->nome . '<br>';
    }
}

public function getNome() {
    return $this->nome;
}
}