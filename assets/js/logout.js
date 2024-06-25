function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Após o logout ser concluído com sucesso, redirecionar para index.php
            window.location.href = "/Fila_Facil/index.php";
        }
    };
    xhttp.open("GET", "/Fila_Facil/API/function/sair.php", true);
    xhttp.send();
}
