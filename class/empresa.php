<?php

class Empresa{
  private int $idEmpresa;
  private string $nome;
  private string $cnpj;
  private string $endereco;
  private int $contato;
  private Vaga $vaga;

  public function __construct(Vaga $vaga)
  {
    $this->vaga = $vaga;
  }

  public function cadastrarVagas(string $nome, string $cnpj, string $endereco, int $contato)
  {
    echo 'Vaga cadastrada com sucesso! ID: ' . $this->vaga->getId() . '<br>';
    echo 'NOME: ' . $nome . '<br>';
    echo 'CNPJ: ' . $cnpj . '<br>';
    echo 'ENDERECO: ' . $endereco . '<br>';
    echo 'CONTATO: ' . $contato . '<br>';
  }

  public function editarVagas(int $idEmpresa, string $nome, string $cnpj, string $endereco, int $contato)
  {
    if ($this->vaga->getId()){
      echo 'vaga editada ' . $this->vaga->getId() . ' com os valores: ' . $nome . ', ' . $cnpj . ', '. $endereco . ', ' . $contato . '<br>';
  }else{
      echo 'não foi possível editar vaga ' . $this->vaga->getId() . '<br>';
  }
  }
  
  public function removerVagas(int $idEmpresa)
  {
    if ($this->vaga->getId()){
      echo 'vaga deletada ' . $this->vaga->getId() . '<br>';
  }else{
      echo 'não foi possível deletar vaga ' . $this->vaga->getId() . '<br>';
  }
  }

  public function listarVagas()
  {
    echo 'listando todas as vagas ' . $this->vaga->getId() . '<br>';
  }

  public function getId(): int
  {
    return $this->idEmpresa;
  }
}