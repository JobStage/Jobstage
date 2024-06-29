$(document).ready(function() {
    // Obtém o caminho da URL atual
    var currentPath = window.location.pathname.split('/').pop();

    // Remove a classe 'active' de todos os links
    $('.nav-link').removeClass('active');

    // Adiciona a classe 'active' ao link correspondente ao arquivo atual
    $('.nav-link[href="' + currentPath + '"]').addClass('active');
});