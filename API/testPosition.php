<?php
// Arquivo de CONEXAO
include_once("conexao.php");
include_once("./function/position_generator.php");

// Parâmetros para testar a função
$tipoFila = 'especial'; // ou 'padrao'
$idFilaCriada = 1; // ID da fila que você deseja testar
$qtdFilaCriada = 30; // Quantidade de filas

// Chamar a função e exibir a posição gerada
$posicao = position_generator($tipoFila, $idFilaCriada, $qtdFilaCriada);
echo "Posição gerada: " . $posicao;
