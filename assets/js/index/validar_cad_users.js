// validar_cad_users.js
console.log('Validar cad_loginUsers carregada');

function validar_cad_loginUsers(form) {

    const cadUsuarioForm = form;

    if (cadUsuarioForm) {

        //Adicionar um listner ao submit
        cadUsuarioForm.addEventListener('submit', async (e) => {
            // Impede o envio padrão do formulário
            e.preventDefault();

            // Validação do lado do cliente usando Bootstrap
            if (cadUsuarioForm.checkValidity() === false) {
                e.stopPropagation();
                cadUsuarioForm.classList.add('was-validated');
                return;
            }

            // Cria um objeto FormData com os dados do formulário
            const dadosFormulario = new FormData(form);

            // Envia os dados para a API usando fetch
            try {
                console.log('Enviando dados para a API...');
                const response = await fetch('http://localhost/Fila_Facil/API/cad_accessUsers.php', {
                    method: "POST",
                    body: dadosFormulario
                });
                console.log('formulario enviado para API');
                const resposta = await response.json();
                console.log('Resposta da API:', response);

                // Verifica se o cadastro foi bem-sucedido
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

                    // Fecha o modal e limpa o formulário (se necessário)
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

        // Adiciona a classe 'is-valid' ou 'is-invalid' aos inputs
        cadUsuarioForm.addEventListener('input', function (event) {
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


// Função para fechar o modal e limpar o formulário
function closeModalCad() {
    //Obtém o id do modal
    const modal = document.getElementById('modalCadastro');
    if (modal) {
        //Obtém a instância do modal e a fecha.
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
    //Redefine os valores dos inputs e remove as classes de validação.
    const inputs = document.querySelectorAll('#cadLoginUsers input');
    inputs.forEach(input => {
        input.value = '';
        input.classList.remove('is-valid', 'is-invalid');
    });
    //Remove a classe was-validated para que as mensagens de validação não sejam exibidas
    //na próxima vez que o formulário for aberto.
    const cadUsuarioForm = document.getElementById('cadUsuarioForm');
    if (cadUsuarioForm) {
        cadUsuarioForm.classList.remove('was-validated');
    }
}
// Chama a função para iniciar a validação **APENAS DENTRO DO DOMContentLoaded**
document.addEventListener('DOMContentLoaded', function () {
    const cadUsuarioForm = document.getElementById('cadLoginUsers');
    if (cadUsuarioForm) {
        validar_cad_loginUsers(cadUsuarioForm);
    }
});


