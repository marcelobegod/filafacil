<?php
// Função para criar o hash da senha
function criarHash($senha)
{
    // Aplica o password_hash diretamente à senha fornecida
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
    // Retorna o hash da senha
    return $hashSenha;
}