<?php
$senha = '0000000000';
$hashArmazenado = '$2y$10$VGm3Pgr5/q5ri3MfzXpJg.nhTut/tV6i/.XUfU'; // Hash armazenado no banco

if (password_verify($senha, $hashArmazenado)) {
    echo "Senha verificada com sucesso.";
} else {
    echo "Falha na verificação da senha.";
}
