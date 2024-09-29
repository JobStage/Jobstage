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

function verificarPerguntas(vagaId) {
    $.ajax({
        url: '../app/controller/vagaAluno.php',  // URL do controlador que trata das perguntas
        type: 'POST',
        data: { 
            action: 'verificarPerguntas', // Define a ação no backend
            vagaId: vagaId 
        },
        success: function(response) {
            const perguntas = JSON.parse(response);

            if (perguntas.length > 0) {
                // Se houver perguntas, abre o modal para exibir as perguntas
                abrirModalPerguntas(perguntas, vagaId);
            } else {
                // Se não houver perguntas, pode seguir direto para a candidatura
                alert('Nenhuma pergunta disponível. Você será automaticamente inscrito na vaga.');
                cadastrarCandidatura(vagaId, []);
            }
        },
        error: function(error) {
            console.error('Erro ao verificar perguntas: ', error);
        }
    });
}

function abrirModalPerguntas(perguntas, vagaId) {
    let perguntasHtml = '';

    perguntas.forEach((pergunta, index) => {
        perguntasHtml += `
            <div class="form-group">
                <label for="pergunta_${index}">${pergunta.texto}</label>
                <input type="text" class="form-control" id="pergunta_${index}" name="resposta_${index}">
            </div>
        `;
    });

    $('#modalPerguntasBody').html(perguntasHtml); // Insere perguntas no modal
    $('#modalPerguntas').modal('show'); // Exibe o modal
    
    // Evento de submissão
    $('#btnResponder').on('click', function() {
        const respostas = [];
        perguntas.forEach((_, index) => {
            respostas.push($('#pergunta_' + index).val());
        });

        // Chama a função para cadastrar as respostas e a candidatura
        cadastrarCandidatura(vagaId, respostas);
    });
}

function cadastrarCandidatura(vagaId, respostas) {
    $.ajax({
        url: '../app/controller/vagaAluno.php',  // URL do controlador que trata da candidatura
        type: 'POST',
        data: { 
            action: 'cadastrarCandidatura',  // Ação no backend
            vagaId: vagaId,
            respostas: respostas
        },
        success: function(response) {
            alert('Candidatura realizada com sucesso!');
            $('#modalPerguntas').modal('hide');
        },
        error: function(error) {
            console.error('Erro ao cadastrar candidatura: ', error);
        }
    });
}