$(document).ready(function(){
    $('#nivel').change(function() {
        sendAjaxRequestArea();
    });

    $('#nivel, #area').change(function() {
        sendAjaxRequest();
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
            url: '../app/controller/cursosCadastrados.php',  // Substitua pelo seu endpoint de servidor
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
            url: '../app/controller/cursosCadastrados.php',  // Substitua pelo seu endpoint de servidor
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

// funcao para ler os checkbox selecionados
function salvar(){
    event.preventDefault();
    let nome = $('#nome').val();
    let rs = $('#rs').val();
    let modelo = $('#modelo').val();
    let nivel = $('#nivel').val();
    let desc = $('#desc').val();
    let req = $('#req').val();
    
    
    
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
        if (!nome || !modelo || !rs || !nivel || !area || !desc || !req || valoresSelecionados.length === 0) {
            Swal.fire({
                title: "Erro!",
                text: "Todos os campos são obrigatórios!",
                icon: "warning"
              });
        }else{
            $.ajax({
                url: '../app/controller/vagaEmpresaController.php',  // Substitua pelo seu endpoint de servidor
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
                    cursos: JSON.stringify(valoresSelecionados),
                    tipo: 'criarVaga'
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
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error + xhr);
                }
            });
        }
    }else{
        if (!nome || !modelo || !rs  || !nivel || !desc || !req) {
            Swal.fire({
                title: "Erro!",
                text: "Todos os campos são obrigatórios!",
                icon: "warning"
              });
        }else{
            $.ajax({
                url: '../app/controller/vagaEmpresaController.php',  // Substitua pelo seu endpoint de servidor
                type: 'POST',
                dataType: 'json',
                data: {
                    nome: nome,
                    rs: rs,  
                    modelo: modelo,
                    nivel: nivel, 
                    desc: desc,
                    req: req,
                    tipo: 'criarVaga'
                },
                success: function(data) {
                    if(data.success){
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
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