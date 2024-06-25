<?php
function position_generator($tipoFila, $idFilaCriada)
{
    global $conexao;

    // Inicia a próxima posição
    $posicao = 1;

    // Loop para encontrar a próxima posição disponível
    while (true) {
        // Busca as posições existentes DENTRO do loop
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

        // Verifica se a posição atual já está em uso
        if (in_array($posicao, $posicoesExistentes)) {
            $posicao++; // Se estiver em uso, incrementa a posição
            continue; // Volta ao início do loop
        }

        // Se a posição estiver livre, verifica se atende ao tipo de fila
        if (
            ($tipoFila == 'padrao' && $posicao % 2 == 0) ||
            ($tipoFila == 'especial' && $posicao % 2 != 0) ||
            $tipoFila == '' // Caso não seja especificado o tipo, aceita qualquer posição
        ) {
            break; // Sai do loop se a posição for válida
        }

        $posicao++; // Se a posição não for válida para o tipo de fila, incrementa e tenta novamente
    }

    return $posicao;
}
