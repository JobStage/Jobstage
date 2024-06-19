$(document).ready(function(){
    $('#nivel').change(function() {
        sendAjaxRequestArea();
    });

    $('#nivel, #area').change(function() {
        sendAjaxRequest();
    });
});



function sendAjaxRequestArea() {
    var nivel = $('#nivel').val();
    // desativa e apaga dados cadastrados no input da area e do collapse dos cursos
    $('#area').attr('disabled', 'disabled').val('');
    $('#selecCursos').removeClass('btn-primary').addClass('btn-secondary disabled');
    $('#selecionarCursosCollapse').collapse('hide');
    
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
    }
}