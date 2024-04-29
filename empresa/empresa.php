<?php
session_start();
require_once '../app/controller/EmpresaController.php';
require_once '../app/controller/CidadeEstado.php';
$estado = new CidadeEstado();
$empresa = new EmpresaController($_SESSION['id']);
ob_start();  
?>

<div class="card"> 
    <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" disabled readonly>
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
                        <select class="form-select" id="estado" required>
                            <option value=''> </option>
                            <?php
                                $estado->listaEstado();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <select class="form-select" id="optionsListCidade" required>
                            <option value=''> </option>
                            
                        </select>
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
                        <button type='submit' onclick='salvarEmpresa()' class='btn btn-primary botao-edit'>
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
<script>
 
function salvarEmpresa() {
    event.preventDefault();
    var nome = $('#nome').val();
    var email = $('#email').val();
    var cnpj = $('#cnpj').val();
    var contato = $('#contato').val();
    var estado = $('#estado option:selected').val();
    var cidade = $('#optionsListCidade option:selected').val();
    var cep = $('#cep').val();
    var rua = $('#rua').val();
    var numero = $('#num').val();

    $.ajax({
        type: "POST",
        url: "../app/controller/EmpresaController.php",
        dataType: 'json',
        data: {
            acao: "editar",
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
                    title: data.title,
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
        error: function(xhr, status, error) {
            console.log('error');
        }
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
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#cnpj').val(data.cnpj);
                $('#contato').val(data.contato);
                
                
                $('#estado [value="' + data.estado + '"]').attr('selected', 'selected');

                 buscaCidade(data.estado); // chama funcao para listar as cidades baseado no estado
                setTimeout(function() { // tempo para sistema puxar a cidade selecionada do banco
                    $('#optionsListCidade [value="' + data.cidade + '"]').attr('selected', 'selected');
                }, 100);
                
                
                
                $('#cep').val(data.cep);
                $('#rua').val(data.rua);
                $('#num').val(data.numero);
            
        },
        error: function(xhr, status, error) {
            console.log('error');
        }
    });
});


// funcao para chamar buscaCidade ao selecionar um estado
$('#estado').change(function(){
    var valorSelecionado = $(this).val();
    buscaCidade(valorSelecionado)
});

// funcao para procurar cidade de acordo com o estado selecionado
function buscaCidade(params) {
    $.ajax({
        type: "post",
        url: "../app/controller/CidadeEstado.php",
        data: {
            id: params
        },
        complete: function(response){
            var cidades = JSON.stringify(response);
            $('#optionsListCidade').html(cidades);
        }
    });
}

</script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>