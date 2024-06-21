<?php
session_start();

function sair()
{
    // Apaga todas as variáveis de sessão
    $_SESSION = array();

    // Se desejar, você pode também destruir a sessão completamente
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();

    // Fecha a conexão com o banco de dados, se estiver aberta
    // Substitua 'conexao' pelo nome da sua conexão
    if (isset($conexao)) {
        mysqli_close($conexao);
    }

    // Redireciona para o index.php
    header("Location: /Fila_Facil/index.php");
    exit;
}

// Para utilizar a função, basta chamar sair()
sair();