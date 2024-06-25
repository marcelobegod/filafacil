function loadAccess(url) {
    var container = document.getElementById("dynamic-index");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Limpa o conteúdo anterior da div
            container.innerHTML = '';

            // Insere o novo conteúdo
            container.innerHTML = this.responseText;


        }

    };
    xhttp.open("GET", url, true);
    xhttp.send();
    return false;
}
