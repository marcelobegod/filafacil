//accesAlert.js
ToastSucesso = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000, // Tempo em milissegundos para o alerta desaparecer
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);

        // Define o número da posição dentro do círculo (se existir)
        const numeroPosicaoSpan = document.getElementById('numero-posicao');
        if (numeroPosicaoSpan) {
            // Corrigido: Acessar 'resposta' dentro do escopo correto
            numeroPosicaoSpan.textContent = toast.params.posicao || 'N/A';
        }
    },
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
            <span id="numero-posicao"></span>
        </div>
    `,
});

export { ToastSucesso };