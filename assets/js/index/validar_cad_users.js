console.log('Validar cad_users carregada');

function validar_cad_users(form) {
    const cadAccessUsers = form;

    if (cadAccessUsers) {
        cadAccessUsers.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (cadAccessUsers.checkValidity() === false) {
                e.stopPropagation();
                cadAccessUsers.classList.add('was-validated');
                return;
            }

            const dadosFormulario = new FormData(form);

            try {
                console.log('Enviando dados para a API...');
                const response = await fetch('http://localhost/Fila_Facil/API/cad_accessUsers.php', {
                    method: "POST",
                    body: dadosFormulario
                });
                const resposta = await response.json();
                console.log('Resposta da API:', resposta);

                if (resposta.status) {
                    console.log('Resposta da API:', resposta);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: resposta.msg
                    });

                    closeModalCad();

                } else {
                    Swal.fire({
                        text: resposta.msg,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                }
            } catch (error) {
                console.error('Erro ao fazer cadastro:', error);
                Swal.fire({
                    text: 'Erro ao tentar cadastrar. Tente novamente.',
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                });
            }
        });

        cadAccessUsers.addEventListener('input', function (event) {
            if (event.target.checkValidity()) {
                event.target.classList.remove('is-invalid');
                event.target.classList.add('is-valid');
            } else {
                event.target.classList.remove('is-valid');
                event.target.classList.add('is-invalid');
            }
        }, false);
    }
}

function closeModalCad() {
    const modal = document.getElementById('modalCadastro');
    if (modal) {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
    const inputs = document.querySelectorAll('#cadAccessUsers input');
    inputs.forEach(input => {
        input.value = '';
        input.classList.remove('is-valid', 'is-invalid');
    });
    const cadAccessUsers = document.getElementById('cadAccessUsers');
    if (cadAccessUsers) {
        cadAccessUsers.classList.remove('was-validated');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const cadAccessUsers = document.getElementById('cadAccessUsers');
    if (cadAccessUsers) {
        validar_cad_users(cadAccessUsers);
    }
});
