
$(document).ready(function() {
    var currentPath = window.location.pathname.split('/').pop();
    var currentFile = currentPath.split('?')[0]; // Remove qualquer parâmetro da URL

    // Remove a classe 'active' de todos os itens
    $('li.inicio').removeClass('active');
   
    let candidaturas = [  
            'candidaturas.php',
            'candidaturas02.php'
        ];
    if (candidaturas.includes(currentFile)) {
        $('a[href="' + 'candidaturas.php' + '"]').closest('li.inicio').addClass('active');
        return;
    } 

    $('a[href="' + currentFile + '"]').closest('li.inicio').addClass('active');
});
   