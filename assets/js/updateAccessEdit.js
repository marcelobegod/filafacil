// updateAccessEdit.js
console.log('Função updateAccessEdit carregada');
// Importa o mixin
import { ToastSucesso } from './accessAlert.js';

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
                            // Passa a posição para o mixin
                            posicao: resposta.posicao
                        }).then(() => {
                            // Ações após o alerta ser fechado (se necessário)
                            // ...
                        });

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
