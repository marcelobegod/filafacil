import { ToastSucesso } from './accessAlert.js';

document.addEventListener('DOMContentLoaded', () => {
    ToastSucesso.fire({
        title: 'Teste de Sucesso',
        icon: 'success',
        posicao: 1 // Exemplo de número de posição
    });
});
