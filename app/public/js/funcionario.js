$(document).ready(function(){
    $.ajax({
        url: '../app/requests/cursosCadastrados.php',
        type: 'POST',
        dataType: 'json',
        data: {
            tipo: 'listarTodasAreas'
        },
        success: function(response) {
            $("#area").html(response);
        },
        error: function(xhr, status, error) { 
            console.error('AJAX Error: ' + status + error);
        }
    });
})

function save() {
    event.preventDefault();
    let nome = $('#nome').val();
    let email = $('#email').val();
    let area = $('#area').val();

    if(!nome || !email || !area){
        Swal.fire({
            title: "Atenção!",
            text: "Todos os campos devem ser preenchidos",
            icon: "warning"
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: '../app/requests/funcionario.php',
        dataType: "json",
        data: {
            acao: 'salvar',
            nome: nome,
            email: email,
            area: area
        },
        success: function (response) {
            if(response.success){
                Swal.fire({
                    title: response.tittle,
                    text: response.msg,
                    icon: response.icon
                }).then(() => {
                    location.reload();
                });
            }else{
                Swal.fire({
                    title: response.tittle,
                    text: response.msg,
                    icon: response.icon
                });
            }
        }
    });
}