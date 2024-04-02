<?php

class Experiencia{
    private int $idExp;
    private string $nomeEmpresa;
    private string $cargo;
    private string $inicio;
    private string $fim; 
    private string $tipoContrato;
    private string $atividades;
    private Aluno $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    public function criarExperiencia(string $nomeEmpresa, string $cargo, DateTime $inicio, string $fim, string $tipoContrato, string $atividades){
        if ($this->aluno->getId()){
            echo 'experiência criada para o aluno ' . $this->aluno->getId() . ' com os valores: ' . $nomeEmpresa . ', ' . $cargo . ', ' . $inicio->format('Y-m-d') . ', ' . $fim . ', ' . $tipoContrato . ', ' . $atividades . '<br>';
        }else{
            echo 'não foi possível criar uma experiência para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }
    

    public function editarExperiencia(int $idExp, string $nomeEmpresa, string $cargo, DateTime $inicio, string $fim, string $tipoContrato, string $atividades){
        if ($this->aluno->getId()){
            echo 'experiência editada para o aluno ' . $this->aluno->getId() . ' com os valores: ' . $nomeEmpresa . ', ' . $cargo . ', ' . $inicio->format('Y-m-d') . ', ' . $fim . ', ' . $tipoContrato . ', ' . $atividades . '<br>';
        }else{
            echo 'não foi possível editar uma experiência para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }
    

    public function excluirExperiencia(int $idExp){
        if ($this->aluno->getId()){
            echo 'experiência deletada para o aluno ' . $this->aluno->getId() . '<br>';
        }else{
            echo 'não foi possível deletar uma experiência para o aluno ' . $this->aluno->getId() . '<br>';
        }
    }

    public function listarexperiencia(){
        echo 'listando todas as experiências para o aluno ' . $this->aluno->getId() . '<br>';
    }

}
