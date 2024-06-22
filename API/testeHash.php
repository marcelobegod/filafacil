<?php
$senha = '111111';
$hashArmazenado = '$2y$10$V1bG7C5CYUbuShnbO4.oiupoG3xox0XjTVb4f5'; // Hash armazenado no banco

if (password_verify($senha, $hashArmazenado)) {
    echo "Senha verificada com sucesso.";
} else {
    echo "Falha na verificação da senha.";
}