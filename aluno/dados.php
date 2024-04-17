<?php
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
                <input type="email" class="form-control" id="nome">
            </div>
            <div class="col-lg-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="col-lg-4">
                <label for="nasc" class="form-label">Data nasc.</label>
                <input type="date" class="form-control" id="nasc">
            </div>
            <div class="col-lg-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="input" class="form-control" id="telefone">
            </div>
            <div class="col-lg-4">
                <label for="civil" class="form-label">Estado civil</label>
                <select class="form-select" id="optionsList">
                    <option value=''> </option>
                    <option value='Solteiro(a)'>Solteiro(a)</option>
                    <option value='Casado(a)'>Casado(a)</option>
                    <option value='Divorciado(a)'>Divorciado(a)</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado">
                    <option value=''> </option>
                    <?php
                        $estado->listaEstado();
                    ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="optionsList">
                    <option value=''> </option>
                   
                </select>
            </div>

            <div class="col-lg-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep">
            </div>
            <div class="col-lg-6">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua">
            </div>
            <div class="col-lg-2">
                <label for="numero" class="form-label">Numero</label>
                <input type="number" class="form-control" id="numero">
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
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
<script>
$('#estado').change(function(){
    var valorSelecionado = $(this).val();
    $.ajax({
        type: "post",
        url: "../app/controller/CidadeEstado.php",
        data: {
            id: valorSelecionado
        },
        complete: function(response){
            var cidades = JSON.stringify(response);
            $('#optionsList').html(cidades);
        }
    });
});
</script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>
