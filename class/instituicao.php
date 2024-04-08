<?php

class Instituicao{
    private int $idInstituicao;
    private string $nome;
    private string $endereco;
    private int $contato;

    public function __construct(int $idInstituicao){
        $this->idInstituicao = $idInstituicao;
    }

    public function cadastrarInstituicao(string $nome, string $endereco, int $contato){
        echo 'Instituicao cadastrada com sucesso! ID: ' . $this->idInstituicao. '<br>';
        echo 'NOME: ' . $nome . '<br>';
        echo 'ENDEREÇO: ' . $endereco . '<br>';
        echo 'CONTATO: ' . $contato . '<br>';
    }

    public function editarInstituicao(int $idInstituicao){
        echo 'informacoes da Instituicao ' . $idInstituicao .' foram editadas com sucesso!' . '<br>';
    }

    public function excluirInstituicao(){
        echo 'Instituição deletada!' . $this->idInstituicao . '<br>';
    }

    public function getId(): int{
        return $this->idInstituicao;
    }
}