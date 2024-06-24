<?php

// Função para gerar a posição
function position_generator($tipoFila, $idFilaCriada, $qtdFilaCriada)
{
    // Obter as posições atuais da tabela filas_chamada
    global $conexao;
    $posicoesExistentes = [];
    $sql = "SELECT posicao_chamada FROM filas_chamada WHERE id_fila_chamada = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $idFilaCriada);
    $stmt->execute();
    $result = $stmt->get_result();

    // Armazenar as posições existentes em um array
    while ($row = $result->fetch_assoc()) {
        $posicoesExistentes[] = (int)$row['posicao_chamada'];
    }
    $stmt->close();

    // Debug: Exibir o conteúdo de $posicoesExistentes (opcional)
    // echo '<pre>';
    // echo "Posições Existentes: ";
    // print_r($posicoesExistentes);
    // echo '</pre>';

    // Define a posição inicial para cada tipo de fila
    $posicao = ($tipoFila == 'padrao') ? 2 : 1;

    // Encontrar a próxima posição disponível, 
    // incrementando até encontrar uma vaga ou ultrapassar o limite
    while (in_array($posicao, $posicoesExistentes) && $posicao <= $qtdFilaCriada) {

        // Incrementa de 2 em 2 para manter padrão par/ímpar
        $posicao += 2;
    }

    // Verifica se encontrou uma posição dentro do limite
    if ($posicao <= $qtdFilaCriada) {
        return $posicao;
    } else {
        return "Vagas Esgotadas";
    }
}
