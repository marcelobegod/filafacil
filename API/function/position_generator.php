<?php
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

    while ($row = $result->fetch_assoc()) {
        $posicoesExistentes[] = (int)$row['posicao_chamada'];
    }
    $stmt->close();

    // Debug: Exibir o conteúdo de $posicoesExistentes
    var_dump($posicoesExistentes);


    // Verificar o tipo de fila e encontrar a próxima posição disponível
    if ($tipoFila == 'padrao') {
        // Encontrar o próximo número par disponível
        for ($i = 2; $i <= $qtdFilaCriada; $i += 2) {
            if (!in_array($i, $posicoesExistentes)) {
                return $i;
            }
        }
    } elseif ($tipoFila == 'especial') {
        // Encontrar o próximo número ímpar disponível
        for ($i = 1; $i <= $qtdFilaCriada; $i += 2) {
            if (!in_array($i, $posicoesExistentes)) {
                return $i;
            }
        }
    }

    // Se todas as posições estiverem preenchidas, retornar "Vagas Esgotadas"
    return "Vagas Esgotadas";
}
