$(document).ready(function(){
    $('#nivel').change(function() {
        sendAjaxRequestArea();
    });


    $('#nivel, #area').change(function() {
        sendAjaxRequest();
    });

    $('#nivelEdit').change(function() {
        sendAjaxRequestAreaEdit();
    });


    $('#nivelEdit, #areaEdit').change(function() {
        sendAjaxRequesEdit($('#areaEdit').val());
    });

    $('#rs').on('input', function() {
        var valor = $(this).val();

        // Remove qualquer caractere que não seja número ou vírgula
        valor = valor.replace(/[^0-9,]/g, '');

        // Adiciona a vírgula e os centavos
        if (valor.length > 3) {
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

        // Garante que só há uma vírgula e que ela está no lugar certo
        var partes = valor.split(',');
        if (partes.length > 1) {
            var parteInteira = partes[0].replace(/\./g, ''); // Remove pontos na parte inteira
            var parteDecimal = partes[1].substring(0, 2); // Limita os centavos a dois dígitos
            valor = parteInteira + ',' + parteDecimal;
        }

        $(this).val(valor);
    });

    $('#rsEdit').on('input', function() {
        var valor = $(this).val();

        // Remove qualquer caractere que não seja número ou vírgula
        valor = valor.replace(/[^0-9,]/g, '');

        // Adiciona a vírgula e os centavos
        if (valor.length > 3) {
            valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

        // Garante que só há uma vírgula e que ela está no lugar certo
        var partes = valor.split(',');
        if (partes.length > 1) {
            var parteInteira = partes[0].replace(/\./g, ''); // Remove pontos na parte inteira
            var parteDecimal = partes[1].substring(0, 2); // Limita os centavos a dois dígitos
            valor = parteInteira + ',' + parteDecimal;
        }

        $(this).val(valor);
    });

    // fecha a modal, fecha os collapse, desativa o botão de escolher cursos e limpa a areaEdit
    $('[data-dismiss="modal"]').on('click', function(){
        $('#areaEdit').attr('disabled', 'disabled').val('');
        $('#selecCursosEdit').removeClass('btn-primary').addClass('btn-secondary disabled');
        $('#selecionarCursosCollapseEdit').collapse('hide');
        $('#avisoCursoCollapseEdit').collapse('hide');
        $('#staticBackdrop').modal('hide');
    });

    var contador = 0; // Contador para gerar IDs únicos

    $('#add').on('click', function(){
        contador++; // Incrementa o contador a cada clique

        var newContent = `
        <div class="card" style="margin: 10px 0">
                <div style="display: flex; flex-direction: row; align-items: center; text-align: center; height: 50px">
                    <input type="text" placeholder="Digite sua pergunta" class="pergunta-input" style="margin: 0 40px 0 0; border: none; outline: none; background: transparent;" id="pergunta-${contador}">
                    <img src="../app/public/img/excluir.png" width="35px" height="35px" class="excluir-img">
                </div>
            </div>
        `;
        $(this).before(newContent);
    });
    
    $(document).on('click', '.excluir-img', function(){
        $(this).closest('.card').remove(); // Remove a div .card correspondente
    });
    listarFuncionarios();
});



function sendAjaxRequestArea() {
    var nivel = $('#nivel').val();
    // desativa e apaga dados cadastrados no input da area e do collapse
    $('#area').attr('disabled', 'disabled').val('');
    $('#selecCursos').removeClass('btn-primary').addClass('btn-secondary disabled');
    $('#selecionarCursosCollapse').collapse('hide');
    $('#avisoCursoCollapse').collapse('hide');
    
    if(nivel > 1){
        $('#area').removeAttr('disabled');
        
        $.ajax({
            url: '../app/requests/cursosCadastrados.php',  // Substitua pelo seu endpoint de servidor
            type: 'POST',
            dataType: 'json',
            data: {
                nivel: nivel,
                tipo: 'listarArea'
            },
            success: function(response) {
                $("#area").html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $('#area').attr('disabled', 'disabled').val('');
    }
}

function sendAjaxRequest() {
    var nivel = $('#nivel').val();
    var area = $('#area').val();
    
    if (nivel && area) {
        $('#selecCursos').removeClass('btn-secondary disabled').addClass('btn-primary');
        
        $.ajax({
            url: '../app/requests/cursosCadastrados.php',
            type: 'POST',
            dataType: 'json',
            data: {
                nivel: nivel,
                area: area,
                tipo: 'listarCursos'
            },
            success: function(response) {
                $("#options").html(response);
            },
            error: function(xhr, status, error) { 
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $('#selecCursos').removeClass('btn-primary').addClass('btn-secondary disabled');
        $('#selecionarCursosCollapse').collapse('hide');
        $('#avisoCursoCollapse').collapse('hide');
    }
}

function sendAjaxRequestAreaEdit() {
    var nivel = $('#nivelEdit').val();
    // desativa e apaga dados cadastrados no input da area e do collapse
    $('#areaEdit').attr('disabled', 'disabled').val('');
    $('#selecCursosEdit').removeClass('btn-primary').addClass('btn-secondary disabled');
    $('#selecionarCursosCollapseEdit').collapse('hide');
    $('#avisoCursoCollapseEdit').collapse('hide');
    
    if(nivel > 1){        
        $.ajax({
            url: '../app/requests/cursosCadastrados.php',
            type: 'POST',
            dataType: 'json',
            data: {
                nivel: nivel,
                tipo: 'listarArea'
            },
            success: function(response) {
                $("#areaEdit").html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $('#areaEdit').attr('disabled', 'disabled').val('');
    }
}

function sendAjaxRequesEdit(areaId) {
    var nivel = $('#nivelEdit').val();
    
    if (nivel && areaId) {
        $('#selecCursosEdit').removeClass('btn-secondary disabled').addClass('btn-primary');
        
        $.ajax({
            url: '../app/requests/cursosCadastrados.php',
            type: 'POST',
            dataType: 'json',
            data: {
                nivel: nivel,
                area: areaId,
                tipo: 'listarCursos'
            },
            success: function(response) {
                $("#optionsEdit").html(response);
            },
            error: function(xhr, status, error) {
                
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $('#selecCursosEdit').removeClass('btn-primary').addClass('btn-secondary disabled');
        $('#selecionarCursosCollapseEdit').collapse('hide');
        $('#avisoCursoCollapseEdit').collapse('hide');
    }
}



// funcao para ler os checkbox selecionados
function salvar(){
    event.preventDefault();
    var inputs = $('.pergunta-input');
    var valores = [];

    // Verifica se existem inputs
    let perguntasSeparadosPorVirgula = ''
    if (inputs.length === 0) {
        // Se não houver inputs, continua a execução do jQuery
        console.log("Nenhum input encontrado, continuando...");
    }else{
        // Lê cada input e separa os valores por vírgula
        inputs.each(function(){
            var valor = $(this).val().trim(); // Trim para remover espaços em branco

            if (valor === "") {
                // Se algum input estiver vazio, retorna e para a execução
                console.log("Um dos inputs está vazio.");
                Swal.fire({
                    title: 'Atenção!',
                    text: 'As perguntas não podem estar vazias!',
                    icon: 'warning'
                });
                return false; // Para o loop each
            }

            valores.push(valor);
        });

        // Verifica se algum input estava vazio
        if (valores.length !== inputs.length) {
            return;
        }

        // Se todos os inputs estiverem preenchidos, continua
        perguntasSeparadosPorVirgula = valores.join(",");
        console.log("Valores: " + perguntasSeparadosPorVirgula);
    }

   

    let nome = $('#nome').val();
    let rs = $('#rs').val();
    let modelo = $('#modelo').val();
    let nivel = $('#nivel').val();
    let desc = $('#desc').val();
    let req = $('#req').val();
    let supervisor = $('#supervisor').val();

    if(!supervisor){
        Swal.fire({
            title: "Erro!",
            text: "Supervisor obrigatório, crie um novo supervisor na aba de funcionários!",
            icon: "warning"
          });
        return;
    }

    if(!$('#area').is(':disabled')){
        var area = $('#area').val();   
    }

    
    if(!$('#selecCursos').hasClass('disabled')){
        var valoresSelecionados = [];
        // Seleciona todos os checkboxes dentro do elemento com id "options" que estão marcados
        $('#options input[type="checkbox"]:checked').each(function() {
            // Obtém o valor do checkbox atual e adiciona ao array
            valoresSelecionados.push($(this).val());
        });
    }

    // se a area não estiver desativada os campos area e de escolher cursos são obrigatórios
    if(!$('#area').is(':disabled')){
        if (!nome || !modelo || !supervisor || !rs || !nivel || !area || !desc || !req || valoresSelecionados.length === 0) {
            Swal.fire({
                title: "Erro!",
                text: "Todos os campos são obrigatórios!",
                icon: "warning"
              });
        }else{
            $.ajax({
                url: '../app/requests/vagaEmpresaController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    nome: nome,
                    rs: rs,  
                    modelo: modelo,
                    nivel: nivel, 
                    desc: desc,
                    req: req,
                    area: area,
                    supervisor: supervisor,
                    cursos: JSON.stringify(valoresSelecionados),
                    perguntas: JSON.stringify(perguntasSeparadosPorVirgula),
                    tipo: 'criarVaga'
                },
                success: function(data) {
                    if(data.success){
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
                        }).then(() => {
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error + xhr);
                }
            });
        }
    }else{
        if (!nome || !modelo || !rs  || !supervisor|| !nivel || !desc || !req) {
            Swal.fire({
                title: "Erro!",
                text: "Todos os campos são obrigatórios!",
                icon: "warning"
              });
        }else{
            let curso = $('#options').val()
            curso = 218;
           
            $.ajax({
                url: '../app/requests/vagaEmpresaController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    nome: nome,
                    rs: rs,  
                    modelo: modelo,
                    nivel: nivel, 
                    desc: desc,
                    req: req,
                    cursoMedio: curso,
                    supervisor: supervisor,
                    perguntas: JSON.stringify(perguntasSeparadosPorVirgula),
                    tipo: 'criarVaga'
                },
                success: function(data) {
                    if(data.success){
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
                        }).then(() => {
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        }
    }

}

function excluirVaga(id) { 
    Swal.fire({
        title: "Quer mesmo excluir essa vaga? ",
        text: "Você não poderá reverter esta ação!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: 'Não',
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Sim"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../app/requests/vagaEmpresaController.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    tipo: 'excluir',
                    idVaga: id
                },
                success: function(data) {
                    if(data.success) {
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
                        });
                    };
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
}

// funcao que busca os dados da modal
function getEditarVaga(id){
        $('#staticBackdrop').modal('show');
        // AJAX -----------------------------------------
        $.ajax({
            type: "post",
            url: "../app/requests/vagaEmpresaController.php",
            dataType: 'json',
            data: {
                tipo: 'getEditVaga',
                id: id
            },
            success: function(data) {
                $('#idVaga').val(data.idVaga)
                $('#nomeEdit').val(data.nome);
                $('#rsEdit').val(data.salario);
                $('#modeloEdit').val(data.modelo);
                $('#nivelEdit').val(data.nivel);
                $('#editSupervisor').val(data.nomeFunc);
                console.log(data.nivel);
                if(data.nivel > 1){
                    sendAjaxRequestAreaEdit()

                    setTimeout(function() { // tempo para sistema puxar a area selecionada do banco
                        $('#areaEdit [value="' + data.setor + '"]').attr('selected', 'selected');
                    }, 100);

                    sendAjaxRequesEdit(data.setor)
                    $('#selecCursosEdit').removeClass('btn-secondary disabled').addClass('btn-primary');
                    setTimeout(function() {
                       // Divide a string data.cursos em um array de valores separados por vírgula
                        var valores = data.cursos.split(',');

                        // Itera sobre cada valor
                        $.each(valores, function(index, valor) {
                            // Seleciona o checkbox com o valor correspondente e marca como selecionado
                            $('#optionsEdit input[type="checkbox"][value="' + valor + '"]').prop('checked', true);
                        });
                    }, 100);
                };

                $('#descEdit').val(data.descricao);
                $('#reqEdit').val(data.requisitos);
                $(".perguntasEdit").empty();
                if(data.pergunta){
                    var perguntasArray = data.pergunta.split(",");
    
                    perguntasArray.forEach(function(pergunta) {
                        var cardElement = $(
                            `<div class="card" style="margin: 10px 0">
                                <div style="display: flex; flex-direction: row; align-items: center; text-align: center; height: 50px">
                                    <p>${pergunta}</p> <!-- Insere a pergunta no cartão -->
                                </div>
                            </div>`
                        );
                        
                        $(".perguntasEdit").append(cardElement);
                    });
                }else{
                    var cardElement = $(
                        `<div class="alert alert-primary" role="alert">
                           Não existem perguntas!
                        </div>`
                    );
                    
                    $(".perguntasEdit").append(cardElement);
                }
            },
            error: function(xhr, status, error) {
                console.log("Erro ao receber os dados:", error);
            }
        });
}

function salvarEdicao(){
    let nome = $('#nomeEdit').val();
    let rs = $('#rsEdit').val();
    let modelo = $('#modeloEdit').val();
    let desc = $('#descEdit').val();
    let req = $('#reqEdit').val();
    let idVaga =$('#idVaga').val();

    if($('#nivelEdit').val() > 1){
        var valoresSelecionados = [];
        // Seleciona todos os checkboxes dentro do elemento com id "options" que estão marcados
        $('#optionsEdit input[type="checkbox"]:checked').each(function() {
            // Obtém o valor do checkbox atual e adiciona ao array
            valoresSelecionados.push($(this).val());
        });

        if( !nome || !rs || !modelo || !desc || !req ||  valoresSelecionados.length === 0){
            Swal.fire({
                title: "Erro!",
                text: "Todos os campos são obrigatórios!",
                icon: "warning"
            });
            return;
        }
        
        $.ajax({
            url: '../app/requests/vagaEmpresaController.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: idVaga,
                nome: nome,
                rs: rs,  
                modelo: modelo, 
                desc: desc,
                req: req,
                cursos: JSON.stringify(valoresSelecionados),
                tipo: 'atualizarVaga'
            },
            success: function(data) {
                if(data.success){
                    Swal.fire({
                        title: data.tittle,
                        text: data.msg,
                        icon: data.icon
                    }).then(() => {
                        window.location.reload();
                    });
                }else{
                    Swal.fire({
                        title: data.tittle,
                        text: data.msg,
                        icon: data.icon
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $.ajax({
            url: '../app/requests/vagaEmpresaController.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: idVaga,
                nome: nome,
                rs: rs,  
                modelo: modelo, 
                desc: desc,
                req: req,
                tipo: 'atualizarVaga'
            },
            success: function(data) {
                if(data.success){
                    Swal.fire({
                        title: data.tittle,
                        text: data.msg,
                        icon: data.icon
                    }).then(() => {
                        window.location.reload();
                    });
                }else{
                    Swal.fire({
                        title: data.tittle,
                        text: data.msg,
                        icon: data.icon
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }

}

function gerarContrato(idAluno, idVaga){
    $.ajax({
        url: '../app/requests/vagaEmpresaController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            idAluno: idAluno,
            idVaga: idVaga,
            tipo: 'gerarContratoEmpresa'
        },
        success: function(data) {
            if(data.success){
                Swal.fire({
                    text: data.msg,
                    icon: data.icon
                }).then(() => {
                    window.location.reload();
                });
            }else{
                Swal.fire({
                    text: data.msg,
                    icon: data.icon
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
        }
    });
}

function listarFuncionarios(){
    $.ajax({
        type: "POST",
        url: '../app/requests/funcionario.php',
        dataType: "html",
        data: {
          acao: 'listarFuncionariosSupervisor'  
        },
        success: function (response) {
            $('#supervisor').html(response);
        }
    });
}