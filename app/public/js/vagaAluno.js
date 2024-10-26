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
function enviarResposta(idVaga, resposta) {
    $.ajax({
        type: "POST",
        url: "../app/requests/vagaAluno.php",
        dataType: 'JSON',
        data: {
            tipo: 'enviarResposta',
            idVaga: idVaga,  // Adiciona o ID da vaga
            resposta: resposta
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
  

// function enviarRespostas() {
//     const rateValue = $("input[name='rate']:checked").val();
//     const perguntaId = $(this).data('id'); // Acha o ID da pergunta

//     $.ajax({
//         url: '../app/controller/vagaAluno.php', // Altere para o seu endpoint
//         type: 'POST',
//         data: {
//             id: perguntaId,
//             rating: rateValue
//         },
//         success: function(response) {
//             // Faça algo com a resposta
//             alert('Avaliação enviada com sucesso!');
//         },
//         error: function(xhr, status, error) {
//             alert('Erro ao enviar avaliação: ' + error);
//         }
//     });
// }


// function verificarPerguntas(idVaga) {
//     $.ajax({
//         url: "../app/controller/vagaAluno.php", // Altere para o caminho correto da sua controller
//         type: 'POST',
//         data: { tipo:'verificarPerguntas' ,idVaga: idVaga },
//         dataType: 'json',
//         success: function(response) {
//             if (response.status === 'success') {
//                 // Perguntas foram encontradas
//                 alert('tem pergunta');
//             } else if (response.status === 'empty') {
//                 // Nenhuma pergunta encontrada
//                 alert('sem perguntas');
//             } else {
//                 // Algum erro ocorreu
//                 console.log(response.message);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Erro na requisição AJAX:', error);
//         }
//     });
// }


// // Função para abrir o modal com as perguntas
// function abrirModalComPerguntas(perguntas) {
//     // Implemente a lógica para abrir o modal e exibir as perguntas
//     $('#modalPerguntas').modal('show');
//     // Exemplo de preenchimento do modal
//     $('#listaPerguntas').empty();
//     perguntas.forEach(function(pergunta) {
//         $('#listaPerguntas').append('<li>' + pergunta.pergunta + '</li>');
//     });
// }

// // Função para se candidatar sem perguntas
// function candidatarSemPerguntas(idVaga) {
//     // Implemente a lógica para realizar a candidatura sem perguntas
//     console.log('Realizando candidatura para a vaga: ' + idVaga);
// }

// // Exemplo de uso: chamada da função ao clicar em um botão
// $('#btnVerificarPerguntas').click(function() {
//     var idVaga = $(this).data('idVaga');
//     verificarPerguntas(idVaga);
// });
/////////////////////////////////////////////////////////////////////
// function enviarRespostas(idVaga, respostas) {
//     if (!respostas || respostas.length === 0) {
//         Swal.fire({
//             title: 'Erro',
//             text: 'Nenhuma resposta foi fornecida!',
//             icon: 'error'
//         });
//         return;
//     }

//     $.ajax({
//         type: "POST",
//         url: "../app/requests/vagaAluno.php",
//         dataType: 'JSON',
//         data: {
//             tipo: 'enviarRespostas', 
//             idVaga: idVaga,
//             respostas: respostas 
//         },
//         success: function(data) {
//             Swal.fire({
//                 title: data.title,
//                 text: data.msg,
//                 icon: data.icon
//             });
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// }

////////// perguntas //////////////
// function abrirModalPerguntas(vagaId) {
//     $.ajax({
//         type: 'POST',  // Corrigido o tipo de request
//         url: '../app/requests/vagaAluno.php',
//         dataType: 'JSON',  // Ajustado para retornar JSON
//         data: {
//             tipo: 'verificarPerguntas',  // Usando o nome correto da ação
//             idVaga: vagaId 
//         },
//         success: function(response) {
//             if (response.status === 'success') {
//                 let perguntasHtml = '';
//                 response.data.forEach((pergunta, index) => {
//                     perguntasHtml += `
//                         <div class="form-group">
//                             <label for="pergunta_${index}">${pergunta.pergunta}</label>
//                             <div class="rate" id="rate_${index}">
//                                 <input type="radio" id="star5_${index}" name="rate_${index}" value="5" />
//                                 <label for="star5_${index}" title="5 stars">5 stars</label>
//                                 <input type="radio" id="star4_${index}" name="rate_${index}" value="4" />
//                                 <label for="star4_${index}" title="4 stars">4 stars</label>
//                                 <input type="radio" id="star3_${index}" name="rate_${index}" value="3" />
//                                 <label for="star3_${index}" title="3 stars">3 stars</label>
//                                 <input type="radio" id="star2_${index}" name="rate_${index}" value="2" />
//                                 <label for="star2_${index}" title="2 stars">2 stars</label>
//                                 <input type="radio" id="star1_${index}" name="rate_${index}" value="1" />
//                                 <label for="star1_${index}" title="1 star">1 star</label>
//                             </div>
//                         </div>
//                     `;
//                 });
//                 $('#modalPerguntasBody').html(perguntasHtml);
//                 $('#modalPerguntas').modal('show'); 
//             } else {
//                 Swal.fire({
//                     title: 'Erro',
//                     text: response.message,
//                     icon: 'error'
//                 });
//             }
//         },
//         error: function() {
//             Swal.fire({
//                 title: 'Erro',
//                 text: 'Erro ao carregar as perguntas.',
//                 icon: 'error'
//             });
//         }
//     });
// }