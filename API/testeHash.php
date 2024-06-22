<?php
$senha = '111';
$hashArmazenado = '$2y$12$Mti2pTZoQj3pYi/9dHGLNerlt4wIguwjx60.GOamxY3arvTFsqx0m'; // Hash armazenado no banco

if (password_verify($senha, $hashArmazenado)) {
    echo "Senha verificada com sucesso.";
} else {
    echo "Falha na verificação da senha.";
}