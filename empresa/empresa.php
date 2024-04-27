<?php
require_once '../app/controller/EmpresaController.php';
$empresa = new EmpresaController();
ob_start();  
?>

<div class="card">
    <div class="card-body">
            <div class="card card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="col-md-6">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj">
                    </div>
                    <div class="col-md-6">
                        <label for="contato" class="form-label">Contato</label>
                        <input type="text" class="form-control" id="contato">
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado">
                    </div>
                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade">
                    </div>
                    <div class="col-md-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep">
                    </div>
                    <div class="col-md-6">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua">
                    </div>
                    <div class="col-md-3">
                        <label for="num" class="form-label">Numero</label>
                        <input type="number" class="form-control" id="num">
                    </div>
                    <div class="col-md-12">
                    <button type='submit' onclick='salvar()' class='btn btn-primary botao-edit'>
                Salvar
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
 
function salvarEmpresa() {
    event.preventDefault();
    var id = $('#id').val();
    var nome = $('#nome').val();
    var email = $('#email').val();
    var cnpj = $('#cnpj').val();
    var contato = $('#contato').val();
    var estado = $('#estado').val();
    var cidade = $('#cidade').val();
    var cep = $('#cep').val();
    var rua = $('#rua').val();
    var numero = $('#numero').val();

    var acao = (id === "") ? "inserir" : "atualizar";

    $.ajax({
        type: "POST",
        url: "../app/controller/EmpresaController.php",
        dataType: 'json',
        data: {
            acao: acao,
            id: id,
            nome: nome,
            email: email,
            cnpj: cnpj,
            contato: contato,
            estado: estado,
            cidade: cidade,
            cep: cep,
            rua: rua,
            numero: numero
        },
        success: function(data){
            if(data.success){
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                }).then(() => {
                    location.reload();
                });
            }else{
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                });
            }
        },
    });
}

$(document).ready(function(){
    $.ajax({
        url: "../app/controller/EmpresaController.php",
        type: 'POST',
        dataType: 'json',
        data:{
            acao: 'getAll',
            id: 1
        },
        success: function(data) {
            if(data.cadastro){
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#cnpj').val(data.cnpj);
                $('#contato').val(data.contato);
                $('#estado [value="' + data.estado + '"]').attr('selected', 'selected');
                $('#cidade [value="' + data.cidade + '"]').attr('selected', 'selected');
                $('#cep').val(data.cep);
                $('#rua').val(data.rua);
                $('#numero').val(data.numero);
            }
        },
        error: function(xhr, status, error) {
            console.log('error');
        }
    });
});

</script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>