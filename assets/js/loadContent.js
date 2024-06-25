console.log('loadContent carregada');
function loadContent(url) {
    var container = document.getElementById("dynamic-content");
    console.log(container);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Limpa o conteúdo anterior da div
            container.innerHTML = '';

            // Insere o novo conteúdo
            container.innerHTML = this.responseText;

            // Chama funções de inicialização após o conteúdo ser carregado
            initDynamicContent();


        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
    return false;
}