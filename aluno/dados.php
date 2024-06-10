<?php
session_start();
require_once '../app/controller/CidadeEstado.php';
$estado = new CidadeEstado();

ob_start();  
?>

<div class="card">
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="dados.php">Dados</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="formacao.php">Formação</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="cursos.php">Cursos</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="experiencia.php">Experiência</a>
    </nav>
</div>
<div class="card">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-lg-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" required>
            </div>
            <div class="col-lg-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" readonly disabled>
            </div>
            <div class="col-lg-4">
                <label for="nasc" class="form-label">Data nasc.</label>
                <input type="date" class="form-control" id="nasc" required>
            </div>
            <div class="col-lg-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="input" class="form-control" id="telefone" required>
            </div>
            <div class="col-lg-4">
                <label for="optionsListCivil" class="form-label">Estado civil</label>
                <select class="form-select" id="optionsListCivil" required>
                    <option value=''> </option>
                    <option value='Solteiro(a)'>Solteiro(a)</option>
                    <option value='Casado(a)'>Casado(a)</option>
                    <option value='Divorciado(a)'>Divorciado(a)</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" required>
                    <option value=''> </option>
                    <?php
                        $estado->listaEstado();
                    ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="optionsListCidade" required>
                    <option value=''> </option>
                    
                </select>
            </div>
            <div class="col-lg-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" required>
            </div>
            <div class="col-lg-6">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" required>
            </div>
            <div class="col-lg-2">
                <label for="numero" class="form-label">Numero</label>
                <input type="number" class="form-control" id="numero" required>
            </div>
            <div class="col-lg-12">
                <label for="linkedin" class="form-label">Linkedin</label>
                <input type="link" class="form-control" id="linkedin">
            </div>
            <div class="col-lg-12">
                <label for="sobre" class="form-label">Sobre</label>
                <textarea type="text" class="form-control" id="sobre"></textarea>
            </div>
            <div class="col-md-12">
            <button type='submit' onclick='salvar()' class='btn btn-primary botao-edit'>
                Salvar
            </button>
            </div>
        </form>
    </div>
</div>
<script src="../app/public/js/dadosAluno.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>
