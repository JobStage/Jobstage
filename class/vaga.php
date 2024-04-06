<?php
class Vaga{
  private int $idVaga;
  private string $titulo;
  private string $descricao;
  private string $requisito;
  private string $beneficio;
  private string $estado;
  private string $cidade;

  public function __construct(int $idVaga)
  {
    $this->idVaga = $idVaga;
  }

  public function candidatar(string $titulo, string $descricao, string $beneficio, string $requisito, string $estado, string $cidade)
  {
    echo 'Vaga cadastrada com sucesso! ID: ' . $this->idVaga . '<br>';
    echo 'TITULO: ' . $titulo . '<br>';
    echo 'DESCRICAO: ' . $descricao . '<br>';
    echo 'REQUISITO: ' . $requisito . '<br>';
    echo 'BENEFICIO: ' . $beneficio . '<br>';
    echo 'ESTADO: ' . $estado . '<br>';
    echo 'CIDADE: ' . $cidade . '<br>';
  }

  public function getId(): int
  {
    return $this->idVaga;
  }
}