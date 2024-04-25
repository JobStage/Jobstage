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

$login = new Login("usuario@example.com", "senha123");

// Tentativa de login como aluno
if ($login->loginAluno("usuario@example.com", "senha123")) {
    echo "Login de aluno bem-sucedido!";
} else {
    echo "Falha no login de aluno.";
}

// Tentativa de login como empresa
if ($login->loginEmpresa("empresa@example.com", "senhaEmpresa")) {
    echo "Login de empresa bem-sucedido!";
} else {
    echo "Falha no login de empresa.";
}

// Tentativa de login como agência
if ($login->loginAgencia("agencia@example.com", "senhaDiferente")) {
    echo "Login de agência bem-sucedido!";
} else {
    echo "Falha no login de agência.";
}
