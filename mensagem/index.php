<?php
use Swoole\jobstage\mensagem;
$servidor = new Server('0.0.0.0', 8080); 

$servidor->on('message', function (Server $servidor, Frame, $mensagem){
  $conexoes = $servidor->connections;
  $origem = $mensagem->fd;

  foreach($conexoes as $conexao){
    if($conexao === $origem) continue;
    $servidor->push($conexao, json_encode(['type' => 'chat', 'text' => $mensagem->data]));
  }
});
$servidor->start();
