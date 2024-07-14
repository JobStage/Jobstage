function salvar() {
     let nome = $('#nome').val();

     let niveis = [];
     $('input[type=checkbox]:checked').each(function() {
         niveis.push($(this).val());
     });
     
     if (!nome || niveis.length === 0) {
        alert('Todos os campos são obrigatórios');
        return;
     }

     $.ajax({
        type: "post",
        url: "../app/controller/FilialController.php",
        dataType: 'json',
        data: {
            acao: 'criarFilial',
            nome: nome,
            niveis: JSON.stringify(niveis)
        },
        success: function(data) {
          if(data){
            location.reload();
          }
        },
        error: function(xhr, status, error) {
            console.log("Erro ao receber os dados:", error);
        }
    });

}