// função para puxar os valores do banco de dados na MODAL
$(document).ready(function () {
  $('.btn-primary').on('click', function () {
    var id = $(this).val();
    console.log(id);
    // AJAX -----------------------------------------
    $.ajax({
      type: "post",
      url: "../app/requests/FilialController.php",
      dataType: 'json',
      data: {
        acao: 'getAll',
        id: id
      },
      success: function (data) {
        $('#estado').val(data.nome_curso);
        $('#optionsListCidade').val(data.instituicao);
        $('#CEP').val(data.nivel);
        $('#Rua').val(data.inicio);
        $('#ensino-medio').val(data.ensino - medio);
        $('#tecnico').val(data.tecnico);
        $('#superior').val(data.superior);
      },
      error: function (xhr, status, error) {
        console.log("Erro ao receber os dados:", error);
      }
    });

    // Mostra o modal do Bootstrap
    $('#staticBackdrop').modal('show');
  });

  $('[data-dismiss="modal"]').on('click', function () {
    $('#staticBackdrop').modal('hide');
  });
});

function salvar() {
  let idfilial = $('#idFilial').val()
  if (idfilial) {
    editarFilial();
    return;
  }

  let nome = $('#nome').val();
  let niveis = [];
  $('input[type=checkbox]:checked').each(function () {
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
    success: function (data) {
      if (data) {
        location.reload();
      }
    },
    error: function (xhr, status, error) {
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
    success: function (data) {
      $('#nome').val(data.nome);
      $('#idFilial').val(data.id);
      const values = data.nivel.split(',');

      // Marcar os checkboxes com base nos valores do AJAX
      values.forEach(function (value) {
        $('input[type="checkbox"][value="' + value.trim() + '"]').prop('checked', true);
      });
    },
    error: function (xhr, status, error) {
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

function editarFilial() {
  let idfilial = $('#idFilial').val()
  let nome = $('#nome').val();
  let niveis = [];
  $('input[type=checkbox]:checked').each(function () {
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
    success: function (data) {
      if (data.success) {
        Swal.fire({
          title: data.tittle,
          text: data.msg,
          icon: data.icon
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          title: data.tittle,
          text: data.msg,
          icon: data.icon
        })
      }
    },
    error: function (xhr, status, error) {
      console.log("Erro ao receber os dados:", error);
    }
  });
}

// function salvarDadosFilial($id) {
//   var idfilial = $('#idFilial').val()
//   var estado = $('#estado option:selected').val();
//   var cidade = $('#optionsListCidade option:selected').val();
//   var cep = $('#CEP').val();
//   var rua = $('#Rua').val();

//   var nome = $('#nome').val();
//   var niveis = [];

//   // Verificar quais checkboxes estão marcados
//   if ($('#medio').is(':checked')) {
//     niveis.push(1); // Médio
//   }
//   if ($('#tecnico').is(':checked')) {
//     niveis.push(2); // Técnico
//   }
//   if ($('#superior').is(':checked')) {
//     niveis.push(3); // Superior
//   }

//   // Fazer a requisição AJAX com jQuery
//   $.ajax({
//     url: '../app/requests/FilialController.php',
//     type: 'POST',
//     contentType: 'application/json',
//     // data: JSON.stringify({ nome: nome, niveis: niveis }),
//     data: {
//       acao: 'addFilial',
//       id: idfilial,
//       nome: nome,
//       estado: estado,
//       cidade: cidade,
//       cep: cep,
//       rua: rua,
//       niveis: JSON.stringify(niveis)
//     },
//     success: function (data) {
//       $('#idFilial').val(data.id);
//       $('#nome').val(data.nome);
//       $('#estado option:selected').val(data.estado);
//       $('#optionsListCidade option:selected').val(data.cidade);
//       $('#CEP').val(data.cep);
//       $('#Rua').val(data.rua);
//       const values = data.nivel.split(',');

//       // Marcar os checkboxes com base nos valores do AJAX
//       values.forEach(function (value) {
//         $('input[type="checkbox"][value="' + value.trim() + '"]').prop('checked', true);
//       });
//     },
//     error: function (xhr, status, error) {
//       console.log("Erro ao receber os dados:", error);
//     }
//   });

// }

// function salvarDadosFilial($id) {
//   var idfilial = $('#idFilial').val();
//   var estado = $('#estado option:selected').val();
//   var cidade = $('#optionsListCidade option:selected').val();
//   var cep = $('#CEP').val();
//   var rua = $('#Rua').val();
//   var nome = $('#nome').val();
//   var niveis = [];

//   // Coletar os checkboxes marcados
//   $('input[type="checkbox"]:checked').each(function () {
//     niveis.push($(this).val());
//   });

//   // Fazer a requisição AJAX com jQuery
//   $.ajax({
//     url: '../app/requests/FilialController.php',
//     type: 'POST',
//     // contentType: 'application/json',
//     data: {
//       acao: 'addFilial',
//       id: idfilial,
//       nome: nome,
//       estado: estado,
//       cidade: cidade,
//       cep: cep,
//       rua: rua,
//       niveis: niveis.join(',') // Juntar os níveis com vírgula
//     },
//     success: function (data) {
//       // Log para depuração
//       // console.log('Resposta do servidor:', data);

//       $('#idFilial').val(data.id);
//       $('#nome').val(data.nome);
//       $('#estado option:selected').val(data.estado);
//       $('#optionsListCidade option:selected').val(data.cidade);
//       $('#CEP').val(data.cep);
//       $('#Rua').val(data.rua);

//       // Verificar e processar 'data.nivel'
//       const nivelStr = typeof data.nivel === 'string' ? data.nivel : '';
//       const valores = nivelStr.split(',').map(value => value.trim());

//       // Desmarcar todos os checkboxes antes de marcar os corretos
//       $('input[type="checkbox"]').prop('checked', false);
//       valores.forEach(function (value) {
//         $('input[type="checkbox"][value="' + value + '"]').prop('checked', true);
//       });
//     },
//     error: function (xhr, status, error) {
//       console.log("Erro ao receber os dados:", error);
//     }
//   });
// }

function salvarDadosFilial(id) {
  var estado = $('#estado option:selected').val();
  var cidade = $('#optionsListCidade option:selected').val();
  var cep = $('#CEP').val();
  var rua = $('#Rua').val();
  var medioChecked = [];
  var superiorChecked = [];
  var tecnicoChecked = [];

  if (!estado || !cidade || !cep || !rua) {
    Swal.fire({
      title: 'Atenção',
      text: 'Campos obrigatórios',
      icon: 'warning'
    });
  }

  $('#medio input:checked').each(function () {
    medioChecked.push($(this).val());
  });

  $('#superior input:checked').each(function () {
    superiorChecked.push($(this).val());
  });

  $('#tecnico input:checked').each(function () {
    tecnicoChecked.push($(this).val());
  });

  console.log("medio ->", medioChecked);
  console.log("superior -> ", superiorChecked);
  console.log("tecnico -> ", tecnicoChecked);
  console.log("cidade -> ", cidade);
  console.log("estado -> ", estado);
  console.log("cep -> ", cep);
  console.log("rua -> ", rua);
  $.ajax({
    type: "POST",
    url: "../app/requests/FilialController.php",
    dataType: 'json',
    data: {
      acao: 'addFilial',
      tecnico: tecnicoChecked,
      superior: superiorChecked,
      estado: estado,
      cidade: cidade,
      CEP: cep,
      rua: rua,
      idFilial: id
      // id: idfilial,
    },
    success: function (data) {
      console.log(data.success);
      if (data) {
        Swal.fire({
          title: 'yeah',
          text: 'salvo',
          icon: 'success'
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          title: 'ERRO',
          text: 'error',
          icon: 'error'
        });

        console.log("TESTE função de erro teste");
      }

    },
    error: function (xhr, status, error) {
      // console.error(xhr.responseText);
      console.log("Erro ao receber os dados:", error);
    }
  });
}

// function excluirFilial(id) {
//   Swal.fire({
//     title: "Quer mesmo excluir essa filial? ",
//     text: "Você não poderá reverter esta ação!",
//     icon: "warning",
//     showCancelButton: true,
//     cancelButtonColor: "#d33",
//     cancelButtonText: 'Não',
//     confirmButtonColor: "#3085d6",
//     confirmButtonText: "Sim"
//   }).then((result) => {
//     if (result.isConfirmed) {
//       // CRIAR AJAX -----------------
//       $.ajax({
//         url: "../app/requests/FilialController.php",
//         type: 'POST',
//         dataType: 'json',
//         data: {
//           acao: 'excluir',
//           id: idfilial,
//         },
//         success: function (data) {
//           if (data.success) {
//             Swal.fire({
//               title: data.tittle,
//               text: data.msg,
//               icon: data.icon
//             }).then(() => {
//               $('#staticBackdrop').modal('hide');
//               location.reload();
//             });
//           } else {
//             Swal.fire({
//               title: data.tittle,
//               text: data.msg,
//               icon: data.icon
//             });
//           };
//         },
//         error: function (xhr, status, error) {
//           console.error(xhr.responseText);
//         }
//       });
//     }
//   });
// }

function excluirFilial(id) {
  Swal.fire({
    title: "Quer mesmo excluir essa filial? ",
    text: "Você não poderá reverter esta ação!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#d33",
    cancelButtonText: 'Não',
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Sim"
  }).then((result) => {
    if (result.isConfirmed) {
      // Enviar AJAX para excluir a filial
      $.ajax({
        url: "../app/requests/FilialController.php",
        type: 'POST',
        dataType: 'json',
        data: {
          acao: 'excluir',
          id: id,  // Corrigido aqui: passou-se o parâmetro correto
        },
        success: function (data) {
          if (data.success) {
            Swal.fire({
              title: data.tittle,
              text: data.msg,
              icon: data.icon
            }).then(() => {
              location.reload(); // Recarregar a página após excluir
            });
          } else {
            Swal.fire({
              title: data.tittle,
              text: data.msg,
              icon: data.icon
            });
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }
  });
}


$('#estado').change(function () {
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
    complete: function (response) {
      var cidades = JSON.stringify(response);
      $('#optionsListCidade').html(cidades);
    }
  });
}