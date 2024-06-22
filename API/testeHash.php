<?php
$senha = '111';
$hashArmazenado = '$2y$10$lif/NaBB/4IwHVW.8P1Oduycw2oFcpsyKruBjr'; // Hash armazenado no banco

if (password_verify($senha, $hashArmazenado)) {
    echo "Senha verificada com sucesso.";
} else {
    echo "Falha na verificação da senha.";
}
