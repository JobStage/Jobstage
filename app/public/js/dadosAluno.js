//recupera os dados cadastrados no banco de dados
$(document).ready(function(){
    $.ajax({
        url: "../app/controller/AlunoController.php",
        type: 'POST',
        dataType: 'json',
        data:{
            acao: 'getAll',
            id: 1
        },
        success: function(data) {
            $('#email').val(data.email);
            if(data.cadastro){
                $('#nome').val(data.nome);
                $('#nasc').val(data.nasc);
                $('#telefone').val(data.tel);
                $('#optionsListCivil [value="' + data.civil + '"]').attr('selected', 'selected');
                $('#estado [value="' + data.estado + '"]').attr('selected', 'selected');
                buscaCidade(data.estado); // chama funcao para listar as cidades baseado no estado
                setTimeout(function() { // tempo para sistema puxar a cidade selecionada do banco
                    $('#optionsListCidade [value="' + data.cidade + '"]').attr('selected', 'selected');
                }, 100);
                $('#cep').val(data.cep);
                $('#rua').val(data.rua);
                $('#numero').val(data.numero);
                $('#linkedin').val(data.link);
                $('#sobre').val(data.sobre);
            };
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

// salva os dados do usuario
function salvar() {
    event.preventDefault();
    var nome = $('#nome').val();
    var dataNascimento = $('#nasc').val();
    var telefone = $('#telefone').val();
    var estadoCivil = $('#optionsListCivil option:selected').val();
    var estado = $('#estado option:selected').val();
    var cidade = $('#optionsListCidade option:selected').val();
    var cep = $('#cep').val();
    var rua = $('#rua').val();
    var numero = $('#numero').val();
    var linkedin = $('#linkedin').val();
    var sobre = $('#sobre').val();
    $.ajax({
        type: "post",
        url: "../app/controller/AlunoController.php",
        dataType: 'json',
        data: {
            acao: 'editar',
            nome: nome,
            dataNascimento: dataNascimento,
            telefone: telefone,
            estadoCivil: estadoCivil,
            estado: estado,
            cidade: cidade,
            cep: cep,
            rua: rua,
            numero: numero,
            linkedin: linkedin,
            sobre: sobre
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