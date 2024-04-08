<?php
require_once '../class/Mensagem.php';

$mensagem = new Mensagem(1);
$mensagem->enviarMensagem(1, 'Parabens voce foi selecionado', '2024-01-05');