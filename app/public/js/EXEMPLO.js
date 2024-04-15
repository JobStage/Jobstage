// ESTRUTURA BASICA
$.ajax({
    url: "url", // caminho até o arquivo php
    type: "POST", // post ou get
    dataType:"json", // tipo de dado que está sendo enviado
    data: {
        // conteudo que será passado para o backend
    },
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// OUTRO EXEMPLO COM AÇÕES APOS A REQUISIÇÃO
$.ajax({
    url: "url", 
    type: "POST", 
    dataType: "json",
    data: {

    },
    // SUCCESS caso o ajax tenha sido bem sucedido sem erro no servidor
    success: function (data) {
        
    },
    // ERROR caso ocorra qualquer tipo de erro na requisição
    error: function (data){

    },
    // COMPLETE é executado independentemente se houver SUCCESS ou ERROR na requisição
    complete: function (data) {  

    }
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// - EXEMPLO SEM SWEETALERT - // 
function exemplo01(id) {  
    $.ajax({ 
        url: "exemplo.php", // faz uma requisicao 
        type: "POST", 
        dataType: "json",
        data: {
            id: id // passa o id como parâmetro (será recuperado como $_POST['id'] no back-end)
        },
        success: function (data) { // se tudo ocorrer bem executa isso
           alert('Yeah');
        },
        error: function (data){ //caso ocorra erro cai aqui e não deleta 
           alert('Bruh');
        },
    });
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////



// - EXEMPLO COM SWEETALERT - // 
function exemplo02(id) {  
    // primeiro coloco um alerta perguntando se o usuario quer mesmo fazer essa ação
    Swal.fire({
        title: "quer mesmo deletar?",
        text: "essa ação não poderá ser revertida",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: 'Cancelar', // botao de cancelar
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Sim" // botao de confirmar
      }).then((result) => {
        if (result.isConfirmed) { // verifica se o usuario confirmou ou cancelou no alerta que apareceu

            $.ajax({ 
                url: "exemplo.php", // faz uma requisicao 
                type: "POST", 
                dataType: "json",
                data: {
                    id: id // passa o id como parâmetro (será recuperado como $_POST['id'] no back-end)
                },
                success: function (data) { // se tudo ocorrer bem executa isso
                    Swal.fire({
                        title: "Sucesso",
                        text: "seu dado foi deletado", // também é possivel colocar data.message para mensagem personaliazda do back-end(message deve ser retornado do backend)
                        icon: "success"
                    });
                },
                error: function (data){ //caso ocorra erro cai aqui e não deleta 
                    Swal.fire({
                        title: "Erro",
                        text: "não foi possível deletar o dado do sistema",
                        icon: "error"
                    });
                },
            });
        }
    });
}