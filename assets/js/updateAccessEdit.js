console.log('Função updateAccessEdit carregada');

// Cria um mixin do SweetAlert2 com a estrutura do círculo e posição
const ToastSucesso = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000, // Tempo em milissegundos para o alerta desaparecer
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
    htmlContainer: `
        <style>
            .swal2-icon-success {
                border-color: #28a745 !important;
            }

            .swal2-icon-success__hide-x {
                background-color: #28a745 !important;
            }

            .posicao {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100px;
                height: 100px;
                margin-top: 10px;
            }

            .posicao span {
                width: 80px;
                height: 80px;
                border: 3px solid #28a745;
                background-color: #fff;
                border-radius: 50%;
                font-size: 3rem;
                font-weight: bold;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #28a745;
            }
        </style>

        <div class="posicao">
            <span id="numero-posicao"></span>
        </div>
    `,
});

function updateAccessEdit(form, urlAPI) {
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log("updateAccessEdit chamada!");

            // Desabilita o botão de submit para evitar envios duplicados
            form.querySelector('button[type="submit"]').disabled = true;

            const dadosFormulario = new FormData(form);
            try {
                console.log('Enviando dados para a API...');
                const response = await fetch(urlAPI, {
                    method: "POST",
                    body: dadosFormulario
                });

                console.log('Resposta completa da API:', response);

                if (response.ok) {
                    const resposta = await response.json();
                    console.log('Resposta da API (JSON):', resposta);

                    if (resposta.status === true) {
                        // Exibe o SweetAlert2 personalizado usando o mixin
                        ToastSucesso.fire({
                            title: resposta.msg, // Use a mensagem da API no título
                            icon: "success",
                        }).then(() => {
                            // Ações após o alerta ser fechado (se necessário)
                            // ...
                        });

                        // Define o número da posição dentro do círculo
                        document.getElementById('numero-posicao').textContent = resposta.posicao || 'N/A';

                        // Limpa o formulário após o cadastro bem-sucedido
                        form.reset();
                    } else {
                        // Se a requisição não foi bem-sucedida, exibe o erro
                        Swal.fire({
                            text: resposta.msg,
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                } else {
                    // Trata erros de requisição (status não OK)
                    console.error('Erro na requisição:', response.status);

                    const errorData = await response.json().catch(() => { });
                    const mensagemErro = errorData ? errorData.message : 'Erro ao cadastrar. Tente novamente.';

                    Swal.fire({
                        text: mensagemErro,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                }
            } catch (error) {
                // Trata erros durante o processo
                console.error('Erro ao processar dados:', error);
                Swal.fire({
                    text: 'Erro ao tentar processar dados. Tente novamente.',
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                });
            } finally {
                // Reativa o botão de submit após o processamento
                form.querySelector('button[type="submit"]').disabled = false;
            }
        });
    } else {
        console.error('Formulário não encontrado!');
    }
}
// Função para fechar o modal e limpar o formulário
function closeModalCad() {
    const modais = document.querySelectorAll('.modal.fade');
    modais.forEach(modal => {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
}

// Chama a função para iniciar a validação **APENAS DENTRO DO DOMContentLoaded**
document.addEventListener('DOMContentLoaded', function () {
    const cadUsuarioForm = document.getElementById('accessFila1Form');
    if (cadUsuarioForm) {
        // Aqui você pode adicionar a validação do formulário se necessário
        console.log("Formulário 'accessFila1Form' encontrado e pronto para uso.");
    }
});

});

function updateAccessEdit(form, urlAPI) {
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log("updateAccessEdit chamada!");

            // Desabilita o botão de submit para evitar envios duplicados
            form.querySelector('button[type="submit"]').disabled = true;

            const dadosFormulario = new FormData(form);
            try {
                console.log('Enviando dados para a API...');
                const response = await fetch(urlAPI, {
                    method: "POST",
                    body: dadosFormulario
                });

                console.log('Resposta completa da API:', response);

                if (response.ok) {
                    const resposta = await response.json();
                    console.log('Resposta da API (JSON):', resposta);

                    if (resposta.status === true) {
                        // Exibe o SweetAlert2 personalizado usando o mixin
                        ToastSucesso.fire({
                            title: resposta.msg, // Use a mensagem da API no título
                            icon: "success",
                        }).then(() => {
                            // Ações após o alerta ser fechado (se necessário)
                            // ...
                        });

                        // Define o número da posição dentro do círculo
                        document.getElementById('numero-posicao').textContent = resposta.posicao || 'N/A';

                        // Limpa o formulário após o cadastro bem-sucedido
                        form.reset();
                    } else {
                        // Se a requisição não foi bem-sucedida, exibe o erro
                        Swal.fire({
                            text: resposta.msg,
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                } else {
                    // Trata erros de requisição (status não OK)
                    console.error('Erro na requisição:', response.status);

                    const errorData = await response.json().catch(() => { });
                    const mensagemErro = errorData ? errorData.message : 'Erro ao cadastrar. Tente novamente.';

                    Swal.fire({
                        text: mensagemErro,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                }
            } catch (error) {
                // Trata erros durante o processo
                console.error('Erro ao processar dados:', error);
                Swal.fire({
                    text: 'Erro ao tentar processar dados. Tente novamente.',
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                });
            } finally {
                // Reativa o botão de submit após o processamento
                form.querySelector('button[type="submit"]').disabled = false;
            }
        });
    } else {
        console.error('Formulário não encontrado!');
    }
}
// Função para fechar o modal e limpar o formulário
function closeModalCad() {
    const modais = document.querySelectorAll('.modal.fade');
    modais.forEach(modal => {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
}

// Chama a função para iniciar a validação **APENAS DENTRO DO DOMContentLoaded**
document.addEventListener('DOMContentLoaded', function () {
    const cadUsuarioForm = document.getElementById('accessFila1Form');
    if (cadUsuarioForm) {
        // Aqui você pode adicionar a validação do formulário se necessário
        console.log("Formulário 'accessFila1Form' encontrado e pronto para uso.");
    }
});
