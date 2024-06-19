// Executa o código quando o DOM estiver completamente carregado
document.addEventListener('DOMContentLoaded', function () {
    // Obtém o caminho da URL da página atual
    var path = window.location.pathname;
    console.log(window.location.pathname);
    // Seleciona o botão correspondente à página atual
    var buttons = document.querySelectorAll('.btn-menu');
    buttons.forEach(function (button) {
        // Compara o atributo href do botão com o caminho da página atual
        if (button.getAttribute('href') === path) {
            button.classList.add('active'); // Adiciona a classe 'active' ao botão ativo
        }
    });
});
