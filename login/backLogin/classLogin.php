<?php
class Login
{
    private string $email;
    private string $senha;

    public function __construct(string $email, string $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }

    public function loginAluno(string $emailAluno, string $senhaAluno): bool
    {
        return $this->email === $emailAluno && $this->senha === $senhaAluno;
    }

    public function loginEmpresa(string $emailEmpresa, string $senhaEmpresa): bool
    {
        return $this->email === $emailEmpresa && $this->senha === $senhaEmpresa;
    }

    public function loginAgencia(string $emailAgencia, string $senhaAgencia): bool
    {
        return $this->email === $emailAgencia && $this->senha === $senhaAgencia;
    }
}