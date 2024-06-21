<?php
//conexao com BD siscrud
$local = "localhost";
$usuario = "root";
$senha = "";
$banco = "filafacil";

// Tentativa de conexão
$conexao = mysqli_connect($local, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (mysqli_connect_error()) {
    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
    // Encerra o script se houver erro na conexão
    exit();
}