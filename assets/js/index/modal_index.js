console.log('Modal index carregada');

// Criando um objeto para as funções de modal
let modalUtils = {
    modais: {},
    closeModal: function (modalId) {
        const modalElement = document.querySelector(`#${modalId}`);

        if (modalElement) {
            // Pega a instância do modal que foi criada na função openModal
            const modalInstance = modalUtils.modais[modalId];

            // Verifica se modalInstance ainda é válido
            if (modalInstance) {
                // Fecha e remove o modal do DOM
                modalInstance.hide();
            } else {
                console.error('Modal instance not found.');
            }
        } else {
            console.error('Modal element not found.');
        }
    }
};

// Método para abrir os modais
document.getElementById('openLogin').addEventListener('click', function (event) {
    let modalElement, modalId;

    if (event.target.id === 'openLogin') {
        modalElement = document.getElementById('modalAcesso');
        modalId = 'modalAcesso';
    } else if (event.target.id === 'openCadastro') {
        modalElement = document.getElementById('modalCadastro');
        modalId = 'modalCadastro';
    }

    if (modalElement) {
        let myModal = modalUtils.modais[modalId];

        if (!myModal) {
            myModal = new bootstrap.Modal(modalElement);
            modalUtils.modais[modalId] = myModal;
        }

        myModal.show();
    }
});

// Método para fechar o modal de acesso ao clicar em "Cadastre-se" e abrir o modal de cadastro
document.getElementById('cadastro').addEventListener('click', function () {
    // Fecha o modal de acesso se estiver aberto
    if (modalUtils.modais['modalAcesso']) {
        modalUtils.closeModal('modalAcesso');
    }
    // Abre o modal de cadastro
    let modalCadastro = document.getElementById('modalCadastro');
    let myModal = modalUtils.modais['modalCadastro'];

    if (!myModal) {
        myModal = new bootstrap.Modal(modalCadastro);
        modalUtils.modais['modalCadastro'] = myModal;
    }

    myModal.show();
});