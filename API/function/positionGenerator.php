<?php
function positionGenerator($tipoTabela, $qtdDisponivel, $posicaoAtual)
{
    // Verifica o tipo da tabela
    if ($tipoTabela == 'acessofila_padrao') {
        // Garante que a próxima posição seja sempre um número par maior que a atual
        if ($posicaoAtual % 2 != 0) {
            // Avança para o próximo par se a posição atual for ímpar
            $posicaoAtual++;
        } else {
            // Avança para o próximo par se a posição atual for par
            $posicaoAtual += 2;
        }
    } elseif ($tipoTabela == 'acessofila_especial') {
        // Garante que a próxima posição seja sempre ímpar maior que a atual
        if ($posicaoAtual % 2 == 0) {
            // Avança para o próximo ímpar se a posição atual for par
            $posicaoAtual++;
        } else {
            // Avança para o próximo ímpar se a posição atual for ímpar
            $posicaoAtual += 2;
        }
    }

    // Verifica se a próxima posição ultrapassa a quantidade disponível
    if ($posicaoAtual > $qtdDisponivel) {

        // Retorna mensagem de vagas esgotadas se a posição for maior que a quantidade disponível
        return "Vagas Esgotadas";
    } else {
        // Retorna a próxima posição válida
        return $posicaoAtual;
    }
}
