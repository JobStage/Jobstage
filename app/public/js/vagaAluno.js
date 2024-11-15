// $(document).ready(function() {
//   // Carregar as vagas ao carregar a página
//   $.ajax({
//     url: 'VagasController.php',
//     type: 'POST',
//     data: { action: 'listarVagas', idEmpresa: 1 },
//     success: function(data) {
//       $('#vagasContainer').html(data);
//     },
//     error: function() {
//       alert('Erro ao carregar as vagas.');
//     }
//   });

//   // Abrir modal e carregar os detalhes da vaga
//   $('#vagaModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget);
//     var vagaId = button.data('vaga-id');

//     $.ajax({
//       url: 'VagasController.php',
//       type: 'POST',
//       data: { action: 'getVagaById', id: vagaId },
//       success: function(data) {
//         var vaga = JSON.parse(data);
//         $('#vagaModalLabel').text(vaga.nomeNivel);
//         $('#descricaoVaga').text(vaga.descricao);
//         $('#requisitosVaga').text(vaga.requisitos);
//       },
//       error: function() {
//         alert('Erro ao carregar os dados da vaga.');
//       }
//     });
//   });
// });
$(document).ready(function(){
})
function candidatar(idEmpresa, idVaga) {

  $.ajax({
      type: "POST",
      url: "../app/requests/vagaAluno.php",
      dataType: 'JSON',
      data: {
          tipo: 'candidatar',
          idVaga: idVaga,
          idEmpresa: idEmpresa
      },
      success: function(data) {
        Swal.fire({
            title: data.tittle,
            text: data.msg,
            icon: data.icon
        }).then(() => {
            location.reload();
        });
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
  });
}
function enviarResposta(resposta) {
    $.ajax({
        type: "POST",
        url: "../app/requests/vagaAluno.php",
        dataType: 'JSON',
        data: {
            tipo: 'enviarResposta',
            resposta: resposta
        },
        success: function(data) {
            // Swal.fire({
            //     title: data.tittle,
            //     text: data.msg,
            //     icon: data.icon
            // }).then(() => {
            //     location.reload();
            // });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
  }
// JavaScript para carregar as perguntas de uma vaga na modal via AJAX
function carregarPerguntasVaga(idVaga) {
    $.ajax({
        url: '../app/controller/vagaAluno.php', // Endereço do arquivo PHP que retorna as perguntas
        method: 'GET',
        data: { idVaga: idVaga },
        success: function(response) {
            // Preenche o corpo da modal com as perguntas retornadas
            $('#perguntaModal' + idVaga + ' .modal-body').html(response);
        },
        error: function() {
            alert('Erro ao carregar as perguntas.');
        }
    });
}

// Quando a modal for aberta, carregue as perguntas
$('.btn-info').on('click', function() {
    var idVaga = $(this).data('idvaga');
    carregarPerguntasVaga(idVaga);
});
