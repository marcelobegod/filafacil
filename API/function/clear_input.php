<?php
// Função para limpar entrada contra SQL injection e XSS
function clear_input($conexao, $entrada)
{
    // Remove caracteres especiais e realiza a escape da string para prevenir SQL injection
    $entrada = mysqli_real_escape_string($conexao, $entrada);
    // Remove possíveis códigos maliciosos HTML/JavaScript
    $entrada = htmlspecialchars($entrada);
    return $entrada;
}
