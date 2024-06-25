console.log('Modais internos carregada');

// Define o objeto modalUtils no escopo global
const modalUtils = {
    modais: {} // Objeto para armazenar as instâncias dos modais
};
// Função para abrir o modal com base na classe do elemento clicado
function openModal() {
    // Define um mapeamento de classes para IDs de modais
    const modalMap = {

        //Deletar Acesso
        'btnAccess': 'modalAcesso',


        //Acessar fila
        'btnDelete': 'modalDelete',


    };

    document.querySelectorAll('.open-modal').forEach(element => {
        element.addEventListener('click', () => {
            console.log('Elemento clicado:', element);

            // Itera pelas classes do elemento
            for (const className of element.classList) {
                // Verifica se a classe está no mapeamento
                if (className in modalMap) {
                    const modalId = modalMap[className];
                    console.log(`Abrindo modal "${modalId}"`);

                    // Abre o modal com o ID determinado
                    const modalElement = document.getElementById(modalId);
                    if (modalElement) {
                        // Verifica se o modal já foi instanciado
                        let myModal = modalUtils.modais[modalId];
                        if (!myModal) {
                            // Instancia o modal se necessário
                            myModal = new bootstrap.Modal(modalElement);

                            // Armazena a instância
                            modalUtils.modais[modalId] = myModal;
                        }

                        // Verifica o modal e o estado de seleção de usuários usando switch

                        switch (modalId) {
                            case 'modalAcesso':

                                console.log('Abrindo o modal. Editar');
                                myModal.show();

                                break;

                            case 'modalDelete':
                                // Atualizar o conteúdo do modalDelete com o nome do usuário selecionado
                                selectUserId = element.dataset.id;
                                selectUserNome = element.dataset.nome;
                                console.log(`Nome do usuário "${selectUserNome}"`);
                                console.log(`Id do usuário "${selectUserId}"`);
                                if (modalElement) {
                                    const nomeUsuarioElement = modalElement.querySelector('.nome-delete');

                                    if (nomeUsuarioElement && selectUserNome) {
                                        nomeUsuarioElement.textContent = selectUserNome;

                                        // Abrir o modalDelete se um usuário estiver selecionado
                                        myModal.show();
                                    } else {
                                        console.error('Nome do usuário ou elemento nome-delete não encontrados.');
                                    }
                                } else {
                                    console.error('Elemento modalDelete não encontrado.');
                                }
                                break;


                            default:
                                console.error(`Elemento modal com ID "${modalId}" não encontrado!`);
                        }

                    } else {
                        console.error(`Elemento modal com ID "${modalId}" não encontrado!`);
                    }
                    // Sai do loop após encontrar a classe correspondente
                    break;
                }
            }
        });
    });
}
