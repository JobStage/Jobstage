<?php

class Mensagem{

  private int $idMensagem;
  private string $conteudo;
  private string $dateTime;
  
  public function __construct(int $idMensagem)
  {
    $this->idMensagem = $idMensagem;
    
  }

  public function enviarMensagem(int $idMensagem, string $conteudo, string $dateTime)
  {
    echo 'ID MENSAGEM: '. $idMensagem . '<br>' ;
    echo 'CONTEUDO: '. $conteudo .'<br>' ;
    echo 'DATA: '. $dateTime .'<br>' ;
  }
}