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