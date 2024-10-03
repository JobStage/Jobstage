function save() {
    event.preventDefault();
    let nome = $('#nome').val();
    let email = $('#email').val();

    if(!nome || !email){
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
            email: email
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