
$(document).ready(function() {
    // Obtém o caminho da URL atual
    var currentPath = window.location.pathname.split('/').pop();
    var currentFile = currentPath.split('?')[0]; // Remove qualquer parâmetro da URL

    // Remove a classe 'active' de todos os itens
    $('li.inicio').removeClass('active');
   
    let dadosAluno = [  
            'dados.php', 
            'formacao.php', 
            'cursos.php', 
            'experiencia.php'
        ];
    if (dadosAluno.includes(currentFile)) {
        $('a[href="' + 'dados.php' + '"]').closest('li.inicio').addClass('active');
        return;
    } 

    $('a[href="' + currentFile + '"]').closest('li.inicio').addClass('active');
});