function salvar() {
  let idfilial = $('#idFilial').val()
  if(idfilial){
    editarFilial();
    return;
  }

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
    url: "../app/requests/FilialController.php",
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

function editar(id) {  
  $('#staticBackdrop').modal('show');
  $('input[type="checkbox"]').prop('checked', false);
  $('#nome').val('');
  $('#idFilial').val('');
  $('#staticBackdropLabel').text('Editar Filial');


  $.ajax({
    type: "post",
    url: "../app/requests/FilialController.php",
    dataType: 'json',
    data: {
        acao: 'getDadosFilial',
        id: id
    },
    success: function(data) {
      $('#nome').val(data.nome);
      $('#idFilial').val(data.id);
      const values = data.nivel.split(',');

      // Marcar os checkboxes com base nos valores do AJAX
      values.forEach(function(value) {
          $('input[type="checkbox"][value="' + value.trim() + '"]').prop('checked', true);
      });
    },
    error: function(xhr, status, error) {
        console.log("Erro ao receber os dados:", error);
    }
  });
}
      
function closeModal() {
  $('input[type="checkbox"]').prop('checked', false);
  $('#nome').val('');
  $('#idFilial').val('');
  $('#staticBackdrop').modal('hide');
}

function editarFilial(){
  let idfilial = $('#idFilial').val()
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
    url: "../app/requests/FilialController.php",
    dataType: 'json',
    data: {
        acao: 'editarFilial',
        id: idfilial,
        nome: nome,
        niveis: JSON.stringify(niveis)
    },
    success: function(data) {
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
        })
      }
    },
    error: function(xhr, status, error) {
        console.log("Erro ao receber os dados:", error);
    }
});
}

function salvarDadosFilial($id){
  var estado = $('#estado option:selected').val();
  var cidade = $('#optionsListCidade option:selected').val();
  var cep = $('#CEP').val();
  var rua = $('#Rua').val();
 
  
}

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