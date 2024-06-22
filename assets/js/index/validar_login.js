console.log('Validar logins carregada');

document.addEventListener('DOMContentLoaded', function () {
    const loginAccessForm = document.getElementById('loginAccessForm');

    if (loginAccessForm) {
        loginAccessForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (loginAccessForm.checkValidity() === false) {
                e.stopPropagation();
                loginAccessForm.classList.add('was-validated');
                return;
            }

            //Prepara dados doformulário para encio fia FETCH
            const dadosLogin = new FormData(loginAccessForm);

            try {

                const response = await fetch('http://localhost/Fila_Facil/API/validar_login.php', {
                    method: "POST",
                    body: dadosLogin
                });
                //Converte a resposta devolvida para json
                const resposta = await response.json();

                if (resposta.status) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: resposta.msg
                    }).then(() => {

                        closeModalAccess();
                        //redireciona para a pagina dash
                        window.location.href = "./layout/dash.php";

                    });
                } else {
                    Swal.fire({
                        text: resposta.msg,
                        icon: "error",
                        confirmButtonColor: "#3085d6",

                    }).then(() => {

                    });
                }
            } catch (error) {
                Swal.fire({
                    text: 'Erro ao tentar logar. Tente novamente.',
                    icon: "error",
                    confirmButtonColor: "#3085d6",

                });
                closeModalAccess();
            }
        });

        loginAccessForm.addEventListener('input', function (event) {
            if (event.target.checkValidity()) {
                event.target.classList.remove('is-invalid');
                event.target.classList.add('is-valid');
            } else {
                event.target.classList.remove('is-valid');
                event.target.classList.add('is-invalid');
            }
        }, false);
    }
});

function closeModalAccess() {
    const modal = document.getElementById('modalAcesso');
    if (modal) {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }

    const inputs = document.querySelectorAll('#loginAccessForm input');
    inputs.forEach(input => {
        input.value = '';
        input.classList.remove('is-valid', 'is-invalid');
    });

    const loginAccessForm = document.getElementById('loginAccessForm');
    if (loginAccessForm) {
        loginAccessForm.classList.remove('was-validated');
    }
}
