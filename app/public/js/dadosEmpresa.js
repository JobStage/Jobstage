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
        url: "../app/requests/EmpresaController.php",
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
        url: "../app/requests/EmpresaController.php",
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