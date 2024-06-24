const ToastSucesso = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
    customClass: {
        popup: 'swal2-toast-custom',
    }
});

function loadIndex(url) {
    window.location.href = url;
}

function updateAccessEdit(form, urlAPI) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        console.log("updateAccessEdit chamada!");

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
                    // Exibe o SweetAlert2 com a posição
                    ToastSucesso.fire({
                        title: resposta.msg,
                        icon: "success",
                        html: `
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
                                <span id="numero-posicao">${resposta.posicao}</span>
                            </div>
                        `
                    }).then(() => {
                        // Redireciona para o index
                        loadIndex(resposta.redirect);
                    });

                    form.reset();
                } else {
                    Swal.fire({
                        text: resposta.msg,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                }
            } else {
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
            console.error('Erro ao processar dados:', error);
            Swal.fire({
                text: 'Erro ao tentar processar dados. Tente novamente.',
                icon: "error",
                confirmButtonColor: "#3085d6",
            });
        } finally {
            form.querySelector('button[type="submit"]').disabled = false;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const cadUsuarioForm = document.getElementById('accessFila1Form');
    if (cadUsuarioForm) {
        console.log("Formulário 'accessFila1Form' encontrado e pronto para uso.");
        updateAccessEdit(cadUsuarioForm, '/Fila_Facil/API/cad_access_fila1.php');
    }
});
