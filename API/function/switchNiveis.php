<?php
// Verifica se a sessão está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se a variável de sessão 'UsuarioNivel' está definida
if (isset($_SESSION['nivel_usu'])) {
    switch ($_SESSION['nivel_usu']) {
        case 'usuario':
            include_once __DIR__ . "/../../layout/sidebar/footerUsuario.php";
            break;
        case 'cliente':
            include_once __DIR__ . "/../../layout/sidebar/footer_cliente.php";
            break;
        case 'gestor':
            include_once __DIR__ . "/../../layout/sidebar/footer_gestor.php";
            break;
        case 'ti':
            include_once __DIR__ . "/../../layout/sidebar/footer_ti.php";
            break;
        default:
            echo "Nível de usuário não reconhecido.";
    }
} else {
    echo "Nível de usuário não definido.";
}
