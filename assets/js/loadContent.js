function loadContent(url) {
    var container = document.getElementById("dynamic-content");
    if (!container) {
        console.error("Elemento dynamic-content não encontrado");
        console.log('Elemento dynamic-content não encontrado');
        return;
    }

    var container = document.getElementById("dynamic-content");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Limpa o conteúdo anterior da div
            container.innerHTML = '';

            // Insere o novo conteúdo
            container.innerHTML = this.responseText;



        }
        init_dynamicContent();
    };
    xhttp.open("GET", url, true);
    xhttp.send();
    return false;
}
